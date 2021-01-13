<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;


class OSF_Elementor_Price_Table extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-price-table';
    }

    public function get_title() {
        return __('Opal Price Table', 'strollik5-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_header',
            [
                'label' => __('Header', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __('Title', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Pricing Table', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Choose Icon', 'strollik5-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label' => __('Description', 'strollik5-core'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your description', 'strollik5-core'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing',
            [
                'label' => __('Pricing', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'strollik5-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => '39.99',
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __('Period', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('month', 'strollik5-core'),
                'placeholder'   => __('Period ...','strollik5-core'),
            ]
        );

        $this->add_control(
            'currency_symbol',
            [
                'label' => __('Currency Symbol', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('None', 'strollik5-core'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'strollik5-core'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'strollik5-core'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'strollik5-core'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'strollik5-core'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'strollik5-core'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'strollik5-core'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'strollik5-core'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'strollik5-core'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'strollik5-core'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'strollik5-core'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'strollik5-core'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'strollik5-core'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'strollik5-core'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'strollik5-core'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'strollik5-core'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'strollik5-core'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'strollik5-core'),
                    'custom' => __('Custom', 'strollik5-core'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_symbol_custom',
            [
                'label' => __('Custom Symbol', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency_symbol' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'currency_format',
            [
                'label' => __('Currency Format', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => '1,234.56 (Default)',
                    ',' => '1.234,56',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            [
                'label' => __('Features', 'strollik5-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => __('Text', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('List Item', 'strollik5-core'),
            ]
        );

        $repeater->add_control(
            'item_check',
            [
                'label' => __('Check', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on' => 'Show',
                'label_off' => 'Hide',
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_text' => __('List Item #1', 'strollik5-core'),
                    ],
                    [
                        'item_text' => __('List Item #2', 'strollik5-core'),
                    ],
                    [
                        'item_text' => __('List Item #3', 'strollik5-core'),
                    ],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer',
            [
                'label' => __('Button', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => __('Type', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Default', 'strollik5-core'),
                    'primary' => __('Primary', 'strollik5-core'),
                    'secondary' => __('Secondary', 'strollik5-core'),
                    'outline_primary' => __('Outline Primary', 'strollik5-core'),
                    'outline_secondary' => __('Outline Secondary', 'strollik5-core'),
                    'link' => __('Link', 'strollik5-core'),
                    'info' => __('Info', 'strollik5-core'),
                    'success' => __('Success', 'strollik5-core'),
                    'warning' => __('Warning', 'strollik5-core'),
                    'danger' => __('Danger', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-button-',
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __('Size', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => __('Extra Small', 'strollik5-core'),
                    'sm' => __('Small', 'strollik5-core'),
                    'md' => __('Medium', 'strollik5-core'),
                    'lg' => __('Large', 'strollik5-core'),
                    'xl' => __('Extra Large', 'strollik5-core'),
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Click Here', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'strollik5-core'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'strollik5-core'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __('Wrapper', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'wrapper_bg_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wrapper_alignment',
            [
                'label' => __('Alignment', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table' => 'text-align: {{VALUE}}',
                ],
                'prefix_class'  => 'elementor-price-table-',
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'animation_moveup',
            [
                'label' => __('Hover Move Up', 'strollik5-core'),
                'type'  => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover' => 'transform: translateY(-5px);',
                ],
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'price_table_heading_style',
            [
                'label' => __('Header', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'price_wrapper_header',
            [
                'label' => __('Spacing Top Bottom', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                        'size'  => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__wrapper-header' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: calc({{SIZE}}{{UNIT}} - 10px)',
                ],
            ]
        );

        $this->add_control(
            'icon_style',
            [
                'label' => __('Icon', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon-wrapper i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_primary',
            [
                'label' => __('Background primary', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-table-icon-bkg' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_secondary',
            [
                'label' => __('Background secondary', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon-wrapper .elementor-icon ' => 'background: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                        'size'  => 125,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon-wrapper .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_frame_size',
            [
                'label' => __( 'Framed Size', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__icon-wrapper .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_heading_style',
            [
                'label' => __('Title', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__heading',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            'heading_spacing',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'heading_sub_heading_style',
            [
                'label' => __('Description', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .elementor-price-table__heading-description',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'sub_heading_spacing',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__heading-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_element_style',
            [
                'label' => __('Pricing', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'sprice_spacing',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'price_heaing_value',
            [
                'label' => __('Value', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'price_size',
            [
                'label' => __('Value Size', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__price' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'price_heaing_symbol',
            [
                'label' => __('Symbol', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'price_symbol_size',
            [
                'label' => __('Size', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default'  => [
                        'size'  => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'price_symbol_position',
            [
                'label' => __('Position', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => __('Top', 'strollik5-core'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __('Middle', 'strollik5-core'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __('Bottom', 'strollik5-core'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__currency' => 'align-self: {{VALUE}}',
                ],

            ]
        );

        $this->add_control(
            'price_heaing_period',
            [
                'label' => __('Period', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'price_period_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__period' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_period_typo',
                'selector' => '{{WRAPPER}} .elementor-price-table__period',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_features_list_style',
            [
                'label' => __('Features', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'features_wrapper',
            [
                'label' => __('Spacing Top Bottom', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size'  => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'padding: {{SIZE}}{{UNIT}} 0',
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_list_color_active',
            [
                'label' => __('Color Active', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__features-list .item-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_list_icon_border',
            [
                'label' => __('Border Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__feature-inner' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'features_list_icon_border_color',
            [
                'label' => __('Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__feature-inner' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_list_icon_spacing',
            [
                'label' => __('Item Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__feature-inner' => 'padding: {{SIZE}}{{UNIT}} 0',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_icon_item_typo',
                'selector' => '{{WRAPPER}} .elementor-price-table__feature-inner',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer_style',
            [
                'label' => __('Button', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition' => [
                    'button_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_alignment',
            [
                'label' => __('Alignment', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'   => 'justify',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justify', 'strollik5-core'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__footer' => 'text-align: {{VALUE}}',
                ],
                'prefix_class'  => 'elementor-button-',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .elementor-price-table__button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '.elementor-price-table__button.elementor-button'
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-table__button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __('Animation', 'strollik5-core'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    private function get_currency_symbol($symbol_name) {
        $symbols = [
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'pound' => '&#163;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'baht' => '&#3647;',
            'yen' => '&#165;',
            'won' => '&#8361;',
            'guilder' => '&fnof;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'rupee' => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real' => 'R$',
            'krona' => 'kr',
        ];
        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function render() {
        $settings = $this->get_settings();
        $symbol = '';

        if (!empty($settings['currency_symbol'])) {
            if ('custom' !== $settings['currency_symbol']) {
                $symbol = $this->get_currency_symbol($settings['currency_symbol']);
            } else {
                $symbol = $settings['currency_symbol_custom'];
            }
        }
        $currency_format = empty($settings['currency_format']) ? '.' : $settings['currency_format'];

        $this->add_render_attribute('button_text', 'class', [
            'elementor-price-table__button',
            'elementor-button',
            'elementor-size-' . $settings['button_size'],
        ]);

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('button_text', 'href', $settings['link']['url']);

            if (!empty($settings['link']['is_external'])) {
                $this->add_render_attribute('button_text', 'target', '_blank');
            }
        }

        if (!empty($settings['button_hover_animation'])) {
            $this->add_render_attribute('button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
        }

        if ( !empty($settings['icon']) ) {
            $this->add_render_attribute( 'i', 'class', $settings['icon'] );
            $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
        }

        $this->add_render_attribute('heading', 'class', 'elementor-price-table__heading');
        $this->add_render_attribute('description', 'class', 'elementor-price-table__heading-description');
        $this->add_render_attribute('period', 'class', 'elementor-price-table__period');
        $this->add_render_attribute('item_repeater', 'class', 'item-active');

        $this->add_inline_editing_attributes('heading', 'none');
        $this->add_inline_editing_attributes('description');
        $this->add_inline_editing_attributes('button_text');
        $this->add_inline_editing_attributes('item_repeater');

        ?>

        <div class="elementor-price-table">
            <div class="elementor-price-table__wrapper-header">
            <?php
            $pricing_number = '';
            if(!empty($settings['price'])) {
                $pricing_string = (string)$settings['price'];
                $pricing_array = explode('.', $pricing_string);
                if (isset($pricing_array[1]) && strlen($pricing_array[1]) < 2) {
                    $decimals = 1;
                } else {
                    $decimals = 2;
                }

                if (count($pricing_array) < 2) {
                    $decimals = 0;
                }

                if (empty($settings['currency_format'])) {
                    $dec_point = '.';
                    $thousands_sep = ',';
                } else {
                    $dec_point = ',';
                    $thousands_sep = '.';
                }
                $pricing_number = number_format($settings['price'], $decimals, $dec_point, $thousands_sep);
            }
            ?>
<!--            icon box pricing-->
            <?php if ( !empty($settings['icon']) ):?>
            <div class="elementor-price-table__icon-wrapper">
                <span class="elementor-icon">
                    <i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
                    <span class="price-table-icon-bkg"></span>
                </span>
            </div>
        <?php endif;?>
<!--            end icon box-->

            <?php if ($settings['heading']) : ?>
                <div class="elementor-price-table__header">
                    <?php if (!empty($settings['heading'])) : ?>
                        <h3 <?php echo $this->get_render_attribute_string('heading'); ?>><?php echo $settings['heading']; ?></h3>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($settings['heading_description'])) : ?>
                <div class="elementor-price-table__description">
                    <p <?php echo $this->get_render_attribute_string('description'); ?>><?php echo $settings['heading_description']; ?></p>
                </div>
            <?php endif; ?>

            <div class="elementor-price-table__price">
                <?php if (!empty($settings['price'])) : ?>
                <?php if (!empty($symbol)) : ?>
                    <span class="elementor-price-table__currency"><?php echo $symbol; ?></span>
                <?php endif; ?>
                    <span class="elementor-price-table__integer-part"><?php echo $pricing_number; ?></span>
                <?php endif; ?>
            </div>

<!--            html period-->
            <?php if(!empty($settings['period'])):?>
                <div <?php echo $this->get_render_attribute_string('period');?>><?php esc_html_e('Per ','strollik5-core')?><span><?php echo $settings['period'];?></span></div>
            <?php endif;?>

            </div>

<!--            end header-->

            <?php if (!empty($settings['features_list'])) : ?>
                <ul class="elementor-price-table__features-list">
                    <?php foreach ($settings['features_list'] as $index => $item) :
                        $repeater_setting_key = $this->get_repeater_setting_key('item_text', 'features_list', $index);
                        $this->add_inline_editing_attributes($repeater_setting_key);
                        ?>
                        <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
                            <div class="elementor-price-table__feature-inner">
                                <?php if (!empty($item['item_text'])) : ?>
                                    <?php if ($item['item_check']):?>
                                        <span <?php echo $this->get_render_attribute_string('item_repeater');?> <?php echo $this->get_render_attribute_string($repeater_setting_key);?>>
                                        <?php echo $item['item_text']; ?>
                                        </span>
                                    <?php else: ?>
                                        <span <?php echo $this->get_render_attribute_string($repeater_setting_key);?>>
                                        <?php echo $item['item_text']; ?>
                                        </span>
                                    <?php endif;?>
                                <?php else :
                                    echo '&nbsp;';
                                endif;
                                ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($settings['button_text'])) : ?>
                <div class="elementor-price-table__footer">
                    <?php if (!empty($settings['button_text'])) : ?>
                        <a <?php echo $this->get_render_attribute_string('button_text'); ?>><?php echo $settings['button_text']; ?></a>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Price_Table());