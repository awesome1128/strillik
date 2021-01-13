<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Products_Tabs extends Elementor\Widget_Base
{

    public function get_categories()
    {
        return array('opal-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'opal-products-tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Opal Products Tabs', 'strollik5-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-product-tabs';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __('Tabs', 'strollik5-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __('Tab Title', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('#Product Tab', 'strollik5-core'),
                'placeholder' => __('Product Tab Title', 'strollik5-core'),
            ]
        );

        $repeater->add_control(
            'limit',
            [
                'label' => __('Posts Per Page', 'strollik5-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $repeater->add_responsive_control(
            'column',
            [
                'label' => __('columns', 'strollik5-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );


        $repeater->add_control(
            'advanced',
            [
                'label' => __('Advanced', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $repeater->add_control(
            'orderby',
            [
                'label' => __('Order By', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => __('Date', 'strollik5-core'),
                    'id' => __('Post ID', 'strollik5-core'),
                    'menu_order' => __('Menu Order', 'strollik5-core'),
                    'popularity' => __('Number of purchases', 'strollik5-core'),
                    'rating' => __('Average Product Rating', 'strollik5-core'),
                    'title' => __('Product Title', 'strollik5-core'),
                    'rand' => __('Random', 'strollik5-core'),
                ],
            ]
        );

        $repeater->add_control(
            'order',
            [
                'label' => __('Order', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => __('ASC', 'strollik5-core'),
                    'desc' => __('DESC', 'strollik5-core'),
                ],
            ]
        );

        $repeater->add_control(
            'categories',
            [
                'label' => __('Categories', 'strollik5-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_product_categories(),
                'multiple' => true,
            ]
        );

        $repeater->add_control(
            'cat_operator',
            [
                'label' => __('Category Operator', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'IN',
                'options' => [
                    'AND' => __('AND', 'strollik5-core'),
                    'IN' => __('IN', 'strollik5-core'),
                    'NOT IN' => __('NOT IN', 'strollik5-core'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'product_type',
            [
                'label' => __('Product Type', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'newest',
                'options' => [
                    'newest' => __('Newest Products', 'strollik5-core'),
                    'on_sale' => __('On Sale Products', 'strollik5-core'),
                    'best_selling' => __('Best Selling', 'strollik5-core'),
                    'top_rated' => __('Top Rated', 'strollik5-core'),
                    'featured' => __('Featured Product', 'strollik5-core'),
                ],
            ]
        );

        $repeater->add_control(
            'enable_carousel',
            [
                'label' => __('Enable Carousel', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $repeater->add_control(
            'enable_two_row',
            [
                'label' => __('Enable Two Row', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'navigation',
            [
                'label' => __('Navigation', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both' => __('Arrows and Dots', 'strollik5-core'),
                    'arrows' => __('Arrows', 'strollik5-core'),
                    'dots' => __('Dots', 'strollik5-core'),
                    'none' => __('None', 'strollik5-core'),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'nav_position',
            [
                'label' => __('Nav Position', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => __('Top', 'strollik5-core'),
                    'center' => __('Center', 'strollik5-core'),
                    'bottom' => __('Bottom', 'strollik5-core'),
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'enable_carousel',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'none',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'dots',
                        ],
                    ],
                ],
                'prefix_class' => 'owl-nav-position-',
            ]
        );
        $repeater->add_control(
            'nav_align',
            [
                'label' => __('Nav Align', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left' => __('Left', 'strollik5-core'),
                    'center' => __('Center', 'strollik5-core'),
                    'right' => __('Right', 'strollik5-core'),
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'enable_carousel',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'none',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'dots',
                        ],
                        [
                            'name' => 'nav_position',
                            'operator' => '!==',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );
        $repeater->add_responsive_control(
            'nav_spacing',
            [
                'label' => __('Nav Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .owl-nav-position-top .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .owl-nav-position-bottom .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'enable_carousel',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'none',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '!==',
                            'value' => 'dots',
                        ],
                        [
                            'name' => 'nav_position',
                            'operator' => '!==',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'pause_on_hover',
            [
                'label' => __('Pause on Hover', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'strollik5-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                    'enable_carousel' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                ],
            ]
        );

        $repeater->add_control(
            'infinite',
            [
                'label' => __('Infinite Loop', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => __('#Product Tab 1', 'strollik5-core'),
                    ],
                    [
                        'tab_title' => __('#Product Tab 2', 'strollik5-core'),
                    ]
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_product',
            [
                'label' => __('Product', 'strollik5-core'),
            ]
        );
        $this->add_responsive_control(
            'product_gutter',
            [
                'label' => __('Gutter', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} ul.products li.product' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} ul.products' => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => __('Tabs', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_tabs',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tab_header_style',
            [
                'label' => __('Header', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_tab_header',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dash_color',
            [
                'label' => __('Dash Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs-wrapper span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_items',
            [
                'label' => __('Align', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'prefix_class' => 'elementor-tabs-h-align-',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'display: flex; flex-wrap: wrap; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}} .elementor-tab-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_responsive_control(
            'tab_title_width',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'background-color: {{VALUE}};'
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_background_hover_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'background-color: {{VALUE}} !important;'
                ],
            ]
        );

        $this->add_control(
            'title_hover_border_color',
            [
                'label' => __('Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'border-color: {{VALUE}} !important;'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_active',
            [
                'label' => __('Active', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'title_active_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .elementor-tab-title.elementor-active:before' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'title_background_active_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}}.elementor-tabs-view-horizontal .elementor-tab-title.elementor-active:after' => 'border-top-color: {{VALUE}} !important;',
                    '{{WRAPPER}}.elementor-tabs-view-vertical .elementor-tab-title.elementor-active:after' => 'border-left-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'title_active_border_color',
            [
                'label' => __('Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}}!important;'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'tab_title_align',
            [
                'label' => __('Alignment', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'justify-content: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_tabs_title',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-tab-title',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tabs_title_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-tab-content',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
            ]
        );

        $this->add_control(
            'content_background',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_content',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-tab-content',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_carousel_style',
            [
                'label' => __('Carousel', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'carousel_navs_color',
            [
                'label' => __('Nav Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-carousel .owl-nav' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .products  .owl-nav' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->start_controls_tabs('tabs_nav_style');


        $this->start_controls_tab(
            'tab_nav_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'carousel_nav_color',
            [
                'label' => __('Arrow Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_nav_bg_color',
            [
                'label' => __('Arrow Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_nav_border_color',
            [
                'label' => __('Arrow Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dot_color',
            [
                'label' => __('Dot Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_nav_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'carousel_nav_color_hover',
            [
                'label' => __('Arrow Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:hover:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_nav_bg_color_hover',
            [
                'label' => __('Arrow Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:hover:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_nav_border_color_hover',
            [
                'label' => __('Arrow Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-nav [class*="owl-"]:hover:before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dot_color_hover',
            [
                'label' => __('Dot Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .owl-theme.owl-carousel .owl-dots .owl-dot.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render()
    {
        $tabs = $this->get_settings_for_display('tabs');

        $id_int = substr($this->get_id_int(), 0, 3);
        ?>
        <div class="elementor-tabs" role="tablist">
            <div class="elementor-tabs-wrapper">
                <span class="dash-before-tabs"></span>
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class = ($index == 0) ? 'elementor-active' : '';

                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

                    $this->add_render_attribute($tab_title_setting_key, [
                        'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class' => ['elementor-tab-title', 'elementor-tab-desktop-title', $class, $class_item],
                        'data-tab' => $tab_count,
                        'tabindex' => $id_int . $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ]);
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_title_setting_key); ?>><?php echo $item['tab_title']; ?></div>
                <?php endforeach; ?>
                <span class="dash-after-tabs"></span>
            </div>
            <div class="elementor-tabs-content-wrapper">
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class_content = ($index == 0) ? 'elementor-active' : '';

                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                    $this->add_render_attribute($tab_content_setting_key, [
                        'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                        'class' => ['elementor-tab-content', 'elementor-clearfix', $class_content, $class_item],
                        'data-tab' => $tab_count,
                        'role' => 'tabpanel',
                        'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                    ]);

                    $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_content_setting_key); ?>>
                        <?php $this->woocommerce_default($item); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    private function woocommerce_default($settings)
    {
        $type = 'products';
        $atts = [
            'limit' => $settings['limit'],
            'columns' => $settings['column'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'product_layout' => 'grid',
        ];

        $atts = $this->get_product_type($atts, $settings['product_type']);
        if (isset($atts['on_sale']) && wc_string_to_bool($atts['on_sale'])) {
            $type = 'sale_products';
        } elseif (isset($atts['best_selling']) && wc_string_to_bool($atts['best_selling'])) {
            $type = 'best_selling_products';
        } elseif (isset($atts['top_rated']) && wc_string_to_bool($atts['top_rated'])) {
            $type = 'top_rated_products';
        }

        if (!empty($settings['categories'])) {
            $atts['category'] = implode(',', $settings['categories']);
            $atts['cat_operator'] = $settings['cat_operator'];
        }

        if ($settings['enable_two_row'] == 'yes') {
            $atts['class'] = 'product-two-row';
        }
        $atts['class'] = '';
        //Carousel
        if ($settings['enable_carousel'] === 'yes') {
            $atts['carousel_settings'] = json_encode(wp_slash($this->get_carousel_settings($settings)));
            $atts['product_layout'] = 'carousel';
            if (!empty($settings['nav_align'])) {
                $atts['class'] .= ' owl-nav-align-' . $settings['nav_align'];
            }
            if (!empty($settings['nav_position'])) {
                $atts['class'] .= ' owl-nav-position-' . $settings['nav_position'];
            }

        }

        $shortcode = new WC_Shortcode_Products($atts, $type);

        echo $shortcode->get_content();
    }

    protected function get_product_type($atts, $product_type)
    {
        switch ($product_type) {
            case 'featured':
                $atts['visibility'] = "featured";
                break;

            case 'on_sale':
                $atts['on_sale'] = true;
                break;

            case 'best_selling':
                $atts['best_selling'] = true;
                break;

            case 'top_rated':
                $atts['top_rated'] = true;
                break;

            default:
                break;
        }

        return $atts;
    }

    protected function get_product_categories()
    {
        $categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }

        return $results;
    }

    protected function get_carousel_settings($settings)
    {
        return array(
            'navigation' => $settings['navigation'],
            'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
            'autoplay' => $settings['autoplay'] === 'yes' ? true : false,
            'autoplayTimeout' => $settings['autoplay_speed'],
            'items' => $settings['column'] ? $settings['column'] : 1,
            'items_tablet' => $settings['column_tablet'] ? $settings['column_tablet'] : 1,
            'items_mobile' => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
            'loop' => $settings['infinite'] === 'yes' ? true : false,
            'margin' => !empty($settings['owl_item_spacing']) ? $settings['owl_item_spacing'] : 0,
        );
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Products_Tabs());
