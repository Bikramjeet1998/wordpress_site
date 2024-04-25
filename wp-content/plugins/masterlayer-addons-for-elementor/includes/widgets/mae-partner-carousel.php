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
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Partner_Carousel_Widget extends Widget_Base {

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
        return 'mae-partner-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Partner Carousel', 'masterlayer' );
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
            'title',
            [
                'label'   => __( 'Title', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'New Partner', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'partner_logo',
            [
                'label'   => __( 'Partner Logo', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ]
        );

        $repeater->add_control(
            'partner_url',
            [
                'label'      => __( 'Partner Link (optional)', 'masterlayer'),
                'type'       => Controls_Manager::URL,
                'dynamic'    => [
                    'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
                ],
                'placeholder'       => 'https://www.your-link.com',
            ]
        );

        $this->add_control(
            'partners',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'  => __( 'Partner #1', 'masterlayer' ),
                    ],
                    [
                        'title'  => __( 'Partner #2', 'masterlayer' ),
                    ],
                    [
                        'title'  => __( 'Partner #3', 'masterlayer' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'opacity',
            [
                'label' => esc_html__( 'Opacity', 'masterlayer' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'selectors' => [
                    '{{WRAPPER}} .master-partner' => 'opacity: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'opacity_hover',
            [
                'label' => esc_html__( 'Opacity Hover', 'masterlayer' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'selectors' => [
                    '{{WRAPPER}} .master-partner:hover' => 'opacity: {{VALUE}};',
                ],
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
                'label'     => __( 'Carousel Animation', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'slide',
                'options'   => [
                    'slide'        => __( 'Slide', 'masterlayer'),
                    'fade'     => __( 'Fade', 'masterlayer'),
                ],
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
        $partners = $this->get_settings_for_display( 'partners' );

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
            foreach ( $partners as $index => $item ) { 
                ?>
                <div class="master-partner item-carousel">
                    <?php if ( $item['partner_url']['url'] ) { ?>
                        <a <?php if( $item['title'] ) { echo 'aria-label="' . esc_attr( $item['title'] ) . '"'; } ?> href="<?php echo esc_url($item['partner_url']['url']); ?>">
                            <?php echo wp_get_attachment_image( $item['partner_logo']['id'], 'full' ); ?>
                        </a>
                    <?php } else { 
                        echo wp_get_attachment_image( $item['partner_logo']['id'], 'full' ) ;
                    } ?>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

