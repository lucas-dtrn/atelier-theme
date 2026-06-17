<?php get_header(); ?>

<main role="main">

    <section>
        <?php
        $postType = get_queried_object()->name;
        $category = $postType; // TODO: Change to $postType
        $options = $postType . '_options';
        $color = load_product_colors($postType);
        $plural = get_field('plural', $options);

        $post_count = $wp_query->found_posts;
        ?>

        <!-- Hero banner -->
        <!-- <div class="page__start category__header">

            <?php get_template_part('template-parts/header-bar', '', array('type' => 'atelier', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

            <div class="wrapper header__content">
                <?php
                $thumbnail = get_field("thumbnail", $options);
                $status = get_field("status", $options);
                $hero_banner = get_field("hero_banner", $options);
                $headline_h1 = $hero_banner["headline_h1"] ?? null;
                $subline_h1 = $hero_banner["subline_h1"] ?? null;
                $description = $hero_banner["description"] ?? null;
                // $button_1 = $hero_banner["button_1"];
                // $button_2 = $hero_banner["button_2"];
                ?>
                <?php get_template_part('template-parts/button', 'link', array('color' => $color, 'direction' => 'left', 'button' => array('title' => 'Zurück zur Übersicht', 'url' => get_site_url() . '/#' . $postType))); ?>

                <div class="header__text">

                    <?php if ($status) : ?>
                        <div class="info__badge">
                            <div></div>
                            <p><?= $status ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($headline_h1) : ?>
                        <h1><?= $headline_h1 ?>
                            <?php if ($subline_h1) : ?>
                                <br><span class="h6"><?= $subline_h1 ?></span>
                            <?php endif; ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                        <p><?= $description ?></p>
                    <?php endif; ?>

                    <?php if ($postType !== 'course') : ?>
                        <?php get_template_part('template-parts/button', '', array('color' => $color, 'button' => array('title' => $plural . ' entdecken', 'url' => '#list'))); ?>
                    <?php else : ?>
                        <div class="two-buttons">
                            <div class="filter--1">
                                <?php get_template_part('template-parts/button', '', array('color' => 'blue', 'button' => array('title' => 'Für Kinder', 'url' => '#list'))); ?>
                            </div>
                            <div class="filter--2">
                                <?php get_template_part('template-parts/button', '', array('color' => 'purple', 'button' => array('title' => 'Für Erwachsene', 'url' => '#list'))); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="space-large"></div>

                <?php if ($thumbnail) : ?>
                    <img class="header__image" src="<?= $thumbnail["url"] ?>" alt="<?= $thumbnail["alt"] ?>">
                <?php endif; ?>

            </div>


            <?php get_template_part('template-parts/paper'); ?>
            <img class="background__circle" src="<?= get_template_directory_uri() ?>/assets/img/website/kontakt/kontakt_background_circle.svg" alt="">

        </div> -->

        <div class="space-medium"></div>

        <div class="date-list">
            <?php get_template_part('loop-course_date'); ?>
            <?php get_template_part('pagination'); ?>
        </div>

        <div class="space-large"></div>

    </section>

</main>

<?php get_footer(); ?>