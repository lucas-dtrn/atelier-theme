<?php
/*------------------------------------*/
/* Block Name: USP Kacheln */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

$items = [];
if (have_rows('tiles')) :

    while (have_rows('tiles')) : the_row();
        $items[] = array(
            'icon' => get_sub_field("icon"),
            'headline_h3' => get_sub_field("headline_h3"),
            'headline_h6' => get_sub_field("headline_h6"),
            'text' => get_sub_field("description"),
        );
    endwhile;

    get_template_part('components/usp-tiles', '', array('items' => $items));

endif;
