<?php
/**
 * Footer setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['disle_footer_general'] = array(
	'title' => esc_html__( 'General', 'disle' ),
	'panel' => 'disle_footer',
	'settings' => array(
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'5' => '5-3-4',
					'4' => '3-3-3-3',
					'3' => '4-4-4',
					'2' => '6-6',
					'1' => '12',
				),
				'active_callback' => 'disle_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '30',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
				'active_callback' => 'disle_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'disle' ),
				'active_callback' => 'disle_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'disle' ),
				'active_callback' => 'disle_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_bg_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'disle' ),
				'active_callback' => 'disle_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_bg_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'disle' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'disle' ),
					'cover'        => esc_html__( 'Cover', 'disle' ),
					'center-top'   => esc_html__( 'Center Top', 'disle' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'disle' ),
					'fixed'        => esc_html__( 'Fixed Center', 'disle' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'disle' ),
					'repeat'       => esc_html__( 'Repeat', 'disle' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'disle' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'disle' ),
				),
				'active_callback' => 'disle_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'disle' ),
				'description' => esc_html__( 'Example: 60px.', 'disle' ),
				'active_callback' => 'disle_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'disle' ),
				'description' => esc_html__( 'Example: 60px.', 'disle' ),
				'active_callback' => 'disle_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-bottom',
			),
		),
	),
);