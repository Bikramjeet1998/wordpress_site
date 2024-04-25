<?php

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Project_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'gsap', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-project-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Project Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {
        // General
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'posts_per_page',
                [
                    'label'     => __( 'Posts to show', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 6,
                    'min'     => 3,
                    'max'     => 20,
                    'step'    => 1
                ]
            );

            $this->add_control(
                'cat_slug',
                [
                    'label'   => __( 'Category Slug (optional)', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                ]
            );

            $this->add_control(
                'exclude_cat_slug',
                [
                    'label'   => __( 'Exclude Cat Slug (optional)', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                ]
            );

            $this->end_controls_section();

        // Project
            $this->start_controls_section( 'setting_project1_section',
                [
                    'label' => __( 'Project', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'style-1',
                    'options'   => [
                        'style-1'      => __( 'Style 1', 'masterlayer'),
                        'style-2'      => __( 'Style 2', 'masterlayer'),
                    ],
                    'prefix_class' => 'project-',
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'imageSize',
                [
                    'label'     => __( 'Image Size', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => mae_get_image_sizes(),
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'show_desc',
                [
                    'label'        => __( 'Description', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'show_cat',
                [
                    'label'        => __( 'Categories', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'activeIndex',
                [
                    'label' => __( 'Active Index', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                    'separator' => 'before'
                ]
            ); 

            $this->add_control(
                'arrow_icon',
                [
                    'label' => __( 'Arrow Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow2',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'overlay_custom',
                [
                    'label' => esc_html__( 'Custom Overlay', 'masterlayer' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'masterlayer' ),
                    'label_off' => esc_html__( 'No', 'masterlayer' ),
                    'return_value' => 'yes',
                    'default' => '',
                    'prefix_class' => 'custom-overlay-'
                ]
            );

            $this->add_control(
                'overlay_image',
                [
                    'label'   => __( 'Overlay Image', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                    'condition' => ['overlay_custom' => 'yes']
                ],
            );

            $this->add_responsive_control(
                'overlay_align',
                [
                    'label' => __( 'Horizontal Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'condition' => ['overlay_custom' => 'yes']
                ]
            );

            $this->add_responsive_control(
                'overlay_left_offset',
                [
                    'label'      => __( 'Left Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overlay_align' => 'left', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'overlay_right_offset',
                [
                    'label'      => __( 'Right Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                    ],
                    50,
                    'condition' => [ 'overlay_align' => 'right', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'overlay_valign',
                [
                    'label' => __( 'Vertical Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'masterlayer' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'masterlayer' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'top',
                    'condition' => ['overlay_custom' => 'yes']
                ]
            );

            $this->add_responsive_control(
                'overlay_top_offset',
                [
                    'label'      => __( 'Top Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overlay_valign' => 'top', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'overlay_bottom_offset',
                [
                    'label'      => __( 'Bottom Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overlay_valign' => 'bottom', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
                ]
            );

            $this->end_controls_section();

        // Setting - Carousel
            $this->start_controls_section( 'setting_carousel_section',
                [
                    'label' => __( 'Carousel', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );
            
            $this->add_control(
                'slide_anim',
                [
                    'label'     => __( 'Side Animation', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'slide',
                    'options'   => [
                        'slide'         => __( 'Slide', 'masterlayer'),
                        'fade'          => __( 'Fade', 'masterlayer'),
                        'slide-fade'    => __( 'Slide & Fade', 'masterlayer'),
                    ],
                    'prefix_class' => 'is-',
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'column',
                [
                    'label' => __( 'Column', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 10,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'gap',
                [
                    'label' => __( 'Gap', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'stretch',
                [
                    'label'     => __( 'Stretch View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'        => __( 'No', 'masterlayer'),
                        'stretch-right'     => __( 'Stretch Right', 'masterlayer'),
                        'stretch-both'      => __( 'Full Width', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'outViewOpacity',
                [
                    'label'     => __( 'Outview Opacity', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 0.7,
                    'min'     => 0,
                    'max'     => 1,
                    'step'    => 0.1,
                    'condition'             => [
                        'stretch!'   => 'no',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box .item-carousel.is-selected' => 'opacity: 1;',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel.is-selected' => 'opacity: 1;',
                    ],
                ]
            );

            $this->add_control(
                'heading_autoplay',
                [
                    'label'     => __( 'Autoplay', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'autoPlay',
                [
                    'label'        => __( 'Auto Play', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'true',
                ]
            );
            
            $this->add_control(
                'autoPlaySpeed',
                [
                    'label' => __( 'Auto Play Speed (ms)', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'step' => 100,
                    'default' => 5000,
                    'condition' => [ 'autoPlay' => 'true' ]
                ]
            );
            
            $this->add_control(
                'pauseAutoPlayOnHover',
                [
                    'label'        => __( 'Pause On Hover?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'true',
                    'condition' => [ 'autoPlay' => 'true' ]
                ]
            );

            $this->add_control(
                'prevNextButtons',
                [
                    'label'        => __( 'Show Arrows?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'separator'    => 'before',
                    'prefix_class' => 'arrows-'
                ]
            );

            $this->add_control(
                'arrowPosition',
                [
                    'label'     => __( 'Arrows Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'middle',
                    'options'   => [
                        'top'        => __( 'Top', 'masterlayer'),
                        'middle'     => __( 'Middle', 'masterlayer'),
                        'bottom'     => __( 'Bottom', 'masterlayer'),
                    ],
                    'condition' => [
                         'prevNextButtons' => 'true'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowMiddleOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button.previous' => 'left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .flickity-prev-next-button.next' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'middle'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowTopOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'top'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowBottomOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'bottom'
                    ]
                ]
            );

            $this->add_control(
                'pageDots',
                [
                    'label'        => __( 'Show Bullets?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'separator'    => 'before'
                ]
            );

            $this->add_responsive_control(
                'dotOffset',
                [
                    'label' => __( 'Bullets Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();



        // Settings - Project
            $this->start_controls_section( 'setting_project_section',
                [
                    'label' => __( 'Project', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                    'condition' => [ 'style' => 'none']
                ]
            );

            $this->add_control(
                'url_heading',
                [
                    'label'     => __( 'URL', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'url_type',
                [
                    'label'     => __( 'URL Type', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'link',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'link'      => __( 'Link', 'masterlayer'),
                        'button'    => __( 'Button', 'masterlayer'),
                        'title'   => __( 'Title', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'url_text',
                [
                    'label'   => __( 'URL Text', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Read More', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [ 'url_type!' => ['none', 'title'] ]
                ]
            );

            $this->add_control(
                'link_icon_position',
                [
                    'label'     => __( 'Has Icon ?', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'right',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'left'      => __( 'Icon Left', 'masterlayer'),
                        'right'     => __( 'Icon Right', 'masterlayer')
                    ],
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_icon',
                [
                    'label' => __( 'Link Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow2',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'button_style',
                [
                    'label'     => __( 'Button Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'btn-accent',
                    'options'   => [
                        'btn-accent'      => __( 'Accent', 'masterlayer'),
                        'btn-white'       => __( 'White', 'masterlayer'),
                        'btn-outline'     => __( 'Outline', 'masterlayer')
                    ],
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_icon_position',
                [
                    'label'     => __( 'Has Icon ?', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'right',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'left'      => __( 'Icon Left', 'masterlayer'),
                        'right'     => __( 'Icon Right', 'masterlayer')
                    ],
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Button Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow2',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->end_controls_section();

        // Color
            $this->start_controls_section( 'setting_style_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );  

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'box_bg',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .master-project .content-wrap',
                    'fields_options' => [
                        'background' => [ 'label' => __( 'Content Background', 'masterlayer' ) ],
                        'color' => [ 'label' => __( '- Color', 'masterlayer') ],
                        'image' => [ 'label' => __( '- Image', 'masterlayer') ],
                    ],
                ]
            );

            $this->add_control(
                'arrow_bg',
                [
                    'label' => __( 'Arrow Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .arrow' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'arrow_color',
                [
                    'label' => __( 'Arrow Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .arrow' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->start_controls_tabs( 'box' );

            // Normal
                $this->start_controls_tab(
                    'box_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'title_color',
                    [
                        'label' => __( 'Title', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-project .headline-2' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'cat_color',
                    [
                        'label' => __( 'Category', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-project .cat-item' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();
            
            //Hover 
                $this->start_controls_tab(
                    'project_box_hover',
                    [
                        'label' => __( 'Text Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'title_color_hover',
                    [
                        'label' => __( 'Title', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-project .headline-2:hover' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'cat_color_hover',
                    [
                        'label' => __( 'Category', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-project .cat-item:hover' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();

        // Border & Shadow   
            $this->start_controls_section( 'border_style_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'arrow_border_radius',
                [
                    'label' => __('Arrow Border Radius', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-project .arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->start_controls_tabs( 'box2' );

            // Normal
                $this->start_controls_tab(
                    'box2_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'border_heading',
                    [
                        'label' => __( 'Border', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selectors' => '{{WRAPPER}} .master-project',
                    ]
                );

                $this->add_control(
                    'rounded_heading',
                    [
                        'label' => __( 'Rounded', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
                    'border_radius',
                    [
                        'label' => __('Rounded', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .master-project' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                        ],
                    ]
                );

                $this->add_control(
                    'shadow_heading',
                    [
                        'label' => __( 'Box Shadow', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow',
                        'selectors' => '{{WRAPPER}} .master-project',
                    ]
                );

                $this->end_controls_tab();

            // Hover
                $this->start_controls_tab(
                    'project_box2_hover',
                    [
                        'label' => __( 'Active', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'border_heading_hover',
                    [
                        'label' => __( 'Border', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selectors' => '{{WRAPPER}} .master-project.active',
                    ]
                );

                $this->add_control(
                    'rounded_heading_hover',
                    [
                        'label' => __( 'Rounded', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
                    'border_radius_hover',
                    [
                        'label' => __('Rounded', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'selectors' => [
                            '{{WRAPPER}} .master-project:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                        ],
                    ]
                );

                $this->add_control(
                    'shadow_heading_hover',
                    [
                        'label' => __( 'Box Shadow', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow_hover',
                        'selectors' => '{{WRAPPER}} .master-project.active',
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // URL
            $this->start_controls_section( 'setting_url_section',
                [
                    'label' => __( 'URL', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [ 'style' => 'none' ]
                ]
            );

            $this->add_control(
                'url_title_color_hover',
                [
                    'label' => __( 'Title Hover Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .headline-2:hover' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'title',
                    ]
                ]
            );

            // URL - Link
            $this->add_responsive_control(
                'link_icon_font_size',
                [
                    'label'      => __( 'Icon Font Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_margin',
                [
                    'label' => __('Icon Margin', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .master-link .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->start_controls_tabs( 'link_hover_tabs' );

            // Link normal
            $this->start_controls_tab(
                'link_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            // Box hover
            $this->start_controls_tab(
                'link_box_hover',
                [
                    'label' => __( 'Box Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-link' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color_box_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-link .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            // Link hover
            $this->start_controls_tab(
                'link_hover',
                [
                    'label' => __( 'URL Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            // URL - Button
            $this->add_responsive_control(
                'button_icon_font_size',
                [
                    'label'      => __( 'Icon Font Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-button .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_margin',
                [
                    'label' => __('Icon Margin', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .master-button .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->start_controls_tabs( 'button_hover_tabs' );

            // Button normal
            $this->start_controls_tab(
                'button_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selectors' => '{{WRAPPER}} .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            // Box hover
            $this->start_controls_tab(
                'button_box_hover',
                [
                    'label' => __( 'Box Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-button' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color_box_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-button .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color_box_hover',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-button' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded_box_hover',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color_box_hover',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-button' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width_box_hover',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow_box_hover',
                    'selectors' => '{{WRAPPER}} .master-project:hover .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            // Button hover
            $this->start_controls_tab(
                'button_hover',
                [
                    'label' => __( 'URL Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button:hover' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button:hover .icon' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color_hover',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .master-button:hover' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded_hover',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-project .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color_hover',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .master-button:hover' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width_hover',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-project .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow_hover',
                    'selectors' => '{{WRAPPER}} .master-project .master-button:hover',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // Spacing
            $this->start_controls_section( 'setting_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-project .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cat_spacing',
                [
                    'label'      => __( 'Category Bottom Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-project .cat-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                ]
            );

            $this->end_controls_section();

        // Typography
            $this->start_controls_section( 'setting_typography_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'headline_typography',
                    'label' => __('Title', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .headline-2'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cat_typography',
                    'label' => __('Category', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .cat-item'
                ]
            );

            $this->end_controls_section();
            
        // Arrows
            $this->start_controls_section( 'setting_arrows_section',
                [
                    'label' => __( 'Arrows', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                     'prevNextButtons' => 'true'
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'arrow_size',
                [
                    'label' => __( 'Icon Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template'
                ]
            );
            
            $this->add_responsive_control(
                'arrow_wsize',
                [
                    'label' => __( 'Arrows Width', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button, {{WRAPPER}} .master-carousel-box .flickity-button:before' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template'
                ]
            );
            
            $this->add_responsive_control(
                'arrow_hsize',
                [
                    'label' => __( 'Arrows Height', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button, {{WRAPPER}} .master-carousel-box .flickity-button:before' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template'
                ]
            );
            
            $this->start_controls_tabs( 'a_hover_tabs' );

            // Arrows normal
            $this->start_controls_tab(
                'a_normal',
                [
                    'label' => __( 'Default', 'masterlayer' ),
                ]
            );
            
            $this->add_control(
                'a_color_normal',
                [
                    'label' => __( 'Arrows Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button' => 'color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->add_control(
                'a_bg_normal',
                [
                    'label' => __( 'Arrows Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button' => 'background-color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->end_controls_tab();
            
            $this->start_controls_tab(
                'a_hover',
                [
                    'label' => __( 'Hover', 'masterlayer' ),
                ]
            );
            
            $this->add_control(
                'a_color_h',
                [
                    'label' => __( 'Arrows Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button:hover' => 'color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->add_control(
                'a_bg_h',
                [
                    'label' => __( 'Arrows Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button:hover' => 'background-color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->end_controls_tab();
            
            $this->start_controls_tab(
                'a_disable',
                [
                    'label' => __( 'Disabled', 'masterlayer' ),
                ]
            );
            
            $this->add_control(
                'a_color_dd',
                [
                    'label' => __( 'Arrows Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button:disabled' => 'color: {{VALUE}} !important;',
                    ]
                ]
            );
            
            $this->add_control(
                'a_bg_d',
                [
                    'label' => __( 'Arrows Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button:disabled' => 'background-color: {{VALUE}} !important;',
                    ]
                ]
            );
            
            $this->add_control(
                'a_opacity_d',
                [
                    'label'     => __( 'Opacity', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 0.5,
                    'min'     => 0,
                    'max'     => 1,
                    'step'    => 0.1,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-button:disabled' => 'opacity: {{VALUE}} !important;',
                    ],
                ]
            );
            
            $this->end_controls_tab();
            
            $this->end_controls_tabs();
            $this->end_controls_section();
            
        // Dots
            $this->start_controls_section( 'setting_dots_section',
                [
                    'label' => __( 'Bullets', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'pageDots' => 'true'
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'dots_size',
                [
                    'label' => __( 'Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-page-dots .dot, {{WRAPPER}} .master-carousel-box .flickity-page-dots .dot:after' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template'
                ]
            );
            
            $this->add_responsive_control(
                'dots_space',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'defautl' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-page-dots .dot' => 'margin: 0 {{SIZE}}{{UNIT}} !important;',
                    ]
                ]
            );
            
            $this->start_controls_tabs( 'd_hover_tabs' );

            // Dots normal
            $this->start_controls_tab(
                'd_normal',
                [
                    'label' => __( 'Default', 'masterlayer' ),
                ]
            );
            
            $this->add_control(
                'd_color_n',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-page-dots .dot:after' => 'background-color: {{VALUE}}; opacity: 1;',
                    ]
                ]
            );
            
            $this->end_controls_tab();
            
            // Dots hover
            $this->start_controls_tab(
                'd_hover',
                [
                    'label' => __( 'Hover', 'masterlayer' ),
                ]
            );
            
            $this->add_control(
                'd_color_h',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-page-dots .dot:hover:after' => 'background-color: {{VALUE}}; opacity: 1;',
                    ]
                ]
            );
            
            $this->end_controls_tab();
            
            // Dots active
            $this->start_controls_tab(
                'dactive',
                [
                    'label' => __( 'Active', 'masterlayer' ),
                ]
            );
            
            $this->add_control(
                'd_color_a',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .flickity-page-dots .dot.is-selected:after' => 'background-color: {{VALUE}}; opacity: 1;',
                    ]
                ]
            );
            
            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type' => 'project',
            'posts_per_page' => $settings['posts_per_page']
        ];

        if ( $settings['cat_slug'] ) {
            $arr = explode(',',$settings['cat_slug'],10);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'project_category',
                    'field'    => 'slug',
                    'operator' => 'IN',
                    'terms'    => $arr
                ),
            );
        }

        if ( $settings['exclude_cat_slug'] ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'project_category',
                    'field' => 'slug',
                    'terms' => $settings['exclude_cat_slug'],
                    'operator' => 'NOT IN'
                ],
            ];
        }
        $query = new \WP_Query( $args );
        if ( ! $query->have_posts() ) { esc_html_e( 'Project item not found!', 'masterlayer' ); return; }

        // Data config for carousel
        if ( isset($settings['column']) )
            $config['column'] = $settings['column']['size'];
        if ( isset($settings['column_tablet']) )
            $config['columnTablet'] = $settings['column_tablet']['size'];
        if ( isset($settings['column_mobile']) )
            $config['columnMobile'] = $settings['column_mobile']['size'];
        if ( isset($settings['column_widescreen']) )
            $config['columnWidescreen'] = $settings['column_widescreen']['size'];
        if ( isset($settings['column_tablet_extra']) )
            $config['columnTabletExtra'] = $settings['column_tablet_extra']['size'];
        if ( isset($settings['column_mobile_extra']) )
            $config['columnMobileExtra'] = $settings['column_mobile_extra']['size'];
        if ( isset($settings['column_laptop']) )
            $config['columnLaptop'] = $settings['column_laptop']['size'];
        if ( isset($settings['gap']) )
            $config['gap'] = $settings['gap']['size'];
        if ( isset($settings['gap_tablet']) )
            $config['gapTablet'] = $settings['gap_tablet']['size'];
        if ( isset($settings['gap_mobile']) )
            $config['gapMobile'] = $settings['gap_mobile']['size'];
        if ( isset($settings['gap_widescreen']) )
            $config['gapWidescreen'] = $settings['gap_widescreen']['size'];
        if ( isset($settings['gap_tablet_extra']) )
            $config['gapTabletExtra'] = $settings['gap_tablet_extra']['size'];
        if ( isset($settings['gap_mobile_extra']) )
            $config['gapMobileExtra'] = $settings['gap_mobile_extra']['size'];
        if ( isset($settings['gap_laptop']) )
            $config['gapLaptop'] = $settings['gap_laptop']['size'];
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? $settings['autoPlaySpeed'] : false;
        $config['pauseAutoPlayOnHover'] = $settings['pauseAutoPlayOnHover'] == 'true' ? true : false;
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;
        $config['stretch'] = $settings['stretch'];
        $config['activeIndex'] = $settings['activeIndex'];
        
        if ($settings['slide_anim'] == 'fade') {
            wp_enqueue_style('flickity-fade');
            wp_enqueue_script('flickity-fade');
            $config['fade'] = true;
        }

        //Image Size
        $imageSize = 'mae-project';
        if ( $settings['imageSize'] !== 'default' ) $imageSize = $settings['imageSize'] ;

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        ?>

        <div class="master-carousel-box" <?php echo $data; ?>>
            <?php
            if ( $query->have_posts() ) { ?>
                <?php while ( $query->have_posts() ) {
                    $query->the_post(); 
                    $url = $desc = $title = $arrow = $cats = $overlay = '';
                    $cls = 'item-carousel ';

                    // Title
                    $title = sprintf(
                        '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                        esc_html( get_the_title() ),
                        esc_url( get_the_permalink() ) );  

                    // Desciption
                    if ( mae_get_mod('project_desc') ) {
                        $desc = sprintf('<div class="desc"><div class="inner">%1$s</div></div>', mae_get_mod('project_desc'));
                    } else {
                        $excerpt = get_the_excerpt();
                        $excerpt = substr($excerpt, 0, 50);
                        $desc = sprintf('<div class="desc"><div class="inner">%1$s</div></div>', $excerpt );
                    }
                    
                    // Image
                    if ( has_post_thumbnail( get_the_ID() ) ) {
                        $attr = wp_get_attachment_metadata( get_post_thumbnail_id( get_the_ID() ) );

                        $width = $attr['sizes'][$imageSize]['width'];
                        $height = $attr['sizes'][$imageSize]['height'];
                        $img_url = get_the_post_thumbnail_url(get_the_ID(), $imageSize);
                        $image_alt = get_post_meta(get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', TRUE);
                        if ( empty( $image_alt )) $image_alt = get_the_title();
                        $image = sprintf(
                            '<a class="thumb" href="%2$s" aria-label="%3$s"><span class="inner"><img src="%1$s" alt="%4$s" width="%5$s" height="%6$s"/></span></a>',
                            esc_attr($img_url),
                            esc_url( get_the_permalink() ),
                            esc_html( get_the_title() ),
                            esc_attr($image_alt),
                            esc_attr($width),
                            esc_attr($height)
                        );
                    }

                    // URL
                    if ( $settings['url_type'] == 'link' || 'button')
                        $url = $this->render_link( get_the_permalink(), $settings['url_text'] );

                    $arrow = $this->render_arrow();

                    // Category
                    $terms = get_the_terms( get_the_ID() , 'project_category' );

                    if ($terms) {
                        $cats .= '<div class="cat-wrap">';
                        if (array_key_exists(0, $terms)) 
                            $cats .= '<a class="cat-item" aria-label="' . esc_attr($terms[0]->name) . '"
                                href="' . esc_url( get_term_link( $terms[0]->slug, 'project_category' ) ) . '">' . 
                                esc_html( $terms[0]->name) . '</a>';
                                
                         if (array_key_exists(1, $terms)) 
                            $cats .= '<span class="cat-sep">/</span><a class="cat-item" aria-label="' . esc_attr($terms[0]->name) . '"
                                 href="' .esc_url( get_term_link( $terms[1]->slug, 'project_category' ) ) . '">' . 
                                esc_html( $terms[1]->name) . '</a>';
                        $cats .= '</div>';
                    }

                    // Overlay
                    if ($settings['overlay_custom'] == 'yes') {
                        if ($settings['overlay_image']['id']) {
                            $overlay = sprintf('<div class="overlay">%1$s</div>', 
                                wp_get_attachment_image( $settings['overlay_image']['id'], 'full' ));
                        } else {
                            $overlay = sprintf('<div class="overlay"><img alt="Image" src="%1$s" ></div>', 
                                esc_url( $settings['overlay_image']['url'] ) );
                        }
                    }

                    ?>

                    <div class="master-project <?php echo esc_attr($cls); ?>">
                        <?php 
                        echo $overlay;
                        echo $image;

                        echo '<div class="content-wrap">';
                            if ($settings['show_cat'] == 'true') echo $cats;
                            echo $title;
                            if ($settings['show_desc'] == 'true') echo $desc;
                            echo $arrow;
                        echo '</div>';

                        echo $arrow;
                        ?>

                    </div>
                <?php } \wp_reset_postdata();
            }  ?>
        </div>
    <?php }

    public function render_link( $url, $text ) {
        $link = $this->get_settings_for_display();

        if ($link['url_type'] == 'link') {
            $cls = "";
            $cls .= ' icon-' . $link['link_icon_position'];

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        } else if ($link['url_type'] == 'button') {
            $button = $link;
            $cls = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'];

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button small <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        }
        

    }

    public function render_arrow() {
        $settings = $this->get_settings_for_display();

        ob_start(); ?>
        <a aria-label="button" class="arrow" href="<?php echo esc_url( get_the_permalink() ); ?>">
            <?php Icons_Manager::render_icon( $settings['arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </a>
        <?php 
        $return = ob_get_clean();
        return $return;
    }
}

