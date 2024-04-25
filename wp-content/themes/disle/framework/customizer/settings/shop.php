<?php
/**
 * Shop setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Shop
$this->sections['disle_shop_general'] = array(
	'title' => esc_html__( 'Main Shop', 'disle' ),
	'panel' => 'disle_shop',
	'settings' => array(
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'disle' ),
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Our Shop', 'disle' ),
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Title', 'disle' ),
				'type' => 'disle_textarea',
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop: Featured Title Background', 'disle' ),
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 6,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'disle' ),
				'type' => 'number',
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'disle' ),
				'description' => esc_html__( 'Example: 30px.', 'disle' ),
				'active_callback' => 'disle_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.products li',
				'alter' => 'margin-top',
			),
		),
	),
);

// Single Shop
$this->sections['disle_single_shop_general'] = array(
	'title' => esc_html__( 'Single Shop', 'disle' ),
	'panel' => 'disle_shop',
	'settings' => array(
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'disle' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'disle' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'disle' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'disle' ),
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title',
			'default' => esc_html__( 'Our Shop', 'disle' ),
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Title', 'disle' ),
				'type' => 'text',
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop Single: Featured Title Background', 'disle' ),
				'active_callback' => 'disle_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_realted_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Product Columns', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'0' => '0',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'disle_cac_has_woo',
			),
		),
	),
);