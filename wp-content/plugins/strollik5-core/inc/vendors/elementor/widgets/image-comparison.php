<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class OSF_Elementor_Image_Comparison extends Widget_Base
{

    public function get_name()
    {
        return 'opal-image-comparison';
    }

    public function get_title()
    {
        return __('Opal Image Comparison', 'strollik5-core');
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    public function get_script_depends()
    {
        return [
            'imagesloaded',
            'event-move',
            'imgcompare'
        ];
    }

    public function get_keywords()
    {
        return ['image', 'comparison', 'before after', 'image slide'];
    }

    public function get_icon()
    {
        return 'eicon-image-before-after';
    }

    protected function _register_controls()
    {

        $this->start_controls_section('osf_img_compare_original_image_section',
            [
                'label' => __('Original Image', 'strollik5-core'),
            ]
        );

        $this->add_control('osf_image_comparison_original_image',
            [
                'label' => __('Choose Image', 'strollik5-core'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'description' => __('It\'s recommended to use two images that have the same size', 'strollik5-core'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_control('osf_img_compare_original_img_label_switcher',
            [
                'label' => __('Label', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control('osf_img_compare_original_img_label',
            [
                'label' => __('Text', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Before', 'strollik5-core'),
                'placeholder' => 'Before',
                'condition' => [
                    'osf_img_compare_original_img_label_switcher' => 'yes',
                ],
                'label_block' => true
            ]
        );

        $this->add_control('osf_img_compare_original_hor_label_position',
            [
                'label' => __('Horizontal Position', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'fa fa-align-right'
                    ],
                ],
                'condition' => [
                    'osf_img_compare_original_img_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'vertical'
                ],
                'default' => 'center',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('osf_img_compare_original_label_horizontal_offset',
            [
                'label' => __('Horizontal Offset', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition' => [
                    'osf_img_compare_original_img_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'horizontal'
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-horizontal .osf-twentytwenty-before-label' => 'left: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control('osf_img_compare_original_label_position',
            [
                'label' => __('Vertical Position', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'strollik5-core'),
                        'icon' => 'fa fa-arrow-circle-up',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'strollik5-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'strollik5-core'),
                        'icon' => 'fa fa-arrow-circle-down',
                    ],
                ],
                'condition' => [
                    'osf_img_compare_original_img_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'horizontal'
                ],
                'default' => 'middle',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('osf_img_compare_original_label_vertical_offset',
            [
                'label' => __('Vertical Offset', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition' => [
                    'osf_img_compare_original_img_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'vertical'
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-vertical .osf-twentytwenty-before-label' => 'top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('osf_image_comparison_modified_image_section',
            [
                'label' => __('Modified Image', 'strollik5-core'),
            ]
        );

        $this->add_control('osf_image_comparison_modified_image',
            [
                'label' => __('Choose Image', 'strollik5-core'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'description' => __('It\'s recommended to use two images that have the same size', 'strollik5-core'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_control('osf_image_comparison_modified_image_label_switcher',
            [
                'label' => __('Label', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control('osf_image_comparison_modified_image_label',
            [
                'label' => __('Text', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'After',
                'default' => __('After', 'strollik5-core'),
                'condition' => [
                    'osf_image_comparison_modified_image_label_switcher' => 'yes',
                ],
                'label_block' => true
            ]
        );

        $this->add_control('osf_img_compare_modified_hor_label_position',
            [
                'label' => __('Horizontal Position', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'fa fa-align-right'
                    ],
                ],
                'condition' => [
                    'osf_image_comparison_modified_image_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'vertical'
                ],
                'default' => 'center',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('osf_img_compare_modified_label_horizontal_offset',
            [
                'label' => __('Horizontal Offset', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition' => [
                    'osf_image_comparison_modified_image_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'horizontal'
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-horizontal .osf-twentytwenty-after-label' => 'right: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control('osf_img_compare_modified_label_position',
            [
                'label' => __('Vertical Position', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'strollik5-core'),
                        'icon' => 'fa fa-arrow-circle-up',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'strollik5-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'strollik5-core'),
                        'icon' => 'fa fa-arrow-circle-down',
                    ],
                ],
                'condition' => [
                    'osf_image_comparison_modified_image_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'horizontal'
                ],
                'default' => 'middle',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control('osf_img_compare_modified_label_vertical_offset',
            [
                'label' => __('Vertical Offset', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ],
                ],
                'condition' => [
                    'osf_image_comparison_modified_image_label_switcher' => 'yes',
                    'osf_image_comparison_orientation' => 'vertical'
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-vertical .osf-twentytwenty-after-label' => 'bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('osf_img_compare_display_options',
            [
                'label' => __('Display Options', 'strollik5-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'prmium_img_compare_images_size',
                'default' => 'full',
            ]
        );

        $this->add_control('osf_image_comparison_orientation',
            [
                'label' => __('Orientation', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => __('Vertical', 'strollik5-core'),
                    'vertical' => __('Horizontal', 'strollik5-core')
                ],
                'default' => 'horizontal',
                'label_block' => true,
            ]
        );

        $this->add_control('osf_img_compare_visible_ratio',
            [
                'label' => __('Visible Ratio', 'strollik5-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 0.5,
                'min' => 0,
                'step' => 0.1,
                'max' => 1,
            ]
        );

        $this->add_control('osf_image_comparison_add_drag_handle',
            [
                'label' => __('Show Drag Handle', 'strollik5-core'),
                'description' => __('Show drag handle between the images', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => 'Show',
                'label_off' => 'Hide',
            ]
        );

        $this->add_control('osf_image_comparison_add_separator',
            [
                'label' => __('Show Separator', 'strollik5-core'),
                'description' => __('Show separator between the images', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'condition' => [
                    'osf_image_comparison_add_drag_handle' => 'yes'
                ]
            ]
        );

        $this->add_control('osf_image_comparison_interaction_mode',
            [
                'label' => __('Interaction Mode', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'mousemove' => __('Mouse Move', 'strollik5-core'),
                    'drag' => __('Mouse Drag', 'strollik5-core'),
                    'click' => __('Mouse Click', 'strollik5-core'),
                ],
                'default' => 'mousemove',
                'label_block' => true,
            ]
        );

        $this->add_control('osf_image_comparison_overlay',
            [
                'label' => __('Overlay Color', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',

            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('osf_img_compare_original_img_label_style_tab',
            [
                'label' => __('First Label', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'osf_img_compare_original_img_label_switcher' => 'yes'
                ]
            ]
        );

        $this->add_control('osf_image_comparison_original_label_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-before-label span' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'osf_image_comparison_original_label_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .osf-twentytwenty-before-label span',
            ]
        );

        $this->add_control('osf_image_comparison_original_label_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-before-label span' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'osf_image_comparison_original_label_border',
                'selector' => '{{WRAPPER}} .osf-twentytwenty-before-label span',
            ]
        );

        $this->add_control('osf_image_comparison_original_label_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-before-label span' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'osf_image_comparison_original_label_box_shadow',
                'selector' => '{{WRAPPER}} .osf-twentytwenty-before-label span',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'osf_image_comparison_original_label_text_shadow',
                'label' => __('Shadow', 'strollik5-core'),
                'selector' => '{{WRAPPER}} .osf-twentytwenty-before-label span',
            ]
        );

        $this->add_responsive_control('osf_image_comparison_original_label_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-before-label span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('osf_image_comparison_modified_image_label_style_tab',
            [
                'label' => __('Second Label', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'osf_image_comparison_modified_image_label_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control('osf_image_comparison_modified_label_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-after-label span' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'osf_image_comparison_modified_label_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .osf-twentytwenty-after-label span',
            ]
        );

        $this->add_control('osf_image_comparison_modified_label_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-after-label span' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'osf_image_comparison_modified_label_border',
                'selector' => '{{WRAPPER}} .osf-twentytwenty-after-label span',
            ]
        );

        $this->add_control('osf_image_comparison_modified_label_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-after-label span' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'osf_image_comparison_modified_label_box_shadow',
                'selector' => '{{WRAPPER}} .osf-twentytwenty-after-label span',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'osf_image_comparison_modified_label_text_shadow',
                'label' => __('Shadow', 'strollik5-core'),
                'selector' => '{{WRAPPER}} .osf-twentytwenty-after-label span',
            ]
        );

        $this->add_responsive_control('osf_image_comparison_modified_label_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-after-label span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('osf_image_comparison_drag_style_settings',
            [
                'label' => __('Drag', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'osf_image_comparison_add_drag_handle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control('osf_image_comparison_drag_width',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'description' => __('Enter Drag width in (PX), default is 50px', 'strollik5-core'),
                'size_units' => ['px', 'em'],
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-handle' => 'width:{{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('osf_image_comparison_drag_height',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ]
                ],
                'description' => __('Enter Drag height in (PX), default is 50px', 'strollik5-core'),
                'size_units' => ['px', 'em'],
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-handle' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control('osf_image_comparison_drag_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-handle' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'osf_image_comparison_drag_border',
                'selector' => '{{WRAPPER}} .osf-twentytwenty-handle',
            ]
        );

        $this->add_control('osf_image_comparison_drag_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-handle' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'osf_image_comparison_drag_box_shadow',
                'selector' => '{{WRAPPER}} .osf-twentytwenty-handle',
            ]
        );

        $this->add_responsive_control('osf_image_comparison_drag_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-handle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('osf_image_comparison_arrow_style',
            [
                'label' => __('Arrows', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'osf_image_comparison_add_drag_handle' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control('osf_image_comparison_arrows_size',
            [
                'label' => __('Size', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-left-arrow' => 'border: {{SIZE}}px inset transparent; border-right: {{SIZE}}px solid; margin-top: -{{size}}px',
                    '{{WRAPPER}} .osf-twentytwenty-right-arrow' => 'border: {{SIZE}}px inset transparent; border-left: {{SIZE}}px solid; margin-top: -{{size}}px',
                    '{{WRAPPER}} .osf-twentytwenty-down-arrow' => 'border: {{SIZE}}px inset transparent; border-top: {{SIZE}}px solid; margin-left: -{{size}}px',
                    '{{WRAPPER}} .osf-twentytwenty-up-arrow' => 'border: {{SIZE}}px inset transparent; border-bottom: {{SIZE}}px solid; margin-left: -{{size}}px',
                ]
            ]
        );

        $this->add_control('osf_image_comparison_arrows_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .osf-twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                    '{{WRAPPER}} .osf-twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .osf-twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('osf_img_compare_separator_style_settings',
            [
                'label' => __('Separator', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'osf_image_comparison_add_drag_handle' => 'yes',
                    'osf_image_comparison_add_separator' => 'yes'
                ],
            ]
        );

        $this->add_control('osf_img_compare_separator_background_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-handle:after, {{WRAPPER}} .osf-twentytwenty-handle:before' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control('osf_img_compare_separator_spacing',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-horizontal .osf-twentytwenty-handle:after' => 'top: {{SIZE}}%;',
                    '{{WRAPPER}} .osf-twentytwenty-horizontal .osf-twentytwenty-handle:before' => 'bottom: {{SIZE}}%;',
                    '{{WRAPPER}} .osf-twentytwenty-vertical .osf-twentytwenty-handle:after' => 'right: {{SIZE}}%;',
                    '{{WRAPPER}} .osf-twentytwenty-vertical .osf-twentytwenty-handle:before' => 'left: {{SIZE}}%;'
                ]
            ]
        );

        $this->add_responsive_control('osf_img_compare_separator_width',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-vertical .osf-twentytwenty-handle:before,{{WRAPPER}} .osf-twentytwenty-vertical .osf-twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'osf_image_comparison_add_drag_handle' => 'yes',
                    'osf_image_comparison_add_separator' => 'yes',
                    'osf_image_comparison_orientation' => 'vertical'
                ],
            ]
        );

        $this->add_responsive_control('osf_img_compare_separator_height',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-horizontal .osf-twentytwenty-handle:after,{{WRAPPER}} .osf-twentytwenty-horizontal .osf-twentytwenty-handle:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'osf_image_comparison_add_drag_handle' => 'yes',
                    'osf_image_comparison_add_separator' => 'yes',
                    'osf_image_comparison_orientation' => 'horizontal'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'osf_img_compare_separator_shadow',
                'selector' => '{{WRAPPER}} .osf-twentytwenty-handle:after,{{WRAPPER}} .osf-twentytwenty-handle:before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('osf_image_comparison_contents_wrapper_style_settings',
            [
                'label' => __('Container', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('osf_image_comparison_overlay_background',
            [
                'label' => __('Overlay Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .osf-twentytwenty-overlay.osf-twentytwenty-show:hover' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'osf_image_comparison_overlay' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'osf_image_comparison_contents_wrapper_border',
                'selector' => '{{WRAPPER}} .osf-images-compare-container',
            ]
        );

        $this->add_control('osf_image_comparison_contents_wrapper_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-images-compare-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'osf_image_comparison_contents_wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .osf-images-compare-container',
            ]
        );

        $this->add_responsive_control('osf_image_comparison_contents_wrapper_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .osf-images-compare-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();

        $original_image = $settings['osf_image_comparison_original_image'];

        $modified_image = $settings['osf_image_comparison_modified_image'];

        $original_image_src = Group_Control_Image_Size::get_attachment_image_src($original_image['id'], 'prmium_img_compare_images_size', $settings);

        $original_image_src = empty($original_image_src) ? $original_image['url'] : $original_image_src;

        $modified_image_src = Group_Control_Image_Size::get_attachment_image_src($modified_image['id'], 'prmium_img_compare_images_size', $settings);

        $modified_image_src = empty($modified_image_src) ? $modified_image['url'] : $modified_image_src;


        $img_compare_setttings = [
            'orientation' => $settings['osf_image_comparison_orientation'],
            'visibleRatio' => !empty($settings['osf_img_compare_visible_ratio']) ? $settings['osf_img_compare_visible_ratio'] : 0.1,
            'switchBefore' => ($settings['osf_img_compare_original_img_label_switcher'] == 'yes') ? true : false,
            'beforeLabel' => ($settings['osf_img_compare_original_img_label_switcher'] == 'yes' && !empty($settings['osf_img_compare_original_img_label'])) ? $settings['osf_img_compare_original_img_label'] : '',
            'switchAfter' => ($settings['osf_image_comparison_modified_image_label_switcher'] == 'yes') ? true : false,
            'afterLabel' => ($settings['osf_image_comparison_modified_image_label_switcher'] == 'yes' && !empty($settings['osf_image_comparison_modified_image_label'])) ? $settings['osf_image_comparison_modified_image_label'] : '',
            'mouseMove' => ($settings['osf_image_comparison_interaction_mode'] == 'mousemove') ? true : false,
            'clickMove' => ($settings['osf_image_comparison_interaction_mode'] == 'click') ? true : false,
            'showDrag' => ($settings['osf_image_comparison_add_drag_handle'] == 'yes') ? true : false,
            'showSep' => ($settings['osf_image_comparison_add_separator'] == 'yes') ? true : false,
            'overlay' => ($settings['osf_image_comparison_overlay'] == 'yes') ? false : true,
            'beforePos' => $settings['osf_img_compare_original_label_position'],
            'afterPos' => $settings['osf_img_compare_modified_label_position'],
            'verbeforePos' => $settings['osf_img_compare_original_hor_label_position'],
            'verafterPos' => $settings['osf_img_compare_modified_hor_label_position'],
        ];

        $this->add_render_attribute('image-compare', 'id', 'osf-image-comparison-contents-wrapper-' . $this->get_id());

        $this->add_render_attribute('image-compare', 'class', ['osf-images-compare-container', 'osf-twentytwenty-container']);

        $this->add_render_attribute('image-compare', 'data-settings', wp_json_encode($img_compare_setttings));

        $this->add_render_attribute('first-image', 'src', $original_image_src);

        $this->add_render_attribute('second-image', 'src', $modified_image_src);

        $this->add_render_attribute('first-image', 'alt', $settings['osf_img_compare_original_img_label']);

        $this->add_render_attribute('second-image', 'alt', $settings['osf_image_comparison_modified_image_label']);
        ?>

        <div class="osf-image-comparison-contents-wrapper osf-twentytwenty-wrapper">
            <div <?php echo $this->get_render_attribute_string('image-compare'); ?>>
                <img <?php echo $this->get_render_attribute_string('first-image'); ?>>
                <img <?php echo $this->get_render_attribute_string('second-image'); ?>>
            </div>
        </div>

        <?php

    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Image_Comparison());