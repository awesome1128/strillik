<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class  OSF_Elementor_Heading extends Widget_Heading {

    public function get_title() {
        return __('Opal Heading', 'strollik5-core');
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Title', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'strollik5-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'strollik5-core'),
                'default'     => __('Add Your Heading Text Here', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __('Sub Title', 'strollik5-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter your subtitle', 'strollik5-core'),
                'default'     => __('', 'strollik5-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => __('Link', 'strollik5-core'),
                'type'      => Controls_Manager::URL,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'size',
            [
                'label'   => __('Size', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Default', 'strollik5-core'),
                    'small'   => __('Small', 'strollik5-core'),
                    'medium'  => __('Medium', 'strollik5-core'),
                    'large'   => __('Large', 'strollik5-core'),
                    'xl'      => __('XL', 'strollik5-core'),
                    'xxl'     => __('XXL', 'strollik5-core'),
                ],
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => __('HTML Tag', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => __('Alignment', 'strollik5-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'strollik5-core'),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'strollik5-core'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color_style',
            [
                'label' => __('Color Gradient', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'gradian',
                'prefix_class' => 'elementor-heading-'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Text Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}}.elementor-widget-heading .elementor-heading-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title_color_style' => ''
                ]
            ]
        );

        $this->add_control(
            'title_color_gradian',
            [
                'label' => __('Text Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#30aece',
                'condition' => [
                    'title_color_style!' => ''
                ],
            ]
        );

        $this->add_control(
            'location_color',
            [
                'label' => __('Location', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'render_type' => 'ui',
                'condition' => [
                    'title_color_style!' => ''
                ],

            ]
        );

        $this->add_control(
            'title_color_gradian_secondary',
            [
                'label' => __('Color Secondary', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#0048ce',
                'condition' => [
                    'title_color_style!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-heading-gradian .elementor-heading-title' => 'background: -webkit-linear-gradient({{angle_gradian.SIZE}}{{angle_gradian.UNIT}}, {{title_color_gradian.VALUE}} {{location_color.SIZE}}{{location_color.UNIT}} , {{VALUE}} {{location_secondary.SIZE}}{{location_secondary.UNIT}} ); -webkit-background-clip: text; -webkit-text-fill-color: transparent;',
                ],
            ]
        );

        $this->add_control(
            'location_secondary',
            [
                'label' => __('Location', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'render_type' => 'ui',
                'condition' => [
                    'title_color_style!' => ''
                ],

            ]
        );

        $this->add_control(
            'angle_gradian',
            [
                'label' => __('Angle', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'range' => [
                    'deg' => [
                        'step' => 10,
                    ],
                ],
                'condition' => [
                    'title_color_style!' => ''
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                //'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label'     => __('Blend Mode', 'strollik5-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''            => __('Normal', 'strollik5-core'),
                    'multiply'    => 'Multiply',
                    'screen'      => 'Screen',
                    'overlay'     => 'Overlay',
                    'darken'      => 'Darken',
                    'lighten'     => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation'  => 'Saturation',
                    'color'       => 'Color',
                    'difference'  => 'Difference',
                    'exclusion'   => 'Exclusion',
                    'hue'         => 'Hue',
                    'luminosity'  => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sub_title_style',
            [
                'label' => __('Sub Title', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Text Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-heading .sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}}.elementor-widget-heading .sub-title',
            ]
        );

        $this->add_responsive_control(
            'sub_title_spacing',
            [
                'label'     => __('Spacing', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-heading .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'show_dot_style',
            [
                'label' => __('Dot', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_dot_before',
            [
                'label' => __('Dot Before', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_dot_before',
            [
                'label' => __('Show', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'strollik5-core'),
                'label_on' => __('On', 'strollik5-core'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:before' => 'display: inline-block',
                ],
            ]
        );
        $this->add_control(
            'dot_before_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_dot_before' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_before_width',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_dot_before' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_before_height',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_dot_before' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_before_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_dot_before' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_before_border_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_dot_before' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'heading_dot_after',
            [
                'label' => __('Dot After', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_dot_after',
            [
                'label' => __('Show', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'strollik5-core'),
                'label_on' => __('On', 'strollik5-core'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:after' => 'display: inline-block;',
                ],
            ]
        );
        $this->add_control(
            'dot_after_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_dot_after' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_after_width',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_dot_after' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dot_after_height',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_dot_after' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_after_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_dot_after' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_after_border_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_dot_after' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'show_line_style',
            [
                'label' => __('Line', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_line_top_before',
            [
                'label' => __('Line Top', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_line_top',
            [
                'label' => __('Show', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'strollik5-core'),
                'label_on' => __('On', 'strollik5-core'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:before' => 'display: inline-block',
                ],
            ]
        );
        $this->add_control(
            'line_top_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_line_top' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_top_width',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'condition' => [
                    'show_line_top' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_top_height',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_line_top' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_top_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_dot_before' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_top_border_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_dot_before' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'heading_line_bottom',
            [
                'label' => __('Line Bottom', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_line_bottom',
            [
                'label' => __('Show', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'strollik5-core'),
                'label_on' => __('On', 'strollik5-core'),
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:after' => 'display: inline-block;',
                ],
            ]
        );
        $this->add_control(
            'line_bottom_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'show_line_bottom' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_bottom_width',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'condition' => [
                    'show_line_bottom' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_bottom_height',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_line_bottom' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_bottom_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_line_bottom' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_bottom_border_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'show_line_bottom' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

    }

    /**
     * Render heading widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['title'])) {
            return;
        }

        $this->add_render_attribute('title', 'class', 'elementor-heading-title');

        if (!empty($settings['size'])) {
            $this->add_render_attribute('title', 'class', 'elementor-size-' . $settings['size']);
        }

        $this->add_inline_editing_attributes('title');

        $title = $settings['title'];

        $title_html = '';

        if ($settings['sub_title']) {

            $title_html .= '<span class="sub-title">'.$settings['sub_title'].'</span>';
        }

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('url', 'href', $settings['link']['url']);

            if ($settings['link']['is_external']) {
                $this->add_render_attribute('url', 'target', '_blank');
            }

            if (!empty($settings['link']['nofollow'])) {
                $this->add_render_attribute('url', 'rel', 'nofollow');
            }

            $title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), $title);
        }

        $title_html .= sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('title'), $title);

        echo $title_html;
    }

    /**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _content_template() {
        ?>
        <#
        var title = settings.title;
        var title_html = '';

        if ( settings.sub_title ) {
        title_html += '<span class="sub-title">' + settings.sub_title + '</span>';
        }

        if ( '' !== settings.link.url ) {
        title = '<a href="' + settings.link.url + '">' + title + '</a>';
        }

        view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-size-' + settings.size ] );

        view.addInlineEditingAttributes( 'title' );

        title_html += '<' + settings.header_size  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.header_size + '>';

        print( title_html );
        #>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Heading());