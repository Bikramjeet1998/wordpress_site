<?php
/**
 * Layout setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['disle_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'disle' ),
	'panel' => 'disle_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','disle' ),
					'boxed' => esc_html__( 'Boxed','disle' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'disle' ),
				'type' => 'checkbox',
				'active_callback' => 'disle_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'disle' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'disle' ),
				'active_callback' => 'disle_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'disle' ),
				'type' => 'color',
				'active_callback' => 'disle_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'disle' ),
				'type' => 'image',
				'active_callback' => 'disle_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'disle' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'disle' ),
					'cover'        => esc_html__( 'Cover', 'disle' ),
					'center-top'        => esc_html__( 'Center Top', 'disle' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'disle' ),
					'fixed'        => esc_html__( 'Fixed Center', 'disle' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'disle' ),
					'repeat'       => esc_html__( 'Repeat', 'disle' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'disle' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'disle' ),
				),
				'active_callback' => 'disle_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['disle_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'disle' ),
	'panel' => 'disle_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings elementor when edit.', 'disle' )
			),
		),
		array(
			'id' => 'custom_page_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Custom Page Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout for all custom pages.', 'disle' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'disle' )
			),
		),
		array(
			'id' => 'single_project_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Project Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout for all single project pages.', 'disle' ),
				'active_callback' => 'disle_cac_has_single_project',
			),
		),
		array(
			'id' => 'single_service_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Service Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout for all single service pages.', 'disle' ),
				'active_callback' => 'disle_cac_has_single_service',
			),
		),
		array(
			'id' => 'give_forms_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Give Forms Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout for all Give Forms.', 'disle' ),
				'active_callback' => 'disle_cac_has_give_forms',
			),
		),
	),
);

// Layout Widths
$this->sections['disle_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'disle' ),
	'panel' => 'disle_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'disle' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'disle' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .disle-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'disle' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'disle' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'disle' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 28%', 'disle' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);