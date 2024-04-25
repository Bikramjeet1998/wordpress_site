<?php
/**
 * Blog setting for Customizer
 *
 * @package disle
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['disle_blog_post'] = array(
	'title' => esc_html__( 'General', 'disle' ),
	'panel' => 'disle_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Our Blog', 'disle' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'disle' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'disle' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'disle' ),
				'description' => esc_html__( 'Example: 30px.', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Border Width', 'disle' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Border Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'meta,title,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'disle' ),
				'type' => 'disle-sortable',
				'object' => 'Disle_Customize_Control_Sorter',
				'choices' => array(
					'meta'            => esc_html__( 'Meta', 'disle' ),
					'title'           => esc_html__( 'Title', 'disle' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'disle' ),
					'readmore'        => esc_html__( 'Read More', 'disle' ),

				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'disle' ),
			),
		),
	),
);

// Blog Posts Media
$this->sections['disle_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'disle' ),
	'panel' => 'disle_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Blog Posts Title
$this->sections['disle_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'disle' ),
	'panel' => 'disle_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'disle' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['disle_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'disle' ),
	'panel' => 'disle_blog',
	'settings' => array(
		array(
			'id' => 'blog_meta_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'disle' ),
					'style-2' => esc_html__( 'Style 2', 'disle' ),
				)
			),
		),
		array(
			'id' => 'blog_before_author',
			'default' => esc_html__( 'by', 'disle' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Author', 'disle' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_before_category',
			'default' => esc_html__( 'in', 'disle' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Category', 'disle' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'disle' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'author', 'comments', 'date', 'categories' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'disle' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'disle' ),
				'type' => 'disle-sortable',
				'object' => 'Disle_Customize_Control_Sorter',
				'choices' => array(
					'author'     => esc_html__( 'Author', 'disle' ),
					'comments' => esc_html__( 'Comments', 'disle' ),
					'date'       => esc_html__( 'Date', 'disle' ),
					'categories' => esc_html__( 'Categories', 'disle' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'disle-heading',
				'label' => esc_html__( 'Item Meta', 'disle' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['disle_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'disle' ),
	'panel' => 'disle_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-2',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'disle' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'disle' ),
					'style-2' => esc_html__( 'Excerpt', 'disle' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '50',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'disle' ),
				'type' => 'text',
				'desc' => esc_html__( 'This option only apply for Content Style: Excerpt.', 'disle' )
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'disle' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'disle' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['disle_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'disle' ),
	'panel' => 'disle_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read More', 'disle' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'disle' ),
				'type' => 'text',
			),
		),
	),
);

