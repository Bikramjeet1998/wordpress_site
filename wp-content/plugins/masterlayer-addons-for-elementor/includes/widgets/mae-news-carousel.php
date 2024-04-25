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

class MAE_News_Carousel_Widget extends Widget_Base {

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
        return 'mae-news-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - News Carousel', 'masterlayer' );
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
            $this->start_controls_section( 'setting_general_section',
                [
                    'label' => __( 'General', 'masterlayer' )
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

            $this->add_control(
                'num_words',
                [
                    'label'     => __( 'Excerpt: Num Words', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'step'    => 1
                ]
            );

            $this->end_controls_section();

            // News
            $this->start_controls_section( 'setting_news_section',
                [
                    'label' => __( 'News', 'masterlayer' ),
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
                    'prefix_class' => 'news-',
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
                    'default'   => 'none',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'link'      => __( 'Link', 'masterlayer'),
                        'button'    => __( 'Button', 'masterlayer'),
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

            if ( is_rtl() ) {
                $this->add_control(
                    'link_icon_position',
                    [
                        'label'     => __( 'Has Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'right',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'right'      => __( 'Icon Left', 'masterlayer'),
                            'left'     => __( 'Icon Right', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'link' ]
                    ]
                );
            } else {
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
            }
            

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
                'btn_hover',
                [
                    'label'     => __( 'Button Hover Effect', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'btn-hover-2',
                    'options'   => [
                        'btn-hover-1'      => __( 'Style 1', 'masterlayer'),
                        'btn-hover-2'      => __( 'Style 2', 'masterlayer'),
                    ],
                    'condition' => [ 'url_type' => 'button' ]
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
                    'default'   => 'none',
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

            $this->add_control(
                'meta_heading',
                [
                    'label'     => __( 'Metas', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );
            
            $this->add_control(
                'meta_box',
                [
                    'label'     => __( 'Floating Box', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'date',
                    'options'   => [
                        'none'        => __( 'None', 'masterlayer'),
                        'date'     => __( 'Date', 'masterlayer'),
                        'category'      => __( 'Category', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'author_style',
                [
                    'label'     => __( 'Author Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => [
                        'default'       => __( 'with icon', 'masterlayer'),
                        'avatar'        => __( 'with avatar', 'masterlayer'),
                    ],
                    'prefix_class' => 'author-'
                ]
            );

            $this->add_control(
                'author_text',
                [
                    'label'     => __( 'Author Prefix', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [
                        'active'   => true,
                    ]
                ]
            );

            $this->add_control(
                'cat_text',
                [
                    'label'     => __( 'Category Prefix', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [
                        'active'   => true,
                    ]
                ]
            );

            $this->add_control(
                'meta_before_heading',
                [
                    'label'     => __( 'Metas Top', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'meta_author',
                [
                    'label'        => __( 'Author', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'true',
                ]
            );

            $this->add_control(
                'meta_date',
                [
                    'label'        => __( 'Date', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'true',
                ]
            );

            $this->add_control(
                'meta_comment',
                [
                    'label'        => __( 'Comments', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'meta_cat',
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
                'meta_after_heading',
                [
                    'label'     => __( 'Metas Bottom', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'meta_author_after',
                [
                    'label'        => __( 'Author', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'meta_date_after',
                [
                    'label'        => __( 'Date', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'meta_comment_after',
                [
                    'label'        => __( 'Comments', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'meta_cat_after',
                [
                    'label'        => __( 'Categories', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->end_controls_section();

        // Carousel
            $this->start_controls_section( 'setting_carousel_section',
                [
                    'label' => __( 'Carousel', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );
            
            // $this->add_control(
            //     'lazyload',
            //     [
            //         'label'        => __( 'Lazy Load?', 'masterlayer' ),
            //         'type'         => Controls_Manager::SWITCHER,
            //         'label_on'     => __( 'On', 'masterlayer' ),
            //         'label_off'    => __( 'Off', 'masterlayer' ),
            //         'return_value' => 'true',
            //         'default'      => 'true',
            //     ]
            // );
            
            $this->add_control(
                'slide_anim',
                [
                    'label'     => __( 'Slide Animation', 'masterlayer'),
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

        // Color
            $this->start_controls_section( 'color_style_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
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
                        'content_color',
                        [
                            'label' => __( 'Content Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-news .content-wrap' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );
                    
                    $this->add_control(
                        'bottom_color',
                        [
                            'label' => __( 'Bottom Box Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-news .bottom-wrap' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['style' => 'style-1']
                        ]
                    );

                    $this->add_control(
                        'meta_color',
                        [
                            'label' => __( 'Meta', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-news .post-meta .item' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'title_color',
                        [
                            'label' => __( 'Title', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-news .headline-2' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'desc_color',
                        [
                            'label' => __( 'Description', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-news .desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                $this->end_controls_tab();

            // Hover
                $this->start_controls_tab(
                    'news_box_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );
                
                $this->add_control(
                    'content_colorh',
                    [
                        'label' => __( 'Content Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-news:hover .content-wrap' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
                
                $this->add_control(
                    'bottom_colorh',
                    [
                        'label' => __( 'Bottom Box Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-news:hover .bottom-wrap' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => ['style' => 'style-1']
                    ]
                );

                $this->add_control(
                    'meta_color_ho',
                    [
                        'label' => __( 'Meta', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-news:hover .meta-wrap .item' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'title_color_ho',
                    [
                        'label' => __( 'Title', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-news:hover .headline-2' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();
                
            $this->end_controls_tabs();
            
            $this->add_control(
                    'meta_color_hover',
                    [
                        'label' => __( 'Meta Hover', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-news .meta-wrap .item:hover' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'title_color_hover',
                    [
                        'label' => __( 'Title Hover', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-news .headline-2:hover' => 'color: {{VALUE}};',
                        ]
                    ]
                );
                
            $this->end_controls_section();

        // Border & Shadow
            $this->start_controls_section( 'bs_style_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'box1' );

                // Normal
                    $this->start_controls_tab(
                        'box1_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border',
                            'label' => __( 'Border', 'masterlayer' ),
                            'selectors' => '{{WRAPPER}} .master-news',
                        ]
                    );

                    $this->add_control(
                        'border_radius',
                        [
                            'label' => __('Content Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}}.news-style-2 .master-news .content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                                '{{WRAPPER}}.news-style-1 .master-news,
                                {{WRAPPER}}.news-style-3 .master-news' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'image_border_radius',
                        [
                            'label' => __('Image Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-news .thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'selectors' => '{{WRAPPER}} .master-news',
                        ]
                    );

                    $this->end_controls_tab();

                // Hover
                    $this->start_controls_tab(
                        'box1_hover',
                        [
                            'label' => __( 'Active', 'masterlayer' ),
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border_hover',
                            'label' => __( 'Border', 'masterlayer' ),
                            'selectors' => '{{WRAPPER}} .master-news:hover',
                        ]
                    );

                    $this->add_control(
                        'border_radius_hover',
                        [
                            'label' => __('Content Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .master-news:hover .content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'image_radius_hover',
                        [
                            'label' => __('Image Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .master-news:hover .thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow_hover',
                            'selectors' => '{{WRAPPER}} .master-news.active',
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
                    'condition' => [ 'url_type!' => 'none' ]
                ]
            );

            $this->add_control(
                'url_title_color_hover',
                [
                    'label' => __( 'Title Hover Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-news .headline-2:hover' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-link .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'label' => __( 'Active', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-news.active .master-link' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-news.active .master-link .icon' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-button .content-base' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-button .content-base .icon' => 'color: {{VALUE}};',
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
                    'label' => __( 'Active', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-news.active .master-button .content-base' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-news.active .master-button .content-base .icon' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-news.active .master-button' => 'background-color: {{VALUE}};',
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
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news.active .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-news.active .master-button' => 'border-color: {{VALUE}};'
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
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news.active .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'selectors' => '{{WRAPPER}} .master-news.active .master-button',
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
                        '{{WRAPPER}} .master-button .content-hover' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .master-button .content-hover .icon' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .master-news .master-button .bg-hover' => 'background-color: {{VALUE}}',
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
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-news .master-button:hover' => 'border-color: {{VALUE}};'
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
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'selectors' => '{{WRAPPER}} .master-news .master-button:hover',
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
                'margin',
                [
                    'label' => __('Box Margin', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
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
                        '{{WRAPPER}} .master-news .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_space',
                [
                    'label' => __( 'Meta', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news .post-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_space',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'desc_space',
                [
                    'label' => __( 'Description', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sep_space',
                [
                    'label' => __( 'Separator', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-news .sep' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_section();

        // Typography
            $this->start_controls_section( 'setting_typography_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'headline_typography',
                    'label' => __('Heading', 'masterlayer'),
                        'selector' => '{{WRAPPER}} .headline-2'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_typography',
                    'label' => __('Meta', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .post-meta .item'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'link_typography',
                    'label' => __('Link', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-link',
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => __('Button', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-button',
                    'condition' => [ 'url_type' => 'button' ]
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
                        '{{WRAPPER}} .flickity-page-dots .dot' => 'margin: 0 {{SIZE}}{{UNIT}} !importan;',
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

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page']
        );

        if ( $settings['cat_slug'] ) {
            $arr = explode(',',$settings['cat_slug'],10);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'operator' => 'IN',
                    'terms'    => $arr
                ),
            );
        }

        if ( $settings['exclude_cat_slug'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $settings['exclude_cat_slug'],
                    'operator' => 'NOT IN'
                ),
            );
        }

        $query = new \WP_Query( $args );
        if ( ! $query->have_posts() ) { esc_html_e( 'News item not found!', 'masterlayer' ); return; }

        //Image Size
        $imageSize = 'mae-news';
        if ( $settings['imageSize'] !== 'default' ) $imageSize = $settings['imageSize'] ;

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
        
        $config['stretch'] = $settings['stretch'];
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? $settings['autoPlaySpeed'] : false;
        $config['pauseAutoPlayOnHover'] = $settings['pauseAutoPlayOnHover'] == 'true' ? true : false;
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;
        $config['activeIndex'] = $settings['activeIndex'];
        if ($settings['slide_anim'] == 'fade') {
            wp_enqueue_style('flickity-fade');
            wp_enqueue_script('flickity-fade');
            $config['fade'] = true;
        }
        
        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        ?>

        <div class="master-carousel-box" <?php echo $data; ?>>
            <?php
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); 
                    $url = $desc = $title = $image = '';
                    $post_date = $metas = $metas_after = '';

                    $metas = $this->render_meta_before();
                    $metas_after = $this->render_meta_after();

                    // Post date
                    switch ( $settings['meta_box'] ) {
                        case 'date':
                            switch ( $settings['style'] ) {
                                case 'style-4':
                                    $post_date = sprintf(
                                    '<span class="post-date default"><span class="day">%1$s</span><span class="month">%2$s</span></span>', 
                                    get_the_date('d'), get_the_date('M'));
                                    break;
                                case 'style-3':
                                    $post_date = sprintf(
                                    '<span class="post-date square"><span>%1$s</span><span>%2$s</span></span>', 
                                    get_the_date('d'), get_the_date('M'));
                                    break;
                                case 'style-1':
                                case 'style-2':
                                    $post_date = sprintf('<span class="post-date default">%1$s</span>', 
                                    get_the_date('d M, Y'));
                                    break;
                                default: break;
                            }
                            break;
                        case 'category':
                            // Category
                            $terms = get_the_category(get_the_ID());
                            //var_dump($terms);
                            if ($terms) {
                                $cats = '<span class="cat-wrap">';
                                if (array_key_exists(0, $terms)) 
                                    $cats .= '<a class="cat-item" href="' . 
                                        esc_url( get_category_link( $terms[0]->term_id ) ) . '">' . 
                                        esc_html( $terms[0]->name) . '</a>';
                                        
                                 if (array_key_exists(1, $terms)) 
                                    $cats .= '<span class="cat-sep">/</span><a class="cat-item" href="' . 
                                        esc_url( get_category_link( $terms[1]->term_id ) ) . '">' . 
                                        esc_html( $terms[1]->name) . '</a>';
                                $cats .= '</span>';
                                
                                switch ( $settings['style'] ) {
                                    case 'style-1':
                                    case 'style-2':
                                        $post_date = sprintf(
                                        '<span class="post-date default">%1$s</span>', 
                                        $cats);
                                        break;
                                    default: break;
                                }
                            }

                           
                            break;
                        default:
                            $post_date = '';
                    }
                    
                    
                    // Title
                    $title = sprintf(
                        '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                        esc_html( get_the_title() ),
                        esc_url( get_the_permalink() ) );  

                    // Desciption
                    if ( is_numeric( $settings['num_words' ] ) && $settings['num_words' ] > 0 ) {
                        $desc = sprintf('<div class="desc">%1$s</div>', wp_trim_words(get_the_excerpt(), $settings['num_words' ], '') );
                    } else {
                        $desc = sprintf('<div class="desc">%1$s</div>', get_the_excerpt() );
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
                    
                    ?>

                    <div class="master-news item-carousel">
                        <?php 
                        echo '<div class="image-wrap">';
                            echo $image;
                            if ( $settings['meta_box'] !== 'none' ) echo $post_date;
                        echo '</div>';

                        echo '<div class="content-wrap">';
                            echo $metas;
                            echo $title;
                            if ($settings['show_desc'] == 'true') echo $desc;
                            echo '<div class="sep"></div>';
                            echo '<div class="bottom-wrap">';
                                echo $url;
                                echo $metas_after;
                            echo '</div>';
                        echo '</div>'
                        ?>

                    </div>
                <?php endwhile; 
            endif; wp_reset_postdata(); ?>
        </div>
    <?php }

    public function render_meta_before() {
        $settings = $this->get_settings_for_display();

        ob_start(); 
            echo '<div class="post-meta">';
            
            if ($settings['meta_author'] == 'true') {
                if ( $settings['author_style'] == 'default' ) {
                    printf( 
                        '<span class="post-by-author item"><span class="prefix">%4$s</span> 
                            <a class="name" href="%1$s" title="%2$s">%3$s</a>
                        </span>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( esc_html__( 'View all posts by %s', 'masterlayer' ), get_the_author() ) ),
                        get_the_author(),
                        $settings['author_text']
                    );
                } else {
                    printf( 
                        '<span class="post-by-author item">%5$s<span class="prefix">%4$s</span> 
                            <a class="name" href="%1$s" title="%2$s">%3$s</a>
                        </span>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( esc_html__( 'View all posts by %s', 'masterlayer' ), get_the_author() ) ),
                        get_the_author(),
                        $settings['author_text'],
                        get_avatar( get_the_author_meta( 'user_email' ), 'thumbnail' )
                    );
                }
            }

            if ($settings['meta_cat'] == 'true') {
                echo '<span class="post-meta-categories item">' . ($settings['cat_text'] == '') ? '' : $settings['cat_text'] .
                    esc_html( disle_get_mod( 'blog_before_category', '' ) ) . ' ';
                the_category( ', ', get_the_ID() );
                echo '</span>';
            }

            if ($settings['meta_comment'] == 'true') {
                if ( comments_open() || get_comments_number() ) {

                    echo '<span class="post-comment item"><span class="inner">';
                    comments_popup_link( esc_html__( '0 Comments', 'masterlayer' ), esc_html__( '1 Comment', 'masterlayer' ), esc_html__( '% Comments', 'masterlayer' ) );
                    echo '</span></span>';
                }
            }

            if ($settings['meta_date'] == 'true') {
                printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
                    get_the_date()
                );
            }

            echo '</div>';
        return ob_get_clean();
    }

    public function render_meta_after() {
        $settings = $this->get_settings_for_display();

        ob_start(); 
            echo '<div class="post-meta">';
            
            if ($settings['meta_author_after'] == 'true') {
                if ( $settings['author_style'] == 'default' ) {
                    printf( 
                        '<span class="post-by-author item"><span class="prefix">%4$s</span> 
                            <a class="name" href="%1$s" title="%2$s">%3$s</a>
                        </span>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( esc_html__( 'View all posts by %s', 'masterlayer' ), get_the_author() ) ),
                        get_the_author(),
                        $settings['author_text']
                    );
                } else {
                    printf( 
                        '<span class="post-by-author item">%5$s<span class="prefix">%4$s</span> 
                            <a class="name" href="%1$s" title="%2$s">%3$s</a>
                        </span>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( esc_html__( 'View all posts by %s', 'masterlayer' ), get_the_author() ) ),
                        get_the_author(),
                        $settings['author_text'],
                        get_avatar( get_the_author_meta( 'user_email' ), 'thumbnail' )
                    );
                }
            }

            if ($settings['meta_cat_after'] == 'true') {
                echo '<span class="post-meta-categories item">' . ($settings['cat_text'] == '') ? '' : $settings['cat_text'] .
                    esc_html( disle_get_mod( 'blog_before_category', '' ) ) . ' ';
                the_category( ', ', get_the_ID() );
                echo '</span>';
            }

            if ($settings['meta_comment_after'] == 'true') {
                if ( comments_open() || get_comments_number() ) {

                    echo '<span class="post-comment item"><span class="inner">';
                    comments_popup_link( esc_html__( '0 Comments', 'masterlayer' ), esc_html__( '1 Comment', 'masterlayer' ), esc_html__( '% Comments', 'masterlayer' ) );
                    echo '</span></span>';
                }
            }

            if ($settings['meta_date_after'] == 'true') {
                printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
                    get_the_date()
                );
            }

            echo '</div>';
        return ob_get_clean();
    }

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
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>" 
                    aria-label="<?php echo esc_attr(get_the_title()); ?>">
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
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'] . ' ' . $button['btn_hover'];

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button small <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>>
                    <span class="inner">
                        <span class="content-base">
                            <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                            <span class="text"><?php echo $text; ?></span>
                            <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                        </span>

                        <span class="content-hover">
                            <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                            <span class="text"><?php echo $text; ?></span>
                            <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                        </span>
                    </span>

                    <?php echo '<span class="bg-hover"></span>'; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        }
    }
}

