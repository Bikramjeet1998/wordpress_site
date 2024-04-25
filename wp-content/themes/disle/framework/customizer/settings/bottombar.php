<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['disle_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'disle' ),
	'panel' => 'disle_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'disle' ),
				'type' => 'checkbox',
				'active_callback' => 'disle_cac_footer_basic'
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Copyrights, 2023 Company.com',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'disle' ),
				'type' => 'disle_textarea',
				'active_callback' => 'disle_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'disle' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'disle' ),
				'active_callback'=> 'disle_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'disle' ),
				'active_callback'=> 'disle_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'disle' ),
				'active_callback' => 'disle_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_background_img_style',
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
				'active_callback' => 'disle_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'disle' ),
				'active_callback'=> 'disle_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'line_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Line Color', 'disle' ),
				'active_callback'=> 'disle_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom:before',
				'alter' => 'background-color',
			),
		),
	),
);

