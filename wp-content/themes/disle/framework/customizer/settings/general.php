<?php
/**
 * General setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['disle_Accent_Colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#EE763C',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'disle' ),
				'type' => 'color',
				'active_callback' => 'disle_cac_no_elementor_accent_color'
			),
		),
	)
);

// Cursor
$this->sections['disle_cursor'] = array(
	'title' => esc_html__( 'Custom Cursor', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => 'cursor',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'disle' ),
				'type' => 'checkbox',
			),
		),
		// cursor 1
		array(
			'id' => 'disle_cursor1_heading',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Custom 1', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor'
			),
		),
		array(
			'id' => 'disle_cursor1_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor'
			),
		),
		array(
			'id' => 'disle_cursor1_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor'
			),
		),
		array(
			'id' => 'disle_cursor1_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor'
			),
		),
		// cursor 2
		array(
			'id' => 'disle_cursor2_heading',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Custom 2', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'disle_cursor2_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'disle_cursor2_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'disle_cursor2_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_1'
			),
		),
		// cursor 3
		array(
			'id' => 'disle_cursor3_heading',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Custom 3', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'disle_cursor3_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_2'
			),
		),
		array(
			'id' => 'disle_cursor3_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_2'
			),
		),
		array(
			'id' => 'disle_cursor3_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_2'
			),
		),
		// cursor 4
		array(
			'id' => 'disle_cursor4_heading',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Custom 4', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_3'
			),
		),
		array(
			'id' => 'disle_cursor4_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_3'
			),
		),
		array(
			'id' => 'disle_cursor4_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_3'
			),
		),
		array(
			'id' => 'disle_cursor4_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_3'
			),
		),
		// cursor 5
		array(
			'id' => 'disle_cursor5_heading',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Custom 5', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_4'
			),
		),
		array(
			'id' => 'disle_cursor5_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_4'
			),
		),
		array(
			'id' => 'disle_cursor5_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_4'
			),
		),
		array(
			'id' => 'disle_cursor5_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'disle' ),
				'active_callback' => 'disle_cac_has_cursor_4'
			),
		),
	)
);

// PreLoader
$this->sections['disle_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'' => esc_html__( 'Disable','disle' ),
					'animsition' => esc_html__( 'Enable','disle' ),
				),
			),
		),
		array(
			'id' => 'preloader_style',
			'default' => 'default',
			'control' => array(
				'label' => esc_html__( 'Style', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'default' => esc_html__( 'Default','disle' ),
					'image' => esc_html__( 'Image','disle' ),
				),
			),
		),
		array(
			'id' => 'preload_color_1',
			'default' => '#E33C34',
			'control' => array(
				'label' => esc_html__( 'Color 1', 'disle' ),
				'type' => 'color',
				'active_callback' => 'disle_cac_preloader_default'
			),
			'inline_css' => array(
				'target' => '.animsition-loading',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'preload_color_2',
			'default' => '#EE763C',
			'control' => array(
				'label' => esc_html__( 'Color 2', 'disle' ),
				'type' => 'color',
				'active_callback' => 'disle_cac_preloader_default'
			),
			'inline_css' => array(
				'target' => '.animsition-loading:before',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'preloader_image',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Preloader Image', 'disle' ),
				'active_callback' => 'disle_cac_preloader_image',
				'type' => 'image',
			),
		),
		array(
			'id' => 'disle_loader_class',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Animation Class', 'disle' ),
				'active_callback' => 'disle_cac_preloader_image'
			),
		),
	)
);

// Header Site
$header_style = array( '1' => esc_html__( 'Basic', 'disle' ) );
$header_special = array( '1' => esc_html__( 'Default', 'disle' ) );
$header_fixed = array( '1' => esc_html__( 'None', 'disle' ));
$args = array(  
    'post_type' => 'header',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$header_style[get_the_id()] = get_the_title();
	$header_special[get_the_id()] = get_the_title();
	$header_fixed[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['disle_header_site'] = array(
	'title' => esc_html__( 'Header', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'disle' ),
				'type' => 'select',
				'choices' => $header_style,
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'disle' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Fixed', 'disle' ),
				'type' => 'select',
				'choices' => $header_fixed,
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_float',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Header Float?', 'disle' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'disle_header_heading',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Header for special page', 'disle' ),
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_blog',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Blog', 'disle' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_blog_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Blog Single', 'disle' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_shop',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Shop', 'disle' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_product_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Product Single', 'disle' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_project_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Project Single', 'disle' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_service_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Service Single', 'disle' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'disle_cac_header_elementor_builder'
			),
		),
	),
);

// Footer
$footer_style = array( '1' => esc_html__( 'Basic', 'disle' ) );
$footer_special = array( '1' => esc_html__( 'Default', 'disle' ) );
$args = array(  
    'post_type' => 'footer',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$footer_style[get_the_id()] = get_the_title();
	$footer_special[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['disle_footer_site'] = array(
	'title' => esc_html__( 'Footer', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => 'footer_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Style', 'disle' ),
				'type' => 'select',
				'choices' => $footer_style,
				'desc' => esc_html__( 'Footer Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'disle' )
			),
		),
		array(
			'id' => 'disle_footer_heading',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Footer for special page', 'disle' ),
				'active_callback' => 'disle_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_blog',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Blog', 'disle' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'disle_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_blog_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Blog Single', 'disle' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'disle_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_shop',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Shop', 'disle' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'disle_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_product_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Product Single', 'disle' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'disle_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_project_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Project Single', 'disle' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'disle_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_service_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Service Single', 'disle' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'disle_cac_footer_elementor_builder'
			),
		),
	),
);

// Scroll to top
$this->sections['disle_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'disle' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['disle_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'disle' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'disle' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'disle' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px', 'disle' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['disle_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Mobile Logo', 'disle' ),
				'active_callback' => 'disle_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'disle' ),
				'description' => esc_html__( 'Example: 150px', 'disle' ),
				'active_callback' => 'disle_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'disle' ),
				'description' => esc_html__( 'Example: 20px 0px 20px 0px', 'disle' ),
				'active_callback' => 'disle_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Mobile Menu', 'disle' ),
				'active_callback' => 'disle_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'disle' ),
				'description' => esc_html__( 'Example: 40px', 'disle' ),
				'active_callback' => 'disle_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo', 'disle' ),
				'active_callback' => 'disle_cac_header_basic',
				'type' => 'image',
			),
		),
		array(
			'id' => 'mobile_menu_logo_width',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo: Width', 'disle' ),
				'type' => 'text',
				'active_callback' => 'disle_cac_header_basic'
			),
		),
		// Featured Title
		array(
			'id' => 'heading_featured_title',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Mobile Featured Title', 'disle' ),
			),
		),
		array(
			'id' => 'mobile_featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'disle' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#featured-title .inner-wrap, #featured-title.centered .inner-wrap, #featured-title.creative .inner-wrap',
				'alter' => 'padding',
			),
		),
	)
);

// 404 Page
$this->sections['disle_404_page'] = array(
	'title' => esc_html__( '404 Page', 'disle' ),
	'panel' => 'disle_general',
	'settings' => array(
		array(
			'id' => '404_image',
			'default' => '',
			'control' => array(
				'label' => esc_html__( '404 Image', 'disle' ),
				'type' => 'image',
			),
		),
		array(
			'id' => '404_image_max_width',
			'control' => array(
				'label' => esc_html__( '404 Image: Width', 'disle' ),
				'type' => 'text',
			),
		),
	)
);
