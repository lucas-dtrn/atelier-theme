<?php
function add_custom_api()
{
    // // Set timezone to UTC
    // date_default_timezone_set('Europe/Berlin');

    // wordpress rest api callback function
    function get_all_kunstangebote($request)
    {
        // query all posts of type course, workshop, birthday, event, holiday_workshop
        $args = array(
            'post_type' => array('course', 'workshop', 'birthday', 'event', 'holiday_workshop'),
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'fields' => 'ids',
        );

        $postIds = get_posts($args);
        $kunstangebote = [];

        foreach ($postIds as $postId) {
            $kunstangebot = getKunstangebot($postId);
            if ($kunstangebot) {
                $kunstangebote[] = $kunstangebot;
            }
        }

        return $kunstangebote;
    }
    register_rest_route('wp/v2', '/kunstangebot', array(
        'methods' => 'GET',
        'callback' => 'get_all_kunstangebote',
    ));

    function get_kunstangebot($request)
    {
        $postId = intval($request->get_param('postId'));
        return getKunstangebot($postId);
    }
    register_rest_route('wp/v2', '/kunstangebot/(?P<postId>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_kunstangebot',
    ));

    function getKunstangebot($postId)
    {
        // query all posts of type course, workshop, birthday, event, holiday_workshop
        $args = array(
            'post_type' => array('course', 'workshop', 'birthday', 'event', 'holiday_workshop'),
            'p' => $postId,
        );

        $post = get_posts($args)[0] ?? null;

        // Error handling: Kunstangebot nicht gefunden
        if (!$post) wp_send_json_error(array('message' => 'Kunstangebot nicht gefunden'), 404);

        $postType = $post->post_type;

        $post->acf = get_fields($postId);
        $post->thumbnail = get_the_post_thumbnail_url($postId, 'medium');
        $post->link = get_permalink($postId);

        // NOTE: Events
        if ($postType === 'event') {
            $pricing = get_field('pricing', $postType . '_options');
            $hours = array_map(function ($hour) {
                if (intval($hour["value"]) === 0) return null;
                return intval($hour["value"]);
            }, $pricing['hours']);
            $pricing["hours"] = $hours;
            $pricing["food"] = intval($pricing["food"]);
            $pricing["material"] = intval(get_field('pricing', $postId)['material']);
            $post->acf["pricing"] = $pricing;

            $durations = get_field('durations', $postType . '_options');
            $post->acf["durations"] = array_map(function ($duration) {
                return $duration["value"];
            }, $durations);
        }

        // NOTE: Birthdays
        if ($postType === 'birthday') {
            // REVIEW Save this in the database
            $post->acf['group'] = array(
                'value' => "child",
                'label' => "Kinder"
            );
        }

        // NOTE: Events
        if ($postType === 'event') {
            // REVIEW Save this in the database
            $post->acf['group'] = array(
                'value' => "adult",
                'label' => "Erwachsene"
            );
        }

        if (isset($post->acf['pricing'])) {
            // rename per_person to perPerson in $post->pricing object
            if (isset($post->acf['pricing']["per_person"])) {
                $post->acf['pricing']["perPerson"] = $post->acf['pricing']["per_person"];
                unset($post->acf['pricing']["per_person"]);
            }

            // conver all values of $post->acf['pricing'] into int values
            $post->acf['pricing'] = array_map(function ($value) {
                return intval($value);
            }, $post->acf['pricing']);
        }

        return $post;
    }
}

add_action('rest_api_init', 'add_custom_api');
