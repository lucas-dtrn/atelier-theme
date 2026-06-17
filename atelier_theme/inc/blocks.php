<?php
function creat_category($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'inhaltselemente',
                'title' => __('Atelier Blöcke', 'inhaltselemente'),
            ),
        )
    );
}
add_filter('block_categories_all', 'creat_category', 10, 2);

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function register_acf_blocks() {
    // Base path for the blocks
    $blocks_base_dir = realpath(__DIR__ . '/../blocks');

    // List of folders within the 'blocks' directory
    $block_folders = glob($blocks_base_dir . '/*', GLOB_ONLYDIR);

    // Run `register_block_type` function for each folder
    foreach ($block_folders as $folder) {
        // Register the block type
        register_block_type($folder);
    }
}
add_action('init', 'register_acf_blocks');
