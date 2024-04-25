<?php
/**
 * Give Forms setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Give Forms General
$this->sections['disle_give_general'] = array(
	'title' => esc_html__( 'General', 'disle' ),
	'panel' => 'disle_give',
	'settings' => array(
		array(
			'id' => 'disle_give_single_featured_title',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Feature Title', 'disle' ),
			),
		),
		array(
			'id' => 'give_single_featured_title',
			'default' =>  '',
			'control' => array(
				'label' => esc_html__( 'Title', 'disle' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'disle' ),
			),
		),
		array(
			'id' => 'give_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Give Forms: Featured Title Background', 'disle' ),
			),
		)
	),
);