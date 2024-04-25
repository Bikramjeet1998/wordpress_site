<?php
/**
 * Featured Title setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['disle_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'disle' ),
	'panel' => 'disle_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'disle' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'disle' ),
					'centered' => esc_html__( 'Centered', 'disle' ),
					'modern' => esc_html__( 'Modern', 'disle' ),
				),
				'active_callback' => 'disle_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'disle' ),
				'description' => esc_html__( 'Example: 250px 0px 150px 0px', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '#featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'disle' ),
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
				'active_callback' => 'disle_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Headings
$this->sections['disle_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Headings', 'disle' ),
	'panel' => 'disle_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'disle' ),
				'type' => 'checkbox',
				'active_callback' => 'disle_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 30px.', 'disle' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['disle_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'disle' ),
	'panel' => 'disle_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'disle' ),
				'type' => 'checkbox',
				'active_callback' => 'disle_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'disle' ),
				'active_callback' => 'disle_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'portfolio_page',
			'control' => array(
				'label'  => esc_html__( 'Projects', 'disle' ),
				'type' => 'select',
				'choices' => disle_get_pages(),
				'active_callback' => 'disle_cac_has_single_project',
			),
		),
	),
);