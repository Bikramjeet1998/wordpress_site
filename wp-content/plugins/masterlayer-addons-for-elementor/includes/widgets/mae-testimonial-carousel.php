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

class MAE_Testimonial_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-testimonial-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Testimonial Carousel', 'masterlayer' );
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

        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'avatar',
                [
                    'label'   => __( 'Avatar', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
                ]
            );

            $repeater->add_control(
                'name',
                [
                    'label'   => __( 'Name', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'New Member', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'role',
                [
                    'label'   => __( 'Role', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Manager', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'comment',
                [
                    'label'      => __( 'Comment', 'masterlayer' ),
                    'type'       => Controls_Manager::WYSIWYG,
                    'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );


            $this->add_control(
                'testimonials',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'name'  => __( 'Client #1', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Client #2', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Client #3', 'masterlayer' ),
                        ],
                    ],
                    'title_field' => '{{{ name }}}',
                ]
            );

            $this->end_controls_section();

        // Carousel settings
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

            $this->add_control(
                'dotPosition',
                [
                    'label'     => __( 'Dots Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'center',
                    'options'   => [
                        'left'      => __( 'Left', 'masterlayer'),
                        'center'     => __( 'Center', 'masterlayer'),
                        'right'     => __( 'Right', 'masterlayer'),
                    ],
                    'condition' => [
                         'pageDots' => 'true'
                    ],
                    'prefix_class' => 'dot-'
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

            $this->end_controls_section();

        // Settings TAB
            $this->start_controls_section( 'setting_test_section',
                [
                    'label' => __( 'Testimonial', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
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
                        'style-3'      => __( 'Style 3', 'masterlayer'),
                        'style-4'      => __( 'Style 4', 'masterlayer'),
                    ],
                    'prefix_class' => 'testimonial-',
                    'render_type' => 'template'
                ]
            );
            
            $this->add_control(
                'show_quote',
                [
                    'label'        => __( 'Quotes Icon', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );
            
            $this->add_control(
                'show_rating',
                [
                    'label'        => __( 'Rating', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );
            
            $this->add_responsive_control(
                'start_size',
                [
                    'label'      => __( 'Stars Size', 'rieckermann' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .star-rating > span' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'show_rating' => 'true', ],
                    'render_type' => 'template'
                ]
            );
        
            $this->add_control(
                'avatar_heading',
                [
                    'label'     => __( 'Avatar', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'avatar_bg',
                    'selector' => '{{WRAPPER}} .master-testimonial .avatar',
                ]
            );

            $this->add_control(
                'avatar_padding',
                [
                    'label' => __('Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-testimonial .avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();

        // Color
            $this->start_controls_section( 'style_color_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            
            $this->add_control(
                'content_bg',
                [
                    'label' => __( 'Content Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'name_color',
                [
                    'label' => __( 'Name Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial .name' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'role_color',
                [
                    'label' => __( 'Role Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial .role' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'desc_color',
                [
                    'label' => __( 'Description Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial .comment' => 'color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->add_control(
                'rating_color',
                [
                    'label' => __( 'Stars Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial .star-rating > span' => 'color: {{VALUE}};',
                    ],
                    'condition' => ['show_rating' => 'true']
                ]
            );

            $this->end_controls_section();
          

        // Border & Shadow
            $this->start_controls_section( 'style_border_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => __( 'Border', 'masterlayer' ),
                    'selectors' => '{{WRAPPER}} .master-testimonial',
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
                        '{{WRAPPER}} .master-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'selectors' => '{{WRAPPER}} .master-testimonial',
                ]
            );

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
                        '{{WRAPPER}} .master-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'avatar_bottom_margin',
                [
                    'label'      => __( 'Avatar', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .content-wrap' => 'padding-top: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'name_bottom_margin',
                [
                    'label'      => __( 'Name', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .name' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'role_bottom_margin',
                [
                    'label'      => __( 'Role', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .role' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'comment_bottom_margin',
                [
                    'label'      => __( 'Comment', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .comment' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );
            
            $this->add_control(
                'rating_padding',
                [
                    'label' => __('Stars Rating Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial .star-rating > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => ['show_rating' => 'true']
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
                'name' => 'name_typography',
                'label' => __('Name', 'masterlayer'),
                'selector' => '{{WRAPPER}} .name'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'role_typography',
                'label' => __('Role', 'masterlayer'),
                'selector' => '{{WRAPPER}} .role'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comment_typography',
                'label' => __('Comment', 'masterlayer'),
                'selector' => '{{WRAPPER}} .comment'
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
        $testimonials = $this->get_settings_for_display( 'testimonials' );

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
        
        $config['activeIndex'] = $settings['activeIndex'];
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? $settings['autoPlaySpeed'] : false;
        $config['pauseAutoPlayOnHover'] = $settings['pauseAutoPlayOnHover'] == 'true' ? true : false;
        $config['stretch'] = $settings['stretch'];
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;
        if ($settings['slide_anim'] == 'fade') {
            wp_enqueue_style('flickity-fade');
            wp_enqueue_script('flickity-fade');
            $config['fade'] = true;
        }

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-carousel-box" <?php echo $data; ?>>
            <?php
            foreach ( $testimonials as $index => $item ) { 
                $html = $name = $role = $comment = $avatar = $rating = $quotes = "";
                
                // Name
                if ($item['name'])
                    $name = sprintf('<h3 class="name">%1$s</h3>', 
                        esc_html( $item['name'] ) );

                // Role
                if ($item['role'])
                    $role = sprintf('<div class="role">%1$s</div>', 
                        esc_html( $item['role'] ) );

                // Comment
                if ($item['comment'])
                    $comment = sprintf('<div class="comment">%1$s</div>', 
                        $item['comment'] );

                // Avatar
                if ($item['avatar'])
                    $avatar = sprintf('<div class="avatar">%1$s</div>', 
                        wp_get_attachment_image( $item['avatar']['id'], 'full' ) );
                        
                // Quotes
                if ($settings['show_quote'] == 'true')
                    $quotes = '<span class="quote"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                            <path d="M14.1933422,9.4116497c-7.8260994,0-14.1922989,6.3662004-14.1922989,14.1924
                                c0,7.5498009,5.9247999,13.7420998,13.3690996,14.169899c0.1288996,1.3916016,0.0321999,5.1797028-3.5977001,10.4491997
                                C9.4980431,48.6206512,9.547843,49.1567497,9.888648,49.497551c1.4853945,1.4853973,2.4033947,2.4208984,3.0458946,3.0751991
                                c0.8408995,0.8554993,1.2247,1.2461014,1.7861996,1.7559013c0.1904001,0.1727982,0.4306002,0.259697,0.6719055,0.259697
                                c0.2342949,0,0.4676943-0.0819969,0.6561956-0.2450981c6.3251991-5.5038986,13.3515987-16.8759995,12.3349991-30.8115005
                                C27.7881413,15.3501501,21.820343,9.4116497,14.1933422,9.4116497z M15.4023428,52.2221489
                                c-0.2723999-0.2684975-0.5830002-0.5848999-1.0410004-1.0508003c-0.5565996-0.5672989-1.3203001-1.3446999-2.4784994-2.5067978
                                c4.4053001-6.7881012,3.5731993-11.6230011,3.2089996-12.3164024c-0.1729002-0.3290977-0.5274-0.5507965-0.8985004-0.5507965
                                c-6.7225995,0-12.1922989-5.4697018-12.1922989-12.1933022c0-6.7227001,5.4696999-12.1924,12.1922989-12.1924
                                c6.5489006,0,11.6777992,5.1582012,12.1963062,12.2646008C27.5322418,39.3501511,18.2168427,49.5268517,15.4023428,52.2221489z"/>
                            <path d="M63.9004402,23.5317497v-0.0009995C63.302742,15.3501501,57.3340416,9.4116497,49.7090416,9.4116497
                                c-7.8261986,0-14.1933937,6.3662004-14.1933937,14.1924c0,7.5498009,5.9257927,13.7420998,13.3710938,14.169899
                                c0.1289062,1.3906021,0.0312004,5.1767006-3.5996017,10.4491997c-0.2743988,0.3975029-0.2245979,0.9336014,0.1162033,1.2744026
                                c1.4794998,1.4794998,2.3955002,2.4130974,3.0380974,3.0663986c0.8446999,0.8613014,1.2304993,1.2538986,1.7949028,1.7656021
                                c0.1903992,0.1718979,0.4315987,0.2587967,0.6718979,0.2587967c0.2344055,0,0.4678001-0.0819969,0.6562004-0.2460976
                                C57.8896484,48.8383484,64.9160385,37.4663506,63.9004402,23.5317497z M50.917942,52.2221489
                                c-0.2743988-0.2705002-0.5877991-0.5887985-1.0498009-1.0594978c-0.5565987-0.5665016-1.3172989-1.3418007-2.4706993-2.4981003
                                c4.4053001-6.7891006,3.5742989-11.6230011,3.2109985-12.3164024c-0.1728973-0.3280983-0.5282974-0.5507965-0.8993988-0.5507965
                                c-6.7237015,0-12.1933937-5.4697018-12.1933937-12.1933022c0-6.7227001,5.4696922-12.1924,12.1933937-12.1924
                                c6.5477982,0,11.6777,5.1582012,12.1972008,12.2656002v-0.0009995
                                C63.0478401,39.3481483,53.7324409,49.5268517,50.917942,52.2221489z"/>
                        </svg></span>';
                        
                // Rating
                if ($settings['show_rating'] == 'true')
                    $rating = '<div class="star-rating"><span class="ci-star1"></span><span class="ci-star1"></span><span class="ci-star1"></span><span class="ci-star1"></span><span class="ci-star1"></span></div>';

                $cls1 = 'item-carousel ';
                $cls1 .= 'elementor-repeater-item-' . $item['_id']
                ?>
                <?php switch ($settings["style"]) {
                    case 'style-1': 
                    case 'style-2': ?>
                        <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                            <div class="inner">
                                <div class="avatar-wrap">
                                    <?php echo $avatar; ?>
                                    <div class="author-wrap">
                                        <?php
                                        echo $rating;
                                        echo $name;
                                        echo $role;
                                        ?>
                                    </div>
                                </div>

                                <div class="content-wrap">
                                    <?php echo $comment; ?>
                                    <?php echo $quotes; ?>
                                </div>
                            </div>
                        </div>
                        <?php break;
                    case 'style-4': ?>
                        <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                            <?php echo $avatar; ?>

                            <div class="inner">
                                <div class="avatar-wrap">
                                    <div class="author-wrap">
                                        <?php
                                        echo $name;
                                        echo $role;
                                        ?>
                                    </div>

                                    <span class="quote"><svg viewBox="0 -72 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m207.800781 0h-192.800781c-8.285156 0-15 6.714844-15 15v192.800781c0 8.285157 6.714844 15 15 15h81.398438v129.601563c0 8.28125 6.714843 15 15 15h48.203124c6.457032 0 12.1875-4.132813 14.226563-10.257813l48.199219-144.601562c.511718-1.527344.773437-3.128907.773437-4.742188v-192.800781c0-8.285156-6.714843-15-15-15zm0 0"/><path d="m497 0h-192.800781c-8.285157 0-15 6.714844-15 15v192.800781c0 8.285157 6.714843 15 15 15h81.402343v129.601563c0 8.28125 6.714844 15 15 15h48.199219c6.457031 0 12.1875-4.132813 14.230469-10.257813l48.199219-144.601562c.507812-1.527344.769531-3.128907.769531-4.742188v-192.800781c0-8.285156-6.714844-15-15-15zm0 0"/></svg></span>
                                </div>

                                <div class="content-wrap">
                                    <?php echo $comment; ?>
                                </div>
                            </div>
                        </div>
                        <?php break;
                    case 'style-3': ?>
                        <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                            <div class="avatar-wrap">
                                <?php echo $avatar; ?>
                            </div>

                            <div class="content-wrap">
                                <span class="quote"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <path d="M224.001,74.328c5.891,0,10.667-4.776,10.667-10.667s-4.776-10.667-10.667-10.667
                                        c-123.653,0.141-223.859,100.347-224,224v64c-0.185,64.99,52.349,117.825,117.338,118.01
                                        c64.99,0.185,117.825-52.349,118.01-117.338c0.185-64.99-52.349-117.825-117.338-118.01c-38.374-0.109-74.392,18.499-96.506,49.861
                                        C23.48,163.049,113.514,74.485,224.001,74.328z"/>
                                    <path d="M394.667,223.662c-38.154,0.03-73.905,18.63-95.829,49.856
                                        c1.976-110.469,92.01-199.033,202.496-199.189c5.891,0,10.667-4.776,10.667-10.667s-4.776-10.667-10.667-10.667
                                        c-123.653,0.141-223.859,100.347-224,224v64c0,64.801,52.532,117.333,117.333,117.333S512,405.796,512,340.995
                                        S459.469,223.662,394.667,223.662z"/>
                                </svg></span>
                                
                                <?php 
                                echo $comment; 
                                ?>

                                <div class="author-wrap">
                                    <?php
                                    echo $name;
                                    echo $role;
                                    ?>
                                </div>

                                

                            </div>
                        </div>
                        <?php break;
                    default: ?>
                        <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                            <div class="avatar-wrap">
                                <?php echo $avatar; ?>
                            </div>

                            <div class="content-wrap">
                                <?php 
                                echo $comment; 
                                ?>

                                <div class="author-wrap">
                                    <?php
                                    echo $name;
                                    echo $role;
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            <?php } ?>
        </div>

        <?php
    }

    protected function render_icon( $icon ) {
        $icon_string = '';
        ob_start(); 

        Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );

        $icon_string = ob_get_clean();
        return $icon_string;
    }
}

