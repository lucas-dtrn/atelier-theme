<?php
/**
 * Block Name: Button Liste
 *
 */

// get fields
$button_count = count(get_field("buttons"));
$id = $block['id'];

if( have_rows('buttons') ): ?>
    
    <div class="buttons__list count--<?= $button_count ?>" id="<?php echo $id; ?>">

    <?php while( have_rows('buttons') ) : the_row();
        $button = get_sub_field('button');
        ?>
        <?php if( !empty( $button ) ) : ?>
            <a class="button --color-main  " href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>">
                <span><?php echo $button["title"]; ?></span>
            </a>
        <?php endif; ?>
    <?php endwhile; ?>

    </div>

<?php endif; ?>