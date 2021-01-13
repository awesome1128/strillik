<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class OSF_Elementor_Testimonials extends OSF_Elementor_Carousel_Base
{

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'opal-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Opal Testimonials', 'strollik5-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __('Testimonials', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => __('Testimonials Item', 'strollik5-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'testimonial_icon',
                        'label' => __('Icon', 'strollik5-core'),
                        'type' => Controls_Manager::ICON,
                        'default' => 'opal-icon-quote',
                    ],
                    [
                        'name' => 'testimonial_title',
                        'label' => __('Title', 'strollik5-core'),
                        'placeholder' => __('Enter...', 'strollik5-core'),
                        'default' => 'Title Testimonial',
                        'type' => Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'testimonial_content',
                        'label' => __('Content', 'strollik5-core'),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                        'label_block' => true,
                        'rows' => '10',
                    ],
                    [
                        'name' => 'testimonial_image',
                        'label' => __('Choose Image', 'strollik5-core'),
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'type' => Controls_Manager::MEDIA,
                        'show_label' => false,
                    ],
                    [
                        'name' => 'testimonial_name',
                        'label' => __('Name', 'strollik5-core'),
                        'default' => 'John Doe',
                        'type' => Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'testimonial_job',
                        'label' => __('Job', 'strollik5-core'),
                        'default' => 'Design',
                        'type' => Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'testimonial_link',
                        'label' => __('Link to', 'strollik5-core'),
                        'placeholder' => __('https://your-link.com', 'strollik5-core'),
                        'type' => Controls_Manager::URL,
                    ],
                    [
                        'name' => 'testimonial_rating',
                        'label' => __('Rating', 'strollik5-core'),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'star_5',
                        'options' => [
                            'star_1' => __('1 Star', 'strollik5-core'),
                            'star_2' => __('2 Star', 'strollik5-core'),
                            'star_3' => __('3 Star', 'strollik5-core'),
                            'star_4' => __('4 Star', 'strollik5-core'),
                            'star_5' => __('5 Star', 'strollik5-core'),
                        ],
                    ],

                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'testimonial_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'testimonial_alignment',
            [
                'label' => __('Alignment', 'strollik5-core'),
                'type' => Controls_Manager::CHOOSE,
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
                'label_block' => false,
                'prefix_class' => 'elementor-testimonial-text-align-',
            ]
        );


        $this->add_responsive_control(
            'column',
            [
                'label' => __('Columns', 'strollik5-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
            ]
        );

        $this->add_control(
            'testimonial_layout',
            [
                'label' => __('Layout', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'layout_1',
                'options' => [
                    'layout_1' => __('Layout 1', 'strollik5-core'),
                    'layout_2' => __('Layout 2', 'strollik5-core'),
                    'layout_3' => __('Layout 3', 'strollik5-core'),
                    'layout_4' => __('Layout 4', 'strollik5-core'),
                    'layout_5' => __('Layout 5', 'strollik5-core'),
                    'layout_6' => __('Layout 6', 'strollik5-core'),
                    'layout_7' => __('Layout 7', 'strollik5-core'),
                ],
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


        // WRAPPER STYLE
        $this->start_controls_section(
            'section_style_testimonial_wrapper',
            [
                'label' => __('Wrapper', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'width_testimonial_wrapper',
            [
                'label' => __('Width', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1180,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-box' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_wrapper_style');

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'wrapper_bg_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'wrapper_bg_color_hover',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .item-box',
            ]
        );

        $this->add_control(
            'wrapper_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .item-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .item-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                        'testimonial_layout!'   => 'layout_7'
                ]
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .item-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_line',
            [
                'label' => __('Show Line', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'on',
                'prefix_class' => 'elementor-testimonial-line-',
                'condition' => [
                    'testimonial_layout' => 'layout_1'
                ]
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label' => __('Hover Effect', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'on',
                'prefix_class' => 'elementor-testimonial-effect-'
            ]
        );

        $this->add_control(
            'heading_wrapper',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Animation', 'strollik5-core'),
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('tabs_wrapper_animation_style');

        $this->start_controls_tab(
            'tab_wrapper_animation_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_animation_box_shadow',
                'selector' => '{{WRAPPER}} .item-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_animation_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_animation_box_shadow_hover',
                'selector' => '{{WRAPPER}} .item-box:hover',
            ]
        );

        $this->add_control(
            'animation_wrapper',
            [
                'label' => __('Animation', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => array(
                    '' => esc_html__('None', 'strollik5-core'),
                    'move-up' => esc_html__('Move Up', 'strollik5-core'),
                    'move-down' => esc_html__('Move Down', 'strollik5-core'),
                ),
                'prefix_class' => 'wrapper-',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // Image.
        $this->start_controls_section(
            'section_style_testimonial_image',
            [
                'label' => __('Image', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Tab
        $this->start_controls_section(
            'section_style_testimonial_icon',
            [
                'label' => __('Icon', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [

                ]
            ]
        );

        $this->add_control(
            'testimonial_quote',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Quote', 'strollik5-core'),
            ]
        );

        $this->add_responsive_control(
            'testimonial_icon_size',
            [
                'label' => __('Size', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                        'testimonial_layout!'    => 'layout_2'
                ]
            ]
        );

        $this->add_responsive_control(
            'testimonial_icon_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_icon_color_hover',
            [
                'label' => __('Color Hover', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-icon i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_icon_spacing',
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
                    '{{WRAPPER}} .elementor-testimonial-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_layout!'    => 'layout_2'
                ]
            ]
        );

        $this->add_control(
            'testimonial_star_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Star', 'strollik5-core'),
                'separator' => 'before',
                'condition' => [
                    'testimonial_layout!'    => ['layout_3','layout_6','layout_7']
                ]
            ]
        );

        $this->add_responsive_control(
            'testimonial_star_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'testimonial_layout!'    => ['layout_3','layout_6','layout_7']
                ]
            ]
        );

        $this->add_responsive_control(
            'testimonial_star_spacing',
            [
                'label' => __('Star Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_layout!'    => ['layout_2','layout_3','layout_6','layout_7']
                ]
            ]
        );

        $this->end_controls_section();

        // Title
        $this->start_controls_section(
            'section_style_testimonial_title',
            [
                'label' => __('Title', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Color Hover', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content
        $this->start_controls_section(
            'section_style_testimonial_style',
            [
                'label' => __('Content', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_content_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_content_color_hover',
            [
                'label' => __('Color Hover', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-content',
                //'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-testimonial-content',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name Style
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label' => __('Name', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-name, {{WRAPPER}} .elementor-testimonial-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label' => __('Color Hover', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-name, {{WRAPPER}} .item-box:hover .elementor-testimonial-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_line',
            [
                'label' => __('Color Line', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-name:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                        'testimonial_layout'    => 'layout_6'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-name',
            ]
        );

        $this->add_responsive_control(
            'name_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                        'testimonial_layout!' => 'layout_3'
                ]
            ]
        );

        $this->add_control(
            'name_block',
            [
                'label' => __('Style Block', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'block',
                'prefix_class' => 'elementor-testimonial-name-',
                'condition' => [
                    'testimonial_layout' => 'layout_3'
                ]
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label' => __('Job', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_text_color_hover',
            [
                'label' => __('Color Hover', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .elementor-testimonial-job' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-job',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'job_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-testimonial-job',
            ]
        );

        $this->add_responsive_control(
            'job_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_layout!' => 'layout_3'
                ]
            ]
        );


        $this->end_controls_section();

        // Add Carousel Control
        $this->add_control_carousel();

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['testimonials']) && is_array($settings['testimonials'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-wrapper');
            $this->add_render_attribute('wrapper', 'class', $settings['testimonial_layout']);
//            if ($settings['testimonial_alignment']) {
//                $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-text-align-' . $settings['testimonial_alignment']);
//            }
            // Row
            $this->add_render_attribute('row', 'class', 'row');
            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                if (!empty($settings['column_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
                }
                if (!empty($settings['column_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
                }
            }

            // Item
            $this->add_render_attribute('item', 'class', 'elementor-testimonial-item');
            $this->add_render_attribute('item', 'class', 'column-item');


            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['testimonials'] as $testimonial): ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>

                            <div class="item-box" data-trigger="<?php echo '.tes-item-' . esc_attr($testimonial['_id']); ?>">

                                <!--                                    top-->
                                <div class="elementor-testimonial-content-top">

                                    <!--                                    icon-->
                                    <?php if ($testimonial['testimonial_icon'] && !in_array($settings['testimonial_layout'], ['layout_3','layout_4','layout_7'])): ?>
                                        <div class="elementor-testimonial-icon"><i
                                                    class="<?php echo esc_attr($testimonial['testimonial_icon']); ?>"></i>
                                        </div>
                                    <?php endif; ?>

                                    <!--                                    icon star style 5-->
                                    <?php if ($settings['testimonial_layout'] == 'layout_5'): ?>
                                        <div class="elementor-testimonial-rating <?php echo esc_attr($testimonial['testimonial_rating']); ?>">

                                            <?php
                                            $item_star = 1;
                                            while ($item_star <= 5):?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php
                                                $item_star++;
                                            endwhile; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($testimonial['testimonial_title']):?>
                                        <div class="elementor-testimonial-title"><?php echo $testimonial['testimonial_title']; ?></div>
                                    <?php endif;?>

                                    <?php if ($testimonial['testimonial_content']):?>
                                        <div class="elementor-testimonial-content">
                                            <?php echo $testimonial['testimonial_content']; ?>
                                        </div>
                                    <?php endif;?>

                                </div>

                                <!--author-->
                                <div class="elementor-testimonial-author-wrapper">

                                    <?php if (!in_array($settings['testimonial_layout'], ['layout_3', 'layout_5','layout_6','layout_7'])): ?>
                                        <div class="elementor-testimonial-rating <?php echo esc_attr($testimonial['testimonial_rating']); ?>">

                                            <?php
                                            $item_star = 1;
                                            while ($item_star <= 5):?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php
                                                $item_star++;
                                            endwhile; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="elementor-testimonial-details">
                                        <?php
                                        $testimonial_name_html = $testimonial['testimonial_name'];
                                        if (!empty($testimonial['testimonial_link']['url'])) :
                                            $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . $testimonial_name_html . '</a>';
                                        endif;
                                        ?>

                                        <?php if (!($settings['enable_carousel'] && $settings['testimonial_layout'] == 'layout_7')):?>
                                            <?php $this->render_image($settings, $testimonial); ?>
                                        <?php endif;?>

                                        <div class="elementor-testimonial-author">
                                            <div class="elementor-testimonial-name"><?php echo $testimonial_name_html; ?></div>
                                            <div class="elementor-testimonial-job">
                                                <?php if (!in_array($settings['testimonial_layout'], ['layout_3','layout_5','layout_6','layout_7'])): ?>
                                                    <span class="elementor-testimonial-prefix"><?php echo esc_html__('From', 'strollik5-core'); ?></span>
                                                <?php endif; ?>
                                                <?php echo $testimonial['testimonial_job']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if ($settings['enable_carousel']):?>
                    <div class="elementor-testimonial-dot-wrapper">
                        <?php foreach ($settings['testimonials'] as $index => $testimonial): ?>
                            <div class="elementor-testimonial-dot-image <?php echo 'tes-item-' . esc_attr($testimonial['_id']); ?>" data-index="<?php echo esc_attr($index) ?>" >
                                <?php $this->render_image($settings, $testimonial); ?>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>
            <?php
        }
    }

    private function render_image($settings, $testimonial)
    { ?>
        <div class="elementor-testimonial-image">
            <?php
            $testimonial['testimonial_image_size'] = $settings['testimonial_image_size'];
            $testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
            if (!empty($testimonial['testimonial_image']['url'])) :
                $image_html = Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image');
                echo $image_html;
            endif;
            ?>
        </div>
        <?php
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Testimonials());
