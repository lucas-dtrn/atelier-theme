<?php
/*------------------------------------*/
/* Block Name: USP Liste */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

$items = [];
if (have_rows('usp')) :

    while (have_rows('usp')) : the_row();
        $items[] = array(
            'icon' => get_sub_field("icon"),
            'headline_h3' => get_sub_field("uberschrift_h3"),
            'headline_h6' => get_sub_field("uberschrift_h6"),
            'text' => get_sub_field("beschreibung"),
        );
    endwhile;

    get_template_part('components/usp-tiles', '', array('items' => $items));

endif;
