<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class OSF_Widget_Icon_Box extends Widget_Icon_Box {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'icon-box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Icon Box', 'strollik5-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

    public function get_categories() {
        return [ 'opal-addons' ];
    }

	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon Box', 'strollik5-core' ),
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
			'view',
			[
				'label' => __( 'View', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'strollik5-core' ),
					'stacked' => __( 'Stacked', 'strollik5-core' ),
					'framed' => __( 'Framed', 'strollik5-core' ),
				],
				'default' => 'default',
				'prefix_class' => 'elementor-view-',
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'strollik5-core' ),
					'square' => __( 'Square', 'strollik5-core' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
					'icon!' => '',
				],
				'prefix_class' => 'elementor-shape-',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title, Sub Title & Description', 'strollik5-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'strollik5-core' ),
				'placeholder' => __( 'Enter your title', 'strollik5-core' ),
				'label_block' => true,
			]
		);

        $this->add_control(
            'sub_title_text',
            [
                'label' => '',
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( '', 'strollik5-core' ),
                'placeholder' => __( 'Enter your sub title', 'strollik5-core' ),
                'rows' => 10,
                'separator' => 'none',
                'show_label' => false,
                'label_block' => true,
            ]
        );

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'strollik5-core' ),
				'placeholder' => __( 'Enter your description', 'strollik5-core' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link to', 'strollik5-core' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'strollik5-core' ),
				'separator' => 'before',
			]
		);

        $this->add_control(
            'link_download',
            [
                'label'       => __('Donload Link ?', 'strollik5-core'),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

		$this->add_control(
			'position',
			[
				'label' => __( 'Icon Position', 'strollik5-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'strollik5-core' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'strollik5-core' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'strollik5-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Title HTML Tag', 'strollik5-core' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'strollik5-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);

        $this->add_control(
            'icon_color_style',
            [
                'label' => __('Color Gradient', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'gradian',
                'prefix_class' => 'elementor-icon-box-'
            ]
        );

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
//				'scheme' => [
//					'type' => Scheme_Color::get_type(),
//					'value' => Scheme_Color::COLOR_1,
//				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked:not(:hover) .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed:not(:hover) .elementor-icon, {{WRAPPER}}.elementor-view-default:not(:hover) .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed:not(:hover) .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked:not(:hover) .elementor-icon' => 'color: {{VALUE}};',
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
                    'icon_color_style!' => ''
                ],

            ]
        );

        $this->add_control(
            'icon_color_gradian_secondary',
            [
                'label' => __('Secondary Gradian', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#0048ce',
                'condition' => [
                    'icon_color_style!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-icon-box-gradian .elementor-icon i:before' => 'background: -webkit-linear-gradient({{angle_gradian.SIZE}}{{angle_gradian.UNIT}}, {{primary_color.VALUE}} {{location_color.SIZE}}{{location_color.UNIT}} , {{VALUE}} {{location_secondary.SIZE}}{{location_secondary.UNIT}} ); -webkit-background-clip: text; -webkit-text-fill-color: transparent;',
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
                    'icon_color_style!' => ''
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
                    'icon_color_style!' => ''
                ],
            ]
        );

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'strollik5-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'strollik5-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}:not(:hover) .elementor-icon' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'view' => 'framed',
                ],
            ]
        );

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'strollik5-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hover',
			[
				'label' => __( 'Icon Hover', 'strollik5-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon, {{WRAPPER}}.elementor-view-default:hover .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed:hover .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'location_color_hover',
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
                    'icon_color_style!' => ''
                ],

            ]
        );

        $this->add_control(
            'icon_color_gradian_secondary_hover',
            [
                'label' => __('Secondary Gradian', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#0048ce',
                'condition' => [
                    'icon_color_style!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-icon-box-gradian:hover .elementor-icon i:before' => 'background: -webkit-linear-gradient({{angle_gradian_hover.SIZE}}{{angle_gradian_hover.UNIT}}, {{hover_primary_color.VALUE}} {{location_color_hover.SIZE}}{{location_color_hover.UNIT}} , {{VALUE}} {{location_secondary_hover.SIZE}}{{location_secondary_hover.UNIT}} ); -webkit-background-clip: text; -webkit-text-fill-color: transparent;',
                ],
            ]
        );

        $this->add_control(
            'location_secondary_hover',
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
                    'icon_color_style!' => ''
                ],

            ]
        );

        $this->add_control(
            'angle_gradian_hover',
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
                    'icon_color_style!' => ''
                ],
            ]
        );

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'strollik5-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'strollik5-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'strollik5-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'strollik5-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'strollik5-core' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'strollik5-core' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'strollik5-core' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'strollik5-core' ),
					'middle' => __( 'Middle', 'strollik5-core' ),
					'bottom' => __( 'Bottom', 'strollik5-core' ),
				],
				'default' => 'top',
				'prefix_class' => 'elementor-vertical-align-',
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'strollik5-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content:not(:hover) .elementor-icon-box-title' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'title_color_hover',
            [
                'label' => __( 'Hover Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-box:hover .elementor-icon-box-title' => 'color: {{VALUE}};',
                ],
//                'scheme' => [
//                    'type' => Scheme_Color::get_type(),
//                    'value' => Scheme_Color::COLOR_1,
//                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

        $this->add_control(
            'heading_subtitle',
            [
                'label' => __( 'Sub Title', 'strollik5-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'subtitle_bottom_space',
            [
                'label' => __( 'Spacing', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label' => __( 'Hover Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-box:hover .elementor-icon-box-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-subtitle',
            ]
        );

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'strollik5-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'description_color_hover',
            [
                'label' => __( 'Hover Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-box:hover .elementor-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
				//'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

        $icon_tag = 'span';
        $has_icon = ! empty( $settings['icon'] );

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
            $icon_tag = 'a';

            if ( $settings['link']['is_external'] ) {
                $this->add_render_attribute( 'link', 'target', '_blank' );
            }

            if ( $settings['link']['nofollow'] ) {
                $this->add_render_attribute( 'link', 'rel', 'nofollow' );
            }

            if($settings['link_download'] === 'yes'){
                $this->add_render_attribute( 'link', 'download' );
            }
        }

        if ( $has_icon ) {
            $this->add_render_attribute( 'i', 'class', $settings['icon'] );
            $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
        }

        $icon_attributes = $this->get_render_attribute_string( 'icon' );
        $link_attributes = $this->get_render_attribute_string( 'link' );

        $this->add_render_attribute( 'description_text', 'class', 'elementor-icon-box-description' );
        $this->add_render_attribute( 'sub_title_text', 'class', 'elementor-icon-box-subtitle' );

        $this->add_inline_editing_attributes( 'title_text', 'none' );
        $this->add_inline_editing_attributes( 'description_text' );
        ?>
        <div class="elementor-icon-box-wrapper">
        <?php if ( $has_icon ) : ?>
            <div class="elementor-icon-box-icon">
            <<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
            <i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
            </<?php echo $icon_tag; ?>>
            </div>
        <?php endif; ?>
        <div class="elementor-icon-box-content">
            <span <?php echo $this->get_render_attribute_string( 'sub_title_text' ); ?>><?php echo $settings['sub_title_text']; ?></span>
            <<?php echo $settings['title_size']; ?> class="elementor-icon-box-title">
                <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
            </<?php echo $settings['title_size']; ?>>
            <p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $settings['description_text']; ?></p>
            </div>
        </div>
        <?php
    }

    /**
     * Render icon box widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template() {
        ?>
        <#
        var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
        iconTag = link ? 'a' : 'span';

        view.addRenderAttribute( 'description_text', 'class', 'elementor-icon-box-description' );

        view.addInlineEditingAttributes( 'title_text', 'none' );
        view.addInlineEditingAttributes( 'description_text' );
        #>
        <div class="elementor-icon-box-wrapper">
            <# if ( settings.icon ) { #>
            <div class="elementor-icon-box-icon">
                <{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
                <i class="{{ settings.icon }}" aria-hidden="true"></i>
            </{{{ iconTag }}}>
        </div>
        <# } #>
        <div class="elementor-icon-box-content">
            <span {{{ view.getRenderAttributeString( 'sub_title_text' ) }}}>{{{ settings.sub_title_text }}}</span>
            <{{{ settings.title_size }}} class="elementor-icon-box-title">
            <{{{ iconTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
        </{{{ settings.title_size }}}>
        <p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
        </div>
        </div>
        <?php
    }
}
$widgets_manager->register_widget_type(new OSF_Widget_Icon_Box());