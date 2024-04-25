<?php
/**
 * Demo Import Data
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function disle_import_files() {
    return array(
        array(
            'import_file_name'           => 'Demo Import',
            'import_file_url'            => 'https://tplabs.co/disle/_demo/content.xml',
            'import_widget_file_url'     => 'https://tplabs.co/disle/_demo/widget.wie',
            'import_customizer_file_url' => 'https://tplabs.co/disle/_demo/options.dat',
            'import_preview_image_url'   => 'https://tplabs.co/disle/_demo/preview-import.png',
            'preview_url'                => 'https://tplabs.co/disle/',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'disle_import_files' );

function disle_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home 01' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Replace URL for Elementor Widget
    disle_replace_url();

}
add_action( 'pt-ocdi/after_import', 'disle_after_import_setup' );

function disle_before_import_setup() {
    $give = get_option('give_settings');
    $give['featured_image_size'] = 'disle-cause-standard';
    $give['form_sidebar'] = 'disabled';
    $give['categories'] = 'enabled';
    $give['tags'] = 'enabled';
    update_option('give_settings', $give);
}
add_action( 'pt-ocdi/before_content_import', 'disle_before_import_setup' );