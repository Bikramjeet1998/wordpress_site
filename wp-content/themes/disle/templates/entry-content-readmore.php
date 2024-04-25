<?php
/**
 * Entry Content / Read More
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$text_more = disle_get_mod( 'blog_entry_button_read_more_text' );
$text_more   = $text_more ? $text_more : esc_html__( 'Read More', 'disle' ); ?>

<div class="post-read-more">
	<div class="post-link">
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="" title="<?php echo esc_attr( $text_more ); ?>">
			<span><?php echo esc_html( $text_more ); ?></span>
		</a>
	</div><!-- .post-link -->
</div>