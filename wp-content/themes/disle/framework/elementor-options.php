<?php
namespace disle\Settings;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Disle_Settings
{

    public function __construct()
    {	
    	add_action('elementor/documents/register_controls', [$this, 'disle_register_settings'], 10);
    }

    public function disle_register_settings($element)
    {	 	
    	$post_id = $element->get_id();
    	$post_type = get_post_type($post_id);

        $this->disle_general_settings($element);

    	if ( $post_type == 'page' )
    		$this->disle_page_settings($element);

    	if ( is_singular( 'project' ) ) 
    		$this->disle_project_settings($element);

        if ( is_singular( 'post' ) ) {
            $this->disle_post_settings($element);
        }

        if ( is_singular( 'event_listing' ) ) {	
            $this->disle_event_settings($element);
        }
    }

    public function disle_general_settings($element) {
        $element->start_controls_section(
            'disle_general_settings',
            [
                'label' => esc_html__('Page Settings', 'disle'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'page_accent_color',
            [
                'label' => esc_html__( 'Accent Color', 'disle' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--e-global-color-disle_accent: {{VALUE}}'
                ]
            ]
        );

        $element->add_control(
            'layout',
            [
                'label'     => esc_html__( 'Layout', 'disle'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'site_layout_position',
            [
                'label' => esc_html__( 'Sidebar Position', 'disle' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'sidebar-left' => [
                        'title' => esc_html__( 'Sidebar Left', 'disle' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'no-sidebar' => [
                        'title' => esc_html__( 'No Sidebar', 'disle' ),
                        'icon' => 'eicon-ban',
                    ],
                    'sidebar-right' => [
                        'title' => esc_html__( 'Sidebar Right', 'disle' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
            ]
        );

        // Featured Title
        $element->add_control(
            'featured_title_heading',
            [
                'label'     => esc_html__( 'Featured Title', 'disle'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_featured_title',
            [
                'label'     => esc_html__( 'Hide?', 'disle'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => esc_html__( 'Yes', 'disle'),
                    'block'      => esc_html__( 'No', 'disle'),
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'featured_title_bg',
                'label' => esc_html__( 'Background', 'disle' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #featured-title',
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'custom_featured_title',
            [
                'label'   => esc_html__( 'Custom Title', 'disle' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'main_content_heading',
            [
                'label'     => esc_html__( 'Main Content', 'disle'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Content Padding', 'disle'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [ 
                    '{{WRAPPER}} #page #main-content' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_content_bg',
                'label' => esc_html__( 'Background', 'disle' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #main-content',
            ]
        );

        $element->end_controls_section();
    }

    public function disle_page_settings($element) {
        $header_style = array( 
            '0'      => esc_html__( 'Default', 'disle'),
        );
        $header_fixed = array( 
            '0'      => esc_html__( 'Default', 'disle'),
            '1'      => esc_html__( 'None', 'disle' ) 
        );
        $args = array(  
            'post_type' => 'header',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );

        $loop = new \WP_Query( $args ); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $header_style[get_the_id()] = get_the_title();
            $header_fixed[get_the_id()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        $footer_style = array( 
            '0'      => esc_html__( 'Default', 'disle'), 
        );
        $args = array(  
            'post_type' => 'footer',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );

        $loop = new \WP_Query( $args ); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $footer_style[get_the_id()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        // Header
        $element->start_controls_section(
            'disle_hf_settings',
            [
                'label' => esc_html__('Header & Footer', 'disle'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'header_heading',
            [
                'label'     => esc_html__( 'Header', 'disle'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $element->add_control(
            'header_hide',
            [
                'label' => esc_html__( 'Hide Header', 'disle' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'disle' ),
                'label_off' => esc_html__( 'No', 'disle' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'header_float',
            [
                'label' => esc_html__( 'Header Transparent (float)?', 'disle' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'disle' ),
                'label_off' => esc_html__( 'No', 'disle' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [ 'header_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'header_style',
            [
                'label'     => esc_html__( 'Header Style', 'disle'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $header_style,
                'render_type' => 'template',
                'condition' => [ 'header_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'header_fixed',
            [
                'label'     => esc_html__( 'Header Fixed', 'disle'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $header_style,
                'condition' => [ 'header_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'footer_heading',
            [
                'label'     => esc_html__( 'Footer', 'disle'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'footer_hide',
            [
                'label' => esc_html__( 'Hide Footer', 'disle' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'disle' ),
                'label_off' => esc_html__( 'No', 'disle' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'footer_fixed',
            [
                'label' => esc_html__( 'Footer Fixed ?', 'disle' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'disle' ),
                'label_off' => esc_html__( 'No', 'disle' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [ 'footer_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'footer_style',
            [
                'label'     => esc_html__( 'Footer Style', 'disle'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $footer_style,
                'condition' => [ 'footer_hide!' => 'yes' ]
            ]
        );

        $element->end_controls_section();
    }

    public function disle_project_settings($element) {
    	$element->start_controls_section(
            'disle_project_settings',
            [
                'label' => esc_html__('Project Settings', 'disle'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'project_desc',
            [
                'label'      => esc_html__( 'Short Description', 'disle' ),
                'type'       => Controls_Manager::WYSIWYG,
            ]
        );

        $element->end_controls_section();
    }

    public function disle_post_settings($element) {

        $element->start_controls_section(
            'disle_post_settings',
            [
                'label' => esc_html__('Post Settings', 'disle'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );


        $element->add_control(
            'video_url',
            [
                'label'     => esc_html__( 'Video URL or Embeded Code', 'disle'),
                'type'      => Controls_Manager::TEXT,
                'default'   => '',
            ]
        );

        $element->add_control(
            'gallery_images',
            [
                'label' => esc_html__( 'Add Images', 'disle' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $element->end_controls_section();
    }

    public function disle_event_settings($element) {
        $element->start_controls_section(
            'disle_event_settings',
            [
                'label' => esc_html__('Event Settings', 'disle'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'event_builder',
            [
                'label' => esc_html__( 'Elementor Builder', 'disle' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'disle' ),
                'label_off' => esc_html__( 'No', 'disle' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__( '*Enable this option will hide default template. Use Elementor Widgets to build your own single Event with flexible layout.', 'disle' ),
            ]
        );

        $element->end_controls_section();
    }
}

new Disle_Settings();