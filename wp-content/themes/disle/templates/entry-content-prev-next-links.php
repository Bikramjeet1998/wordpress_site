<?php
/**
 * Entry Content / Prev Next Link
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( !(is_singular('post') && disle_get_mod( 'blog_single_prev_next_links', false )) )
	return;

?>

<div class="nav-links"> 
    <?php if (get_previous_post_link()) { ?>
    	<div class="prev">
    		<?php echo get_the_post_thumbnail( get_previous_post(), [ 100, 100 ] ); ?>
    		<?php previous_post_link('%link'); ?>    
    	</div>
    <?php } ?>
    
    <?php if (get_next_post_link()) { ?>
    	<div class="next">
    		<?php next_post_link('%link'); ?>
    		<?php echo get_the_post_thumbnail( get_next_post(), [ 100, 100 ] ); ?>
    	</div>
    <?php } ?>
</div>
