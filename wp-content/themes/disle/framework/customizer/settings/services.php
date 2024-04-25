<?php
/**
 * Services setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Service General
$this->sections['disle_services_general'] = array(
	'title' => esc_html__( 'General', 'disle' ),
	'panel' => 'disle_services',
	'settings' => array(
		array(
			'id' => 'disle_service_single_featured_title',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Feature Title', 'disle' ),
			),
		),
		array(
			'id' => 'service_single_featured_title',
			'default' =>  '',
			'control' => array(
				'label' => esc_html__( 'Title', 'disle' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'disle' ),
			),
		),
		array(
			'id' => 'service_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Service: Featured Title Background', 'disle' ),
			),
		)
	),
);