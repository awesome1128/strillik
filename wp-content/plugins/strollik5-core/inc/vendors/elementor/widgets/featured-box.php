<?php

namespace Elementor;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor featured box widget.
 *
 * Elementor widget that displays an image, a headline and a text.
 *
 * @since 1.0.0
 */
class OSF_Widget_Featured_Box extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve featured box widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'featured-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve featured box widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Featured Box', 'strollik5-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve featured box widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-image-box';
    }

    public function get_categories()
    {
        return ['opal-addons'];
    }

    /**
     * Register featured box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Featured Box', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'strollik5-core'),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => __('Title', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('This is the heading', 'strollik5-core'),
                'placeholder' => __('Enter your title', 'strollik5-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => __('Description', 'strollik5-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'strollik5-core'),
                'placeholder' => __('Enter your description', 'strollik5-core'),
                'separator' => 'none',
                'rows' => 10,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link to', 'strollik5-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'strollik5-core'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __('Alignment', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Top', 'strollik5-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label' => __('Title HTML Tag', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __('View', 'strollik5-core'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => __('Wrapper', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_view_wrapper_style');

        $this->start_controls_tab(
            'view_wrapper_button_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'bg_wrapper',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_wrapper_button_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'bg_wrapper_hover',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_wrapper_hover',
            [
                'label' => __('Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow_hover',
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper:hover,{{WRAPPER}}.activate .elementor-featured-box-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_wrapper',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-featured-box-wrapper',
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __('Icon', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'size_icon',
            [
                'label' => __('Font Size', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_icon',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_icon',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_view_icon_style');

        $this->start_controls_tab(
            'view_icon_button_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-top i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_icon_button_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-top i' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-top i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_hover',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('section_style_title',
            [
                'label' => __('Title', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-featured-box-title',
            ]
        );
        $this->add_responsive_control(
            'width_title',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_title',
            [
                'label' => __('Height', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1920,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_view_title_style');

        $this->start_controls_tab(
            'view_title_button_normal',
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
                    '{{WRAPPER}} .elementor-featured-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' =>'title_background',
                'selector' => '{{WRAPPER}} .elementor-featured-box-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .elementor-featured-box-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' =>'title_boxshadow',
                'selector' => '{{WRAPPER}} .elementor-featured-box-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_title_button_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' =>'title_background_hover',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-title',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-title',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border_hover',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-title',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-title',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' =>'title_boxshadow_hover',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-title',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-title',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'title_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'padding_title',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing_title',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alignment_subtitle',
            [
                'label' => __('Alignment', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Top', 'strollik5-core'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-title' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label' => __('Description', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-featured-box-description',
            ]
        );

        $this->start_controls_tabs('tabs_view_description_style');

        $this->start_controls_tab(
            'view_description_button_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_description_button_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'description_color_hover',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-featured-box-wrapper:hover .elementor-featured-box-description' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.activate .elementor-featured-box-wrapper .elementor-featured-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'elementor-featured-box-wrapper');

        $html = '<div ' . $this->get_render_attribute_string("wrapper") . '>';

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('link', 'href', $settings['link']['url']);

            if ($settings['link']['is_external']) {
                $this->add_render_attribute('link', 'target', '_blank');
            }

            if (!empty($settings['link']['nofollow'])) {
                $this->add_render_attribute('link', 'rel', 'nofollow');
            }
        }

        //icon

        $html .= '<div class="elementor-featured-box-top">';


        if (!empty($settings['icon'])) {

            $this->add_render_attribute('icon', 'class', $settings['icon']);

            $this->add_render_attribute('icon', 'aria-hidden', 'true');

            $html .= '<div class="elementor-featured-box-icon">';

            $html .= '<i class="' . $settings['icon'] . '" aria-hidden="true" ></i>';

            $html .= '</div>';
        }

        $html .= '</div>';

        //end icon


        $html .= '<div class="elementor-featured-box-bottom">';

        if (!empty($settings['title_text'])) {
            $this->add_render_attribute('title_text', 'class', 'elementor-featured-box-title');

            $title_html = $settings['title_text'];

            if (!empty($settings['link']['url'])) {
                $title_html = '<a ' . $this->get_render_attribute_string('link') . '>' . $title_html . '</a>';
            }

            $html .= sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string('title_text'), $title_html);
        }

        if (!empty($settings['description_text'])) {
            $this->add_render_attribute('description_text', 'class', 'elementor-featured-box-description');

            $html .= sprintf('<p %1$s>%2$s</p>', $this->get_render_attribute_string('description_text'), $settings['description_text']);
        }

        $html .= '</div>';

        $html .= '</div>';

        echo $html;
    }
}

$widgets_manager->register_widget_type(new OSF_Widget_Featured_Box());
