<?php
/**
 * Projects setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project General
$this->sections['disle_projects_general'] = array(
	'title' => esc_html__( 'General', 'disle' ),
	'panel' => 'disle_projects',
	'settings' => array(
		array(
			'id' => 'project_single_featured_title',
			'default' =>  '',
			'control' => array(
				'label' => esc_html__( 'Title', 'disle' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'disle' ),
			),
		),
		array(
			'id' => 'project_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Project: Featured Title Background', 'disle' ),
			),
		),
	),
);
