<?php
/**
 * Plugin Name: Custom Post Word Counter
 * Description: Adds a Word Count column to posts and pages in WordPress admin.
 * Version: 1.0
 * Author: Dipti Sahay
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/* Add column to posts */
function cpwc_add_wordcount_column($columns) {
    $columns['word_count'] = 'Word Count';
    return $columns;
}

add_filter('manage_posts_columns', 'cpwc_add_wordcount_column');
add_filter('manage_pages_columns', 'cpwc_add_wordcount_column');


/* Show word count in column */
function cpwc_display_wordcount_column($column, $post_id) {

    if ($column == 'word_count') {

        $post = get_post($post_id);
        $content = strip_tags($post->post_content);
        $word_count = str_word_count($content);

        echo $word_count;
    }
}

add_action('manage_posts_custom_column', 'cpwc_display_wordcount_column', 10, 2);
add_action('manage_pages_custom_column', 'cpwc_display_wordcount_column', 10, 2);
