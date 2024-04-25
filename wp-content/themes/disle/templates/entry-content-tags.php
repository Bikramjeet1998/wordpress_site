<?php
/**
 * Entry Content / Tags
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( !(is_singular('post') && disle_get_mod( 'blog_single_tags', true )) )
	return;

if ( disle_get_mod( 'blog_single_social_share', false ) )
	echo '<div class="disle-socials-share single-post">';

$text = disle_get_mod( 'blog_single_tags_text', 'Tags' );
if ($text) {
    the_tags( '<div class="post-tags clearfix"><div class="inner"><span class="tag-text">'. esc_html( $text ) . '</span>','','</div></div>' );
} else {
    the_tags( '<div class="post-tags clearfix"><div class="inner">','','</div></div>' );
}

if ( disle_get_mod( 'blog_single_social_share', false ) && class_exists('\WP_Social') )
	echo do_shortcode('[xs_social_share]') . '</div>';
