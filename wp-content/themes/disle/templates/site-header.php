<?php
/**
 * Header
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( (disle_header_style() == '1') || (get_post_type() == 'elementor_library') ) {
    $cls ='';
    $has_info = false;
    $has_social = false;
    $has_top = false;
    if (disle_get_mod('header_info_phone', '') ||
        disle_get_mod('header_info_email', '') ||
        disle_get_mod('header_info_address', ''))
        $has_info = true;

    if (disle_get_mod('header_socials', false))
        $has_social = true;

    if ($has_social || $has_info)
        $has_top = true;

    // Get header style
    $cls = disle_get_mod( 'header_class' );
    ?>

    <header id="site-header" class="<?php echo esc_attr( $cls ); ?>">
        <?php if ($has_top) { ?>
            <div class="top-bar">
                <div class="disle-container">
                    <div class="top-bar-inner">
                        <div class="topbar-left">
                            <?php get_template_part( 'templates/header-social'); ?>
                        </div> 

                        <div class="topbar-right">
                            <?php get_template_part( 'templates/header-info'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="disle-container">
        	<div class="site-header-inner">
                <?php 
                get_template_part( 'templates/header-logo');  
                get_template_part( 'templates/header-menu');       
            	get_template_part( 'templates/header-button');
            	?>
        	</div>
        </div>
    </header><!-- /#site-header -->
<?php } else {

    $float = disle_get_elementor_option('header_float');
    if ( (disle_header_style() == disle_get_mod('header_site_style', 1) ) && disle_get_mod('header_float', false) ) $float = 'yes';

    ?>
    <div class="disle-header disle-container <?php if ($float == 'yes') echo 'header-float'; ?>">
        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(disle_header_style(), false); ?>
    </div>
    <?php

    $idf = disle_get_mod( 'header_fixed', '1' );
    if (!is_null(disle_get_elementor_option('header_fixed')) && (disle_get_elementor_option('header_fixed') !== '0'))
       $idf = disle_get_elementor_option('header_fixed');
    if ($idf !== '1') { ?>
        <div class="disle-header-fixed fixed-hide disle-container">
            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($idf, false); ?>
        </div>
    <?php }
    
} ?>
