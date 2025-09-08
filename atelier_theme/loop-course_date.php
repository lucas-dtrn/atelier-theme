<?php
// // get posts
// $paged = (get_query_var('page')) ? get_query_var('page') : 1;
// $posts = get_posts(array(
//     'posts_per_page' => get_option('posts_per_page'),
//     'paged' => $paged,
//     'post_type' => 'course_date',
//     'posts_per_page' => -1,
//     'meta_key' => 'date',
//     'orderby' => 'meta_value',
//     'order' => 'ASC'
// ));

// foreach ($posts as $post) {
//     $date = strtotime(get_field('date', $post->ID));
//     $date = date_i18n('j. F Y', $date);
//     $course = get_field('course_time', $post->ID);
// }
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php
        // Allgemein
        $postId = get_the_ID();
        global $color;

        // Fields
        $date = strtotime(get_field('date', $postId));
        $date = date_i18n('j. F Y', $date);
        ?>

        <article class="date-list__item">

            <?= $date ?>

        </article>

    <?php endwhile; ?>

<?php else : ?>

    <!-- article -->
    <article class="no-products">
        <h2><?php _e('Sorry, nothing to display.', 'atelier'); ?></h2>
    </article>
    <!-- /article -->

<?php endif; ?>

<?php wp_reset_query();   // Restore global post data stomped by the_post(). 
?>