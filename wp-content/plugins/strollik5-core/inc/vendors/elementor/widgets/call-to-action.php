<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class OSF_Elementor_CallToAction extends Elementor\Widget_Base {


	public function get_name() {
		return 'call-to-action';
	}

	public function get_categories() {
		return [ 'opal-addons' ];
	}


	public function get_title() {
		return __( 'Call to Action', 'strollik5-core' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_main_image',
			[
				'label' => __( 'Image', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => __( 'Skin', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'classic' => __( 'Classic', 'strollik5-core' ),
					'cover' => __( 'Cover', 'strollik5-core' ),
				],
				'render_type' => 'template',
				'prefix_class' => 'elementor-cta--skin-',
				'default' => 'classic',
			]
		);

		$this->add_responsive_control(
			'layout',
			[
				'label' => __( 'Layout', 'strollik5-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'strollik5-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'above' => [
						'title' => __( 'Above', 'strollik5-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'strollik5-core' ),
						'icon'  => 'eicon-h-align-right',
					],
                    'below' => [
                        'title' => __( 'Below', 'strollik5-core' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
				],
				'prefix_class' => 'elementor-cta-%s-layout-image-',
				'condition' => [
					'skin!' => 'cover',
				],
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' => __( 'Choose Image', 'strollik5-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'show_label' => false,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'bg_image', // Actually its `image_size`
				'label' => __( 'Image Resolution', 'strollik5-core' ),
				'default' => 'large',
				'condition' => [
					'bg_image[id]!' => '',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'graphic_element',
			[
				'label' => __( 'Graphic Element', 'strollik5-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'none' => [
						'title' => __( 'None', 'strollik5-core' ),
						'icon' => 'fa fa-ban',
					],
					'image' => [
						'title' => __( 'Image', 'strollik5-core' ),
						'icon' => 'fa fa-picture-o',
					],
					'icon' => [
						'title' => __( 'Icon', 'strollik5-core' ),
						'icon' => 'fa fa-star',
					],
				],
				'separator' => 'before',
				'default' => 'none',
			]
		);

		$this->add_control(
			'graphic_image',
			[
				'label' => __( 'Choose Image', 'strollik5-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'graphic_element' => 'image',
				],
				'show_label' => false,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'graphic_image', // Actually its `image_size`
				'default' => 'thumbnail',
				'condition' => [
					'graphic_element' => 'image',
					'graphic_image[id]!' => '',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'strollik5-core' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-star',
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => __( 'View', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'strollik5-core' ),
					'stacked' => __( 'Stacked', 'strollik5-core' ),
					'framed' => __( 'Framed', 'strollik5-core' ),
				],
				'default' => 'default',
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label' => __( 'Shape', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'strollik5-core' ),
					'square' => __( 'Square', 'strollik5-core' ),
				],
				'default' => 'circle',
				'condition' => [
					'icon_view!' => 'default',
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title & Description', 'strollik5-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'strollik5-core' ),
				'placeholder' => __( 'Enter your title', 'strollik5-core' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'strollik5-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'strollik5-core' ),
				'placeholder' => __( 'Enter your description', 'strollik5-core' ),
				'separator' => 'none',
				'rows' => 5,
				'show_label' => false,
			]
		);

		$this->add_control(
			'title_tag',
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
				],
				'default' => 'h2',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'button',
			[
				'label' => __( 'Button Text', 'strollik5-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'strollik5-core' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'strollik5-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'strollik5-core' ),

			]
		);

		$this->add_control(
			'link_click',
			[
				'label' => __( 'Apply Link On', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'box' => __( 'Whole Box', 'strollik5-core' ),
					'button' => __( 'Button Only', 'strollik5-core' ),
				],
				'default' => 'button',
				'separator' => 'none',
				'condition' => [
					'link[url]!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon',
			[
				'label' => __( 'Ribbon', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'ribbon_title',
			[
				'label' => __( 'Title', 'strollik5-core' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'ribbon_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'strollik5-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'strollik5-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'strollik5-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => __( 'Wrapper', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_wrapper_style' );

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => __( 'Normal', 'strollik5-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_wrapper',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementor-cta',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-cta',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => __( 'Hover', 'strollik5-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_wrapper_hover',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementor-cta:hover',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow_hover',
                'selector' => '{{WRAPPER}} .elementor-cta:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => __( 'Padding', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_border',
                'selector' => '{{WRAPPER}} .elementor-cta',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_transformation',
            [
                'label' => __( 'Hover Animation', 'strollik5-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'move-up' => 'Move Up',
                    'move-down' => 'Move Down',
                ],
                'default' => 'none',
                'prefix_class' => 'call-to-action-wrapper-transform-',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'wrapper_effect_duration',
            [
                'label' => __( 'Effect Duration', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta' => 'transition-duration: {{SIZE}}ms',
                ],
            ]
        );

        $this->end_controls_section();



		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box', 'strollik5-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'show_background_svg',
            [
                'label'     => __('Show Background Decor', 'strollik5-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'strollik5-core'),
                'label_off' => __('Hide', 'strollik5-core'),
//                'default'   => 'no',
            ]
        );


        $this->add_control(
            'background_svg_color',
            [
                'label'     => __('Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'show_background_svg' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'background_svg_size',
            [
                'label'      => __( 'Size', 'strollik5-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__content svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_background_svg' => 'yes',
                ]
            ]
        );



		$this->add_responsive_control(
			'min-height',
			[
				'label' => __( 'Min. Height', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__content' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'strollik5-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__content' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'vertical_position',
			[
				'label' => __( 'Vertical Position', 'strollik5-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'strollik5-core' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'strollik5-core' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'strollik5-core' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'elementor-cta--valign-',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'strollik5-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_bg_image_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Image', 'strollik5-core' ),
				'condition' => [
					'bg_image[url]!' => '',
					'skin' => 'classic',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_min_width',
			[
				'label' => __( 'Min. Width', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__bg-wrapper' => 'min-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_min_height',
			[
				'label' => __( 'Min. Height', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],

				'selectors' => [
					'{{WRAPPER}} .elementor-cta__bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'graphic_element_style',
			[
				'label' => __( 'Graphic Element', 'strollik5-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'graphic_element!' => 'none',
				],
			]
		);

		$this->add_control(
			'graphic_image_spacing',
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
					'{{WRAPPER}} .elementor-cta__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'graphic_image_width',
			[
				'label' => __( 'Size (%)', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'graphic_image_opacity',
			[
				'label' => __( 'Opacity', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__image' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'graphic_image_border',
				'selector' => '{{WRAPPER}} .elementor-cta__image img',
				'condition' => [
					'graphic_element' => 'image',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'graphic_image_border_radius',
			[
				'label' => __( 'Border Radius', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
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
					'{{WRAPPER}} .elementor-icon-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => __( 'Primary Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'strollik5-core' ),
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
				'condition' => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Icon Padding', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label' => __( 'Border Width', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view' => 'framed',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'strollik5-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'strollik5-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'title',
							'operator' => '!==',
							'value' => '',
						],
						[
							'name' => 'description',
							'operator' => '!==',
							'value' => '',
						],
						[
							'name' => 'button',
							'operator' => '!==',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'heading_style_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'strollik5-core' ),
				'separator' => 'before',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-cta__title',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_style_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'strollik5-core' ),
				'separator' => 'before',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementor-cta__description',
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Spacing', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'heading_content_colors',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Colors', 'strollik5-core' ),
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'color_tabs' );

		$this->start_controls_tab( 'colors_normal',
			[
				'label' => __( 'Normal', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => __( 'Background Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__content' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'colors_hover',
			[
				'label' => __( 'Hover', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'content_bg_color_hover',
			[
				'label' => __( 'Background Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta:hover .elementor-cta__content' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin' => 'classic',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta:hover .elementor-cta__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_color_hover',
			[
				'label' => __( 'Description Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta:hover .elementor-cta__description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description!' => '',
				],
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Button Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta:hover .elementor-cta__button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button', 'strollik5-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button!' => '',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Size', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => __( 'Extra Small', 'strollik5-core' ),
					'sm' => __( 'Small', 'strollik5-core' ),
					'md' => __( 'Medium', 'strollik5-core' ),
					'lg' => __( 'Large', 'strollik5-core' ),
					'xl' => __( 'Extra Large', 'strollik5-core' ),
				],
			]
		);
		$this->add_control(
			'button_type',
			[
				'label' => __( 'Type', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
                    '' => __('Default', 'strollik5-core'),
                    'primary' => __('Primary', 'strollik5-core'),
                    'secondary' => __('Secondary', 'strollik5-core'),
                    'outline_primary' => __('Outline Primary', 'strollik5-core'),
                    'outline_secondary' => __('Outline Secondary', 'strollik5-core'),
                    'dark' => __('Dark', 'strollik5-core'),
                    'light' => __('Light', 'strollik5-core'),
                    'link' => __('Link', 'strollik5-core'),
                    'info' => __('Info', 'strollik5-core'),
                    'success' => __('Success', 'strollik5-core'),
                    'warning' => __('Warning', 'strollik5-core'),
                    'danger' => __('Danger', 'strollik5-core'),
				],
				'prefix_class' => 'elementor-button-',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Typography', 'strollik5-core' ),
				'selector' => '{{WRAPPER}} .elementor-cta__button',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'button_normal',
			[
				'label' => __( 'Normal', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button-hover',
			[
				'label' => __( 'Hover', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __( 'Background Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_border_width',
			[
				'label' => __( 'Border Width', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

        $this->add_control(
            'button_border_style',
            [
                'label' => __( 'Border Style', 'strollik5-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'strollik5-core' ),
                    'solid' => __( 'Solid', 'strollik5-core' ),
                    'dashed' => __( 'Dashed', 'strollik5-core' ),
                    'dotted' => __( 'Dotted', 'strollik5-core' ),
                    'double' => __( 'Double', 'strollik5-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-style: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',
			[
				'label' => __( 'Ribbon', 'strollik5-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$this->add_control(
			'ribbon_bg_color',
			[
				'label' => __( 'Background Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-ribbon-inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ribbon_text_color',
			[
				'label' => __( 'Text Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-ribbon-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ribbon_distance',
			[
				'label' => __( 'Distance', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .elementor-ribbon-inner',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .elementor-ribbon-inner',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'img_hover_effects',
			[
				'label' => __( 'Image Hover Effects', 'strollik5-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_hover_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Content', 'strollik5-core' ),
				'separator' => 'before',
				'condition' => [
					'skin' => 'cover',
				],
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => __( 'Hover Animation', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'groups' => [
					[
						'label' => __( 'None', 'strollik5-core' ),
						'options' => [
							'' => __( 'None', 'strollik5-core' ),
						],
					],
					[
						'label' => __( 'Entrance', 'strollik5-core' ),
						'options' => [
							'enter-from-right' => 'Slide In Right',
							'enter-from-left' => 'Slide In Left',
							'enter-from-top' => 'Slide In Up',
							'enter-from-bottom' => 'Slide In Down',
							'enter-zoom-in' => 'Zoom In',
							'enter-zoom-out' => 'Zoom Out',
							'fade-in' => 'Fade In',
						],
					],
					[
						'label' => __( 'Reaction', 'strollik5-core' ),
						'options' => [
							'grow' => 'Grow',
							'shrink' => 'Shrink',
							'move-right' => 'Move Right',
							'move-left' => 'Move Left',
							'move-up' => 'Move Up',
							'move-down' => 'Move Down',
						],
					],
					[
						'label' => __( 'Exit', 'strollik5-core' ),
						'options' => [
							'exit-to-right' => 'Slide Out Right',
							'exit-to-left' => 'Slide Out Left',
							'exit-to-top' => 'Slide Out Up',
							'exit-to-bottom' => 'Slide Out Down',
							'exit-zoom-in' => 'Zoom In',
							'exit-zoom-out' => 'Zoom Out',
							'fade-out' => 'Fade Out',
						],
					],
				],
				'default' => 'grow',
				'condition' => [
					'skin' => 'cover',
				],
			]
		);

		/*
		 *
		 * Add class 'elementor-animated-content' to widget when assigned content animation
		 *
		 */
		$this->add_control(
			'animation_class',
			[
				'label' => 'Animation',
				'type' => Controls_Manager::HIDDEN,
				'default' => 'animated-content',
				'prefix_class' => 'elementor-',
				'condition' => [
					'content_animation!' => '',
				],
			]
		);

		$this->add_control(
			'content_animation_duration',
			[
				'label' => __( 'Animation Duration', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default' => [
					'size' => 1000,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__content-item' => 'transition-duration: {{SIZE}}ms',
					'{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
					'{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
					'{{WRAPPER}}.elementor-cta--sequenced-animation .elementor-cta__content-item:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
				],
				'condition' => [
					'content_animation!' => '',
					'skin' => 'cover',
				],
			]
		);

		$this->add_control(
			'sequenced_animation',
			[
				'label' => __( 'Sequenced Animation', 'strollik5-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'strollik5-core' ),
				'label_off' => __( 'Off', 'strollik5-core' ),
				'return_value' => 'elementor-cta--sequenced-animation',
				'prefix_class' => '',
				'condition' => [
					'content_animation!' => '',
				],
			]
		);

		$this->add_control(
			'background_hover_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Background', 'strollik5-core' ),
				'separator' => 'before',
				'condition' => [
					'skin' => 'cover',
				],
			]
		);

		$this->add_control(
			'transformation',
			[
				'label' => __( 'Hover Animation', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => 'None',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'move-left' => 'Move Left',
					'move-right' => 'Move Right',
					'move-up' => 'Move Up',
					'move-down' => 'Move Down',
				],
				'default' => 'zoom-in',
				'prefix_class' => 'elementor-bg-transform elementor-bg-transform-',
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Overlay Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta:not(:hover) .elementor-cta__bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'overlay_blend_mode',
			[
				'label' => __( 'Blend Mode', 'strollik5-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'strollik5-core' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta__bg-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'strollik5-core' ),
			]
		);

		$this->add_control(
			'overlay_color_hover',
			[
				'label' => __( 'Overlay Color', 'strollik5-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-cta:hover .elementor-cta__bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);



		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'effect_duration',
			[
				'label' => __( 'Effect Duration', 'strollik5-core' ),
				'type' => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default' => [
					'size' => 500,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-cta .elementor-cta__bg, {{WRAPPER}} .elementor-cta .elementor-cta__bg-overlay' => 'transition-duration: {{SIZE}}ms',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$title_tag = $settings['title_tag'];
		$wrapper_tag = 'div';
		$button_tag = 'a';
		$link_url = empty( $settings['link']['url'] ) ? false : $settings['link']['url'];
		$bg_image = '';
		$content_animation = $settings['content_animation'];
		$animation_class = '';
		$print_bg = true;
		$print_content = true;

		if ( ! empty( $settings['bg_image']['id'] ) ) {
			$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
		} elseif ( ! empty( $settings['bg_image']['url'] ) ) {
			$bg_image = $settings['bg_image']['url'];
		}

		if ( empty( $bg_image ) && 'classic' == $settings['skin'] ) {
			$print_bg = false;
		}

		if ( empty( $settings['title'] ) && empty( $settings['description'] ) && empty( $settings['button'] ) && 'none' == $settings['graphic_element'] ) {
			$print_content = false;
		}

		$this->add_render_attribute( 'background_image', 'style', [
			'background-image: url(' . $bg_image . ');',
		] );

		$this->add_render_attribute( 'title', 'class', [
			'elementor-cta__title',
			'elementor-cta__content-item',
			'elementor-content-item',
		] );

		$this->add_render_attribute( 'description', 'class', [
			'elementor-cta__description',
			'elementor-cta__content-item',
			'elementor-content-item',
		] );

		$this->add_render_attribute( 'button', 'class', [
			'elementor-cta__button',
			'elementor-button',
			'elementor-size-' . $settings['button_size'],
		] );

		$this->add_render_attribute( 'graphic_element', 'class',
			[
				'elementor-content-item',
				'elementor-cta__content-item',
			]
		);

		if ( 'icon' === $settings['graphic_element'] ) {
			$this->add_render_attribute( 'graphic_element', 'class',
				[
					'elementor-icon-wrapper',
					'elementor-cta__icon',
				]
			);
			$this->add_render_attribute( 'graphic_element', 'class', 'elementor-view-' . $settings['icon_view'] );
			if ( 'default' != $settings['icon_view'] ) {
				$this->add_render_attribute( 'graphic_element', 'class', 'elementor-shape-' . $settings['icon_shape'] );
			}
			if ( ! empty( $settings['icon'] ) ) {
				$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			}
		} elseif ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) {
			$this->add_render_attribute( 'graphic_element', 'class', 'elementor-cta__image');
		}

		if ( ! empty( $content_animation ) && 'cover' == $settings['skin'] ) {

			$animation_class = 'elementor-animated-item--' . $content_animation;

			$this->add_render_attribute( 'title', 'class', $animation_class );

			$this->add_render_attribute( 'graphic_element', 'class', $animation_class );

			$this->add_render_attribute( 'description', 'class', $animation_class );

		}

		if ( ! empty( $link_url ) ) {

			if ( 'box' === $settings['link_click'] ) {
				$wrapper_tag = 'a';
				$button_tag  = 'button';
				$this->add_render_attribute( 'wrapper', 'href', $link_url );
				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'wrapper', 'target', '_blank' );
				}
			} else {
				$this->add_render_attribute( 'button', 'href', $link_url );
				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}
			}
		}

		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'description' );
		$this->add_inline_editing_attributes( 'button' );

		?>
		<<?php echo $wrapper_tag . ' ' . $this->get_render_attribute_string( 'wrapper' ); ?> class="elementor-cta">
		<?php if ( $print_bg ) : ?>
			<div class="elementor-cta__bg-wrapper">
				<div class="elementor-cta__bg elementor-bg" <?php echo $this->get_render_attribute_string( 'background_image' ); ?>></div>
				<div class="elementor-cta__bg-overlay"></div>
			</div>
		<?php endif; ?>
		<?php if ( $print_content ) : ?>
			<div class="elementor-cta__content">
            <?php if ($settings['show_background_svg']) : ?>
                <svg enable-background="new 0 0 482 415" viewBox="0 0 482 415" xmlns="http://www.w3.org/2000/svg"><path d="m146.1 403.9c-.3 0-.5.1-.7.2s-.5.2-.7.2c-.1 0-.2 0-.2 0 .9 1.5 1.5 2 1.9 2 .3 0 .5-.3.7-.5.2-.3.3-.5.5-.5.1 0 .2.1.4.3-.9-1.4-1.4-1.7-1.9-1.7zm245.4-81.3c.9 1.8 1.7 2.4 2.3 2.4.9 0 1.7-1.5 2.4-3.1.8-1.5 1.7-3.1 3-3.1h.1c-.4-.1-.8-.2-1.3-.2-2.3.2-5.2 1.5-6.5 4zm-7 2.7c-1.3 0-2.6 1-3.8 2-1.3 1-2.6 2-4 2-.4 0-.7-.1-1.1-.2.3 1.3 1.2 2.1 2.1 2.1.7 0 1.4-.6 1.5-1.9.8.5 1.5.7 2.3.7 2.1 0 4.1-1.4 6.2-2.7-1.2-1.4-2.2-2-3.2-2zm18.2-8.2c0 .1-.1.1-.1.1-.1 0-.2-.2-.4-.5-.3.5.7.9.2 1.4.3.4.5.5.7.5.7 0 1.2-1.5 1.6-2.4-.3-.3-.7-.4-1-.4-.5.1-1 .4-1 1.3zm36.3-87.8c-.2.3-.5.5-.8.5.3.3.6.4.8.4.6 0 1.1-.8 1-1.4-.1 0-.1 0-.2 0-.3 0-.5.3-.8.5zm-290.2 174c-.2 0-.4.2-.6.4s-.3.4-.6.4c-.1 0-.2 0-.3-.1.9 1.3 1.4 1.5 1.9 1.5.2 0 .3 0 .5-.1.2 0 .3-.1.5-.1.1 0 .3 0 .4.1-.9-1.7-1.4-2.1-1.8-2.1zm4.4-.9c-.3 0-.5 0-.6 0-.9.1-1.7.7-1.8 2 1 1.1 1.9 1.5 2.7 1.5 1.5 0 2.5-1.3 2.6-2.2-.6-1.1-2-1.3-2.9-1.3zm205.8-64.2c-.6 0-1.1.5-1.2 1.2.5.6 1.2.9 1.8.9s1-.3 1.1-.9c-.5-.8-1.1-1.2-1.7-1.2zm4.7-1.4c.6.4 1.1.6 1.6.6 2 0 3.2-2.8 4.3-3.1-.4-.3-.9-.5-1.3-.5-2 .1-3.7 2.6-4.6 3zm8.8-5.6c-1.3 0-2.2 2.6-2.7 3.7.5.4 1 .6 1.3.6 1.3 0 2-2.1 1.9-4.2-.1-.1-.3-.1-.5-.1zm50.7-239.9c.3-.6.8-.8 1.3-.8.4 0 .8.1 1.2.2s.8.2 1.2.2c.6 0 1-.3 1.1-1.6-1.1-1.1-3-2.2-4.3-2.2-1.3.1-1.9 1.2-.5 4.2zm15.1 3.6s-.1 0-.2 0c1.4.9 2.6 1.2 3.6 1.2 3.6 0 5-4.4 6.7-6.2-2.8-5.4-3-2.6-4.8-4.9-.4 1 1.5 4.5.9 5.3-1.2-.1-1.7-3.2-3.3-4.8-.1.4-.2.5-.5.5-.2 0-.5-.1-.7-.2-.6-.8-1-1.1-1.4-1.1-.1 0-.2 0-.3.1-1.8-3.9 1.4-2.1.6-4.9-.6-.6-1.2-.8-1.6-.8-.8 0-1.4.8-1.9 1.6s-1 1.6-1.6 1.6c-.1 0-.2 0-.2 0 1.5 1.7 2.6 2.6 3.6 3.3h-.1c-.2 0-.3 0-.5-.1 1.2 1.4 1.9 1.8 2.4 1.8.2 0 .4-.1.5-.2.7.5 1.5 1.2 2.5 2.1.8 3.4-2.8-.2-1.5 3.9-1.5-.8-2.1-2.7-3.6-4.7-1 .6 2.9 6.5 1.4 6.5zm-2.5-21.7c.2 0 .4-.2.5-.4.2-.2.3-.4.5-.4h.1c-.6-1.1-1-1.4-1.4-1.4-.5 0-.7 1-.6 1.5.4.5.7.7.9.7zm-18.6 14.8-.4-.2.2.3zm-342.1 292.2c.2.1.5.2.7.2 2.3 0 4.3-4.3 6.6-5.2-.1 0-.1 0-.2 0-1.9 0-5.9 2-7.1 5zm388.8-311.3c-1-1.5-2.3-2.6-2.9-2.6-.4 0-.5.5.1 1.9.8.7 1.9 1.5 2.5 1.5.3 0 .5-.2.3-.8zm-12.6 11.2c-.7 0-1.2.7-1.8 1.1 2 3.2 3.6 4.8 4.3 4.8.8 0 .6-1.6-.7-4.7-.8-.8-1.4-1.2-1.8-1.2zm-84.1-2.8c.6.8.9 1.2 1.1 1.2.5 0-.5-2.9-1.4-4.7-.9 0-.1 1.9.3 3.5zm92.3 6.2c2.6 0 4.2-2.6.7-9.6-.2 1-.9 1.3-1.8 1.3-.4 0-.9-.1-1.4-.1-.5-.1-1-.1-1.5-.1-1.8 0-2.9.9-.7 6.6 1.6 1.1 3.3 1.9 4.7 1.9zm11.4 19.8s.2-.2.6-.8c-.4-.4-.8-.7-1.2-.7-.2 0-.4.2-.5.6.2 0 .3-.1.4-.1.5 0 .6.3.6.5.1.3 0 .5.1.5zm-6-30c-.5 0-.3 1.5-.5 2 .9 1.4 1.5 2 1.8 2 .5 0 .5-1.2.2-2.2-.8-1.4-1.3-1.8-1.5-1.8zm-32.7 12.8c-1.4-1.7-3.1-2.5-4.3-2.5s-1.9.8-1.5 2.5c1.8 2.9 3.1 4.3 4 4.3-2.5-4.2 1.5-1.9 1.8-4.3zm36.8 20.9c-.5-1.2-.6-2.7-1.3-3.7.3 1.3-.6 2.6 1.3 3.7zm-322.1-59.4c.4.2.7.3 1.1.3.9 0 1.6-.6 2.2-1.6-.6-.8-1.1-1.1-1.6-1.1s-.9.4-1.3.8-.8.8-1.3.8c.4.3 1.1 0 .9.8zm4.2-1.6c2.1-.5 3.9-2.2 6.2-2.2.5 0 1 .1 1.5.3l1.5-2s.1-.1.1-.1c2.1-1.7 5.1-2.8 8.1-3.8 3.1-1 6.2-1.8 8.2-3 .4-.2 2.6-1.5 1.2-2.5-.6-1-.9-1.4-1.2-1.4-.4 0-.3 1.5-.8 1.8-3.1.1-6.9.8-10.2 2.2-2 .9-3.9 2.1-5.4 3.5-1 .9-1.8 2-2.5 3.2-.7-.1-1.3-.1-1.9-.1-2.4 0-4.6.6-6.4 2.9.8.8 1.1.5 1.6 1.2zm-65.7 53.4c-.4-.1-.7-.2-1-.2-2.4 0-2.5 3.7-3.5 4.3.3.1.5.1.7.1 2.2 0 2.9-3.4 3.8-4.2zm57-48.9c.7 0 1.4-.1 1.8-.4-.5-.3-.9-.6-.8-1-.3-.1-.5-.2-.7-.2-.6 0-1.2.5-1.6 1.2.1.3.7.4 1.3.4zm-53.6 46.3c.8 0 1.3-.7 1.1-1.5-.5-.3-1-.5-1.4-.5-.8 0-1.4.5-1.2 1.2.5.5 1 .8 1.5.8zm157.2-79.8c.4 1.3.1 2.2 1.3 3.7-.4-1.2-.7-2.6-1.3-3.7zm172.3 28c.3 0 .6-.3.9-.5.3-.3.5-.5.9-.5h.2c-.8-1-1.4-1.3-2-1.3-.3 0-.6.1-.8.2-.3.1-.5.2-.8.2-.1 0-.2 0-.3 0 .8 1.4 1.4 1.9 1.9 1.9zm3.3-1.2c.4 0 .8-.2 1.2-.4s.8-.4 1.2-.4c-.9-1.3-1.6-1.7-2.1-1.7s-.8.4-1.1.7c-.3.4-.5.7-.7.7-.1 0-.3-.1-.4-.3.8 1.1 1.4 1.4 1.9 1.4zm-17.3 11.1-.4-.7h-1.6l.4.8zm-63-53.7c-.8-.6-2.4-1.2-3.8-1.2-1.3 0-2.4.5-2.6 1.8.9.9 1.7 1.2 2.4 1.2 1.7.1 3.1-1.6 4-1.8zm70.3 45.6c.8 0 1.5-.1 1.9-.2 1.2-.3 2.3-1.1 2.5-2.5-1-.9-1.9-1.2-2.8-1.2-2.1 0-3.8 1.8-4.1 2.9.5.8 1.6 1 2.5 1zm-354.4 85.7c.8 0 1.4-.5.9-1.6 0-.1.1-.2.1-.2.1 0 .3.2.5.3 0-.6-1-.5-.8-1.2-.3-.2-.5-.2-.7-.2-.9 0-.6 1.7-.6 2.8.3.1.5.1.6.1zm-31.8 274.5c-.5.6-1.1 1.1-1.7 1.1h-.1c.4.5.7.7 1 .7.5 0 1-.6 1.6-1.1.6-.6 1.2-1.1 2-1.1h.2c-.5-.5-.9-.7-1.3-.7-.6 0-1.2.6-1.7 1.1zm-1.3-4.4c.2.1.5.1.7.1 2 0 2.4-2.6 5-4-2 .2-3.8 1.9-5.7 3.9zm-1.9-5.6c-1.6 1.2-.7 2.4-2.6 3.6.1 0 .1.1.3.1 1.1 0 4.2-2.7 2.3-3.7zm13.6 3.5c.4.2.9.2 1.3.2 1.2 0 2.4-.6 2.9-1.9h-.1c-1.4 0-2.7 1.1-4.1 1.7zm11 3.4c2.8 0 5.8-4.5 7.3-6-3.1 1-4.6 3.8-8.3 5.8.4.2.7.2 1 .2zm18.8-282.2c-1.2-1-2.1-1.4-2.6-1.4-2.3 0 0 6.9-2.6 7.7 2.3-.4 5-3.1 5.2-6.3zm-53.9 212.4c-.3.4-.6.7-1 .7 0 0 0 0-.1 0 .3.3.5.4.7.4.3 0 .6-.4.9-.7.3-.4.7-.7 1.2-.7h.1c-.3-.3-.6-.4-.8-.4-.4 0-.7.3-1 .7zm67.2-226.7c1.6 0 1.4-3 1.5-4.4-.4-.2-.7-.2-1-.2-1.7 0-1.7 2.5-.7 4.6zm-5.5 6.2c.9-1.7 1.9-3.4 3.8-3.4h.1c-.6-.9-1.5-1.4-2.2-1.4-.9 0-1.6.8-1.1 2.3-.3-.1-.6-.1-.9-.1-2.7 0-4.3 2.6-5.9 4.9 1.1.7 2 1 2.7 1 1.7 0 2.5-1.7 3.5-3.3zm-14.5 270.8c-.2-.1-.4-.1-.5-.1-.6 0-1.2.4-1.7.8s-.9.8-1.2.8c0 0 0 0-.1 0 1.9-7 10.2-10.6 16.9-17.3-10.3 2.2-17.5 14.3-27.5 19.8.5.5.9.9 1.4 1.4 1.7-1.5 3.5-2.5 5.2-2.7 0 .2.1.5.1.7-3.2 1.7-6.4 3.7-8.7 5.2-.4.3-.9.4-1.4.4-.2 0-.3 0-.5 0s-.3 0-.5 0c-.7 0-1.3.1-1.4 1.1 1.5 1.8 3.1 1.3 4.7 2 4.1-3.9 16.7-8.9 19.5-14-.4-.3-.8-.5-1.3-.5-1.1.2-2.4 1.3-3 2.4zm189-366.4s.1-.2.2-.6c-.3-.6-.7-1-.8-1s-.1.1-.1.4c.8.1.6 1.2.7 1.2zm153.2 259c-.2 0-.3 0-.5.1-.4.2-.8.5-1.2.7-.6.4-1.1.9-1.7.9-.1 0-.1 0-.2 0 .5.4 1.2.7 2 .7 1 0 2.1-.5 2.7-1.7-.2-.3-.4-.5-.6-.6s-.4-.1-.5-.1zm-6.3-19.7c.3 0 .6-.5.2-1l-.7.4c.1.4.3.6.5.6zm24.7 12.3c-1.4 0-2.9 1.7-3.7 2.2.3.1.5.1.7.1 1.5 0 2.6-1.3 4.6-1.4-.5-.6-1-.9-1.6-.9zm6.3 8.3h.5.2c-.2-.3-.5-.6-.8-.8s-.6-.3-.8-.3-.5.1-.7.3c-.1.1-.2.2-.3.4.4.4.9.4 1.3.4zm-35.4-18.6c.2 0 .4-.1.5-.1-.5-.4-.9-.7-1.4-.7-.1 0-.2 0-.3 0 .5.6.8.8 1.2.8zm-78.9-82.5v.1zm105.6 104.7c1.8-.1 3.4-.3 4.7-.5h.2c.3 0 .6.3.9.5.3.3.6.5.8.5s.3-.2.4-.6c-.7-2.2-1.7-2.6-2.5-3.9-1.3.8-3.9.7-6.5 1-2.5.3-4.9.7-5.9 2.3.4.9.9 1.2 1.4 1.2s.9-.3 1.2-.8c.3.4.5.5.8.5.2 0 .5-.1.6-.2.2-.1.4-.2.5-.2s.1 0 .2.1c-1.7 5.2-6.8 4.5-11.2 7.2 1 .5 2 .6 2.9.6 4.9 0 9.3-5.1 14.5-5.3-.2-.6-.4-1.2-.7-1.8-.6.3-1.1.4-1.7.4-.5 0-1.1-.1-1.6-.5 0-.2 0-.4 0-.7.5.3.7.2 1 .2zm-397 47.2c-.8 0-1.6.7-2.4 1.1.2.1.5.1.7.1.7 0 1.5-.4 1.7-1.2zm88.5 59 .1.3.2-.1zm209.4-213.9-.1.1v.1h.1zm-211.2 213.9.3.2-.1-.3zm-31.2-153.5-1.1.7.9 1.1.8-1.1zm125 16-.3-.5c-.5.2-1.1.5-1.6.7l.3.5c.5-.3 1.1-.5 1.6-.7zm.1 2.8c.9-.4 1.8-.7 2.8-1.1l-.4-.6c-.9.3-1.9.7-2.8 1.1zm-64.1 120 .1.7v.1h.1zm-18.1-77.1c-.5 3.2-1.1 6.3-1.7 9.4h.5c7.3 0 12.7-8.5 14.1-16-4.1 3-7.9 5.6-11.7 8.2zm249.4-142h-.1zm66.2 122.9c-.2-.9-.5-1.2-.8-1.2-.2 0-.4.2-.7.3-.2.2-.5.3-.8.3-.2 0-.4-.1-.6-.3.2.6.4 1 .6 1.2.1.1.3.2.4.2.2 0 .3-.1.5-.2.1 0 .2-.1.2-.2.2-.2.5-.3.7-.3s.4 0 .5.2zm-4.4 5.4c.3.2.7.3 1 .3.8 0 1.7-.5 2.6-1.2-.4-.4-.6-.6-.9-.6-.8 0-1.3 1.5-2.7 1.5zm5.9 2.9c-.1-.2-.3-.3-.6-.3-.8 0-2 .9-1.2 2.3 1-.4.7-1.8 1.8-2zm44.1-156.8c-1.9-2 0-2.5-.8-4-5.7 2.8-10.3 7.5-15.2 8.6 3.8-4.2 14.1-10.3 18.3-14.4-1.1-.4-2.1-.6-3.2-.6-1.2 0-2.5.2-3.7.6 1.6-2.9 2.2-5.8 1-8.2-2.5 3.2-4.5 9.6-8.9 9.6-.3 0-.6 0-1-.1-1.1-2.4.1-4.9 1.1-7.3l.2-.1-.1-.2c.2-.4.4-.8.5-1.2l.4.1-.3-.4c.3-.7.4-1.3.5-1.9l.5.2c-.2-.1-.4-.2-.5-.2.2-1 0-1.9-.6-2.7-.8-.4-1.5-.6-2.3-.6-2 0-4 1.1-6.1 2.3-.3.1-.6.2-.9.4h.1c-.4.2-.7.4-1.1.6h-.1c-.7 0-1.4.4-2 1.1-1.1.5-2.2.8-3.3.8-.9 0-1.9-.2-2.8-.8-2.5 1.6-4.9 3.2-7.3 4.7-.2-.5-.5-1-.8-1.6-1.6.5-3 .9-4.3 1.3-.4-1.6-.8-3.1-1.3-4.7 1.5-.6 3-1.3 4.5-1.8s4.6.4 3.9-2.4c-1.7-1.1-2.9-1.3-4-1.3-.6 0-1.1.1-1.7.2-.5.1-1.1.2-1.6.2s-.9-.1-1.4-.2c2.2-2.1 9.2.9 9.1-4-1.5.1-2.6.4-3.8.4-.5 0-.9 0-1.4-.2-1-.3-2-.4-2.8-.4-.5 0-1 .1-1.4.2l-1.2-2.1c.4-.1.8-.2 1.2-.3.6.7 1.1 1 1.6 1 1 0 1.5-1.4 1.6-2.7-1.2-1.3-2.6-2.2-3.6-2.2-.7 0-1.1.6-.8 2-1.2 0-2.4 0-3.8 0 .8-.6 1.2-1 1.7-1.5-.9-.6-1.6-.8-2.1-.8-1.1 0-1.6.8-2.7.9.1-.4.2-.8.4-1-.1-.2-.2-.4-.3-.5.2-.2.5-.5.8-.7-2.3-.4-4.3-.8-6.2-1.1l-.1-.3c-.9-1.3-2.1-2.2-2.8-2.2-.5 0-.7.5-.3 1.8l-.3-.1c-1.5-.4-2.9-.6-4.2-.7.1-.3.2-.7.4-1 .2-.2.4-.4.6-.6l.2.1-.1-.2c.8-.7 1.9-1.4 2.5-2.1 1-1 1.5-1.9 2-3-.2-.6-.4-1-.5-1.3 2.1-1.7 4.2-3.3 6.3-4.8 3.1-2.2 6-3.9 9-5.9s6-4.4 9.3-7.5c3.8-3.5 12.7-10.9 8.6-11.9.2-.5.3-.9.5-1.3-.4-.1-.8-.1-1.1-.2.6-.6 1.3-1.4 2.3-2.4 2-2.2 4.8-4.9 7.6-7.6 5.6-5.4 11.2-10.8 11.2-10.8-24 13.6-43.2 24.6-51.5 28.3-4.1 1.3-8.7 2.3-13.1 3.6-1.6.4-3.1.9-4.6 1.4-.1-.1-.2-.1-.3-.1s-.2.1-.3.3c-2.6.8-5 1.8-7.2 2.8-6.4 3.1-12.3 6.9-18.3 10.6.5-.6 1.1-1.2 1.6-1.8-.5-.1-1.1-.2-1.5-.2-2.5 0-3.9 1.8-4.9 4.3-.1 0-.2 0-.3 0-3.5 0-6.1 3.6-9.8 3.7.4-.6.8-1 1.5-1 .3 0 .7.1 1.1.3-1-1.8-1.7-2.3-2.3-2.3s-1.1.6-1.7.8c-.6-.5-1-2.7-2.2-3.9 1.5-.1 3.1-.1 5.1-.2-2.3-1.7-4-2.6-5.2-2.6 1.8-2.3 3.3-4.8 3.6-7.6l.1-.1c1.9-.8 3.8-1.5 5.6-2.4 2.9-1.3 5.7-2.6 8.6-3.9l.1.2.5-.5c.5-.2 1-.5 1.6-.7 2.8-1.9 4.8-6 7.9-8.1l.5-.3c-.4-.8-.7-1.2-1-1.3-1.8.5-4.1.2-6 2.4-.6.8-.4 3-1.3 3.5-.3.2-.7.3-1 .5-2.4-3.2-5.2-6-6.7-10.8-2.1-1.3-4-2-5.8-2.4 0-.8-.1-1.7-.2-2.7-1.2-2.6-2-4.4-2.7-5.9.9.3 1.7.4 2.5.5-.9-.9-1.7-1.2-2.5-1.2-.1 0-.2 0-.3 0-.7-1.4-1.2-2.6-2-4 .1-.4.3-.5.6-.5.2 0 .4.1.6.1.2.1.4.1.6.1.3 0 .5-.1.5-.6-1.4-1.2-2.8-2-4-2.4-.5-.9-1-1.9-1.7-3.1-.4-.5-.8-1-1.2-1.5 1.5.4 3 1 4.6 1.8-2.5-3.7-3.8-2.8-5.9-5.1-.3-2.1.7-1.2 1.6-1.8-1-1.1-1.4 0-2.6-2.3-1.6-2.7.4-1.3-1.2-4-4.4-2.6-8.6-3.6-12.3-3.6-1.9 0-3.6.2-5.1.6-.4 0-.8 0-1.1 0-.7 0-1.4 0-2.1.1-.5-3.1 2.6-1.4 2.9-3.3-.7-.9-1.8-1.4-2.6-1.4-1 0-1.6.7-1.1 2.5-1-.7-1.8-1-2.5-1-2.8 0-4.4 4.1-7.2 5.3 0 0 0 0-.1 0-2.6 1.1-5.8 1.4-8.4 2.8-.6.3-1.2.7-1.7 1.2-3.6.4-7.4.8-10.3 2.5-4.8 2.7-8.6 7.1-12.2 10.9-2.9 1-5.9 2-8.9 3.2-4 5.7-10.4 8.6-17.1 11.1-2.2.8-4.4 1.7-6.5 2.5-1-1.9-.2-1.9-.8-3.4-2.6.8-4.5 3.2-6.8 3.2-.2 0-.4 0-.6-.1 1.5-2.6 6.5-5 8.3-7.4-1.4-1.4-2.7-1.9-3.9-1.9.5-2.1.4-4.5-.6-7-.9 1.9-1.2 6.1-3 6.1-.4 0-.8-.2-1.3-.6-1-2.4-.7-4.3-.4-6.2h.1l-.1-.2c0-.3.1-.6.1-.9l.3.2-.2-.4c.1-.5.1-1 0-1.5l.3.3c-.1-.2-.2-.3-.3-.3-.1-.8-.3-1.7-.7-2.5-.9-1.1-1.8-1.5-2.6-1.5-.7 0-1.4.3-2 .6l-.5.1.1.1c-.2.1-.4.2-.6.2-.1-.1-.3-.1-.4-.1-.3 0-.5.2-.7.5-.2 0-.4.1-.6.1-.9 0-1.9-.4-2.9-1.8-3.3 2-6.4 3.8-9.6 5.3-2.9 1.5-5.7 2.7-8.5 4.1-.9.2-1.7.6-2.5 1.2-.5.3-1 .5-1.5.8l-.3-.3c0 .2-.1.4-.2.6-.5.3-1 .5-1.5.8-.9-.1-2-.6-2.9-1.1l.7 1.5c-.6-.6-1.1-.8-1.5-.8-1.1 0-1.2 2-2 2.8 0 .2.1.4.2.6-.3.2-.7.4-1 .6-1.1-.9-1.6-.8-3-1.6-.7.4-1.6 1.7-1.8 3.1-.8-.3-1.6-.4-2.2-.4-.4 0-.8 0-1.1.1l-.1-.1c-.1 0-.1 0-.2 0-1 0-1.9.7-2.8 1.3-1 .5-2.1.9-3.4.9-.1 0-.3 0-.4 0l.2.4-.4-.1c-.4-4.2 6.3-3.7 6.1-7.3-.6-.9-1.2-1.3-1.6-1.3-1 0-1.7 1.3-2.6 1.5-.4 0-.8-.1-1.2-.1-3.1 0-5.8 1.3-8.2 2.9-2.7 1.9-5.2 4.3-8.2 5.9-4.1 2.2-8.6 4.1-12.9 6.5-.5.3-1.1.6-1.6.9-15.5 9-31.2 17.5-48.3 27.1-.6 1 .9 2.8-.1 3.7-2.9 3.1-9.4 1.9-12.7 5-2.7 2.6-4.2 8.3-7.7 9.3.6.5 1.1.6 1.6.6 1.6 0 2.7-2.2 3-3.4 5.5-1.5 10.3-4.4 14.7-7.7 4.3-3.4 8.4-7 12.5-9.8.3.1.7.1 1 .1 1.5 0 2.8-1 4-1.9 1.2-1 2.5-1.9 4-1.9.6 0 1.3.2 2 .5.3.5.2.8.6 1.3.1 1-.3 1.2-1 1.2-.3 0-.6-.1-1-.1-.4-.1-.7-.1-1-.1-.4 0-.7.1-1 .3-.4.7 1.4 2.4 1 3.1-3 .9-3.9 4.5-7.2 5.4-1.7-2.4 1.1-1.1.4-2.9-2.5.8-9 .8-4.6 7.1-.4-1.1.2-2.3-1.2-2.8 1.5-.3 2.9-.6 4.3-1 1.6 2.9-2.3 1.6-3.1 2.4.4 1.2 0 2.2.7 3.6-2.4 2.4-5.2 4.5-8.1 6.7-2.1 1.4-4.3 2.7-6.4 4-3.4 2.1-6.7 4.2-9.9 6.7-2.7 2.9-5.7 5.4-8.6 8s-5.8 5.3-8 8.9c.8 3.8.6 3.8-1.7 4.2.4.3.6.4.8.8-.5-.6-.9-.7-1.1-.7s-.3.1-.4.2-.3.2-.4.2c-.2 0-.6-.2-1.1-.6-1.8 2.4-4.3 3.6-6.5 5.8h.1c.6 0 2.1 1.4 1.6 1.6l-1.6-.9.4.6c-.5 0-1.7-.7-2-1.7-3.5 1.8-5.8 4.9-7.9 8.2 0 .1-.1.1-.1.2-2 3.2-3.8 6.6-6.7 8.8-.5 2-3.1 3-4.9 3.9-1.6 6.5-3.2 12-9.3 14.1 0 0 5 4 8 4h.4c.2.1.3.1.5.1-.1.2-.1.5-.1.8-.2.1-.4.2-.6.3-.1-.2-.3-.3-.5-.4-.2.2-.2.5-.2.8-1.1.5-2.3 1-3.5 1.5-2.3 6-4.9 5.5-7.5 10.9 0 0-.4.1-1 .3s-1.4.6-2.3 1.1c-1.7 1-3.6 2.6-4.1 4.8.7 1.1-2.8 2.9-1.5 3.8 12-1.8 18-10.5 26.1-15.9l.4.3c-.1.1-.2.2-.3.4-3.1.2-3 5.3-6.6 5.3-.2 0-.4 0-.6 0 .5 4.3-3.9 3.4-4.8 6.6.9.4 1.7.6 2.6.9.6 0-.6-1 0-1 7.4-4.9 13.7-11 20.1-15.9.3-.2.1-1 .4-1.3h.1c.1 0 .2 0 .4.1.1 0 .3.1.4.1s.1 0 .1-.1c1.1-1.6 2.3-3.3 3.9-4.4 1.4-1 2.8-2.4 3.9-3.4.4-.3 1.3-.1 1.6-.5.1-.1-.4-.9-.3-1.1.2-.5 1.3-.7 1.8-1 1.6-1 3.2-2.1 4.9-3.3l-.2.3c.5.4.9.9 1.4 1.3 1.2-1.7 3.6-2.7 3.9-5 .2-.1.4-.3.6-.4.5-.3.6-.7 1.2-.9 1.1-.4 2.4-1.6 3.3-2.5 3-2.8 7.4-3.9 10.1-6.7h.5c1.6 0 2.5-1.2 4.1-1.5-.8.4-1.6.9-2 1.9-5.4 2.9-10.7 6.3-15.3 9.2-1.3.8-1.3 2.5-2.4 3.4-2 1.6-4.3 3.2-6.5 4.9-.2-.1-.5-.1-.7-.1-1.2 0-2.5.8-2.4 2.4-2.5 1.9-5 3.7-7 5.5.4 2.5-3.6 2.1-5 3.6-.9 1.1-1.8 2.1-2.9 3.1-.2.3 1.2 1.9.8 1.9-.1 0-.2 0-.3-.1-.6-.2-.1-.7-1-1.6 0 .8 0 .9.7 2 0 0 0 0-.1 0-.2 0-.4-.1-.6-.1-.2-.1-.4-.1-.6-.1-.1 0-.1 0-.2 0 .9 3.9-3.5 1.5-3.1 4.8-1.7.5-2.2 3.2-3.1 4.9-.5.9-2.2.3-1.1 2.8.8.6 1.6 1 2.1 1 .3 0 .5-.1.5-.5-.4-.4-.5-.5-.6-.5h-.1-.1c-.1 0-.2-.1-.5-.3-.2-.9-.1-1.3.3-1.3.2 0 .5.1.9.3.2-.3 0-.3-.7-1 .6.1 1.3.4 2 .7.3-1 .8-1.6 1.5-2.5.5-.6 1.8-.4 2.1-1 .2-.3-.2-1.2 0-1.5 1-2.2 4-2.2 5-4.5 1 1 .2.8 1.1 1.9.8 0 1.2-.8 1.8-.8-.4-.4-.7-.5-.9-.5s-.3.1-.5.1c-.2.1-.3.1-.5.1-.1 0-.3 0-.4-.1.2-1.8 1-3.2 2.5-3.2.3 0 .6.1.9.2.2-.1-.3-.8-.1-.9.4.2.7.3 1 .3.4 0 .7-.2.9-.4.3-.2.5-.4.9-.4.3 0 .6.1 1.1.4-.1-.8.3-1 .8-1 .3 0 .6.1 1 .1.3.1.7.1 1 .1.6 0 .9-.3.6-1.4h.1c.2 0 .4-.1.6-.2s.3-.2.6-.2.6.2 1.2.7c-1.8 1.9-3.9 3.9-7.1 4.9-.1.1.4 1.2.2 1.2-.1 0-.3-.2-.6-.6-.2.2.6 1.1.5 1.4-.2 0-.3 0-.5 0-2.1 0-3.9 1.5-4.2 3.8 2.4-.9 3.9-2.6 5.9-3.2.5-.1-.7-1.4-.4-1.6 1.3-.2 3.4 0 3.5-1.5 3.3-1.7 6.3-4.6 9.5-6.9.9-.6 1.3-1.9 2.3-2.3.3-.1.5-.3.7-.6-.1 6.3-7.4 4.8-7.6 11.3-.2-.8-.4-1-.6-1-.6 0-1.2 2-1.4 2.5 8.3-3.7 14.6-13.9 22.9-17.1-1.2-.9-2.1-1.2-2.9-1.2-1.8 0-2.6 2-2.8 3.6-.6-.8-.1-.8 0-1-.1 0-.2 0-.3 0-.9 0-1.5.6-2.1 1.3-.6.6-1.3 1.3-2.3 1.3-.5 0-1.1-.2-1.8-.6-.2-.3-.3-.5-.2-.6 1.5-.2 2.4-.6 3.1-1.5.4-.2.8-.4 1.1-.6l.4.1c1.1-.9 2.2-1.8 3.5-2.8 1.3-.9 2.6-1.8 4.1-2.7 2.8-1.8 5.9-3.5 8.9-4.9.5-.2.6-.9 1.1-.9.3 0 .6.2 1.2.7-.2-.4-.6-1.1-.5-1.3 1.2-.7 2.8-1.1 4.3-2.2 0-.1 0-.1.1-.1s.4.4.6.7c-.6.5-1.2.9-1.9 1.1.5.7 1.2 1.1 1.8 1.3-.9.7-1.8 1.4-2.7 2.1-.4-.3-.7-.4-1.1-.4-.8 0-1.4.6-1 1.6h.5c-1.7 1.3-3.5 2.7-5.2 4-.1 0-.3-.1-.4-.1l.1.1h-.1c-.3 0-.4.2-.3.6-.6.5-1.3 1-1.9 1.5-.1-.4-.7-1.2-.5-1.2.9-.4.6-.6-.1-.6-1.1 0-3.4.4-4 .6 1.3 1.3 2.2 1.6 2.9 1.6.5 0 .9-.1 1.4-.2-2.7 2.2-5.4 4.4-8.1 6.7-3.5 3-6.8 6.2-10 9.6-3.1 3.4-6.2 7-9.2 10.7-3 3.6-6.1 7.3-9.3 10.8-3.2 3.6-6.4 7.1-10 10.4-2.7 2.5-5.3 4.6-8 6.9-2.6 2.3-5.3 4.9-8.2 8.3-3.4 3.9-11.9 12.6-6.6 12.6.3 0 .7 0 1.1-.1.4.5-4.6 6.3-9.6 12.1-5.1 5.7-10.2 11.4-10.2 11.4 22.8-14.9 40.5-27.9 48.2-32.6 5.2-2.4 11.4-4.5 16.8-7.1h.2c.2 0 .2-.1.3-.3 1.7-.8 3.3-1.6 4.8-2.5l.1.2c7.9-3 13.1-6.7 16.5-12.9l.4-.3.5.7.2-.2c-.5 1.6-.8 3.2-.7 4.8-3.8 6.5-11.5 8.3-15.6 14.2.3.3.7.6 1.1.9-1.5 1.1-2.9 2.2-4.4 3.3-4.1 3.1-7.2 7.6-13.9 7.6-1.2 0-2.6-.2-4-.5-1 .9-2.4 2.6-4.4 3.5-7.1 3.2-13 7.8-18.7 12.5-6.3 5.3-12.6 10.6-19.5 15-2.5 1.6-4.5 3.8-6.6 5.9-3.4 3.5-7 6.8-13.3 6.8-.5 0-1.1 0-1.7-.1-.1 0-.2 0-.2 0-2.5 0-2.5 3.7-4 5.8 1.5 2.7 3.3 6 5.8 10.5 2.6-.3 4.8-.6 7-1 1.4 3.5 2.7 6.7 4 10-2.4.7-4.7 1.4-7.2 1.8-.2 0-.4 0-.6 0-.6 0-1.3-.1-2-.2s-1.4-.2-2.1-.2c-1.5 0-2.3.7-1.3 3.7 5.9 5.1 8.5 4.4 11.6 4.7 0 .4-.4 1-1.2 1.7-2.1-.4-4.3-1-6.1-1-2.4 0-3.9 1-3.1 5 3.5.6 5.8-.1 9.1 1.6 2.9 1.4 5.1 2.1 6.8 2.1 1.4 0 2.5-.5 3.3-1.4.2-.3.6-.3 1-.3.8 0 1.9.3 2.3.3.6 1.9 1.3 4.2 1.8 6-.7.2-1.4.2-2.2.2-.4 0-.8 0-1.2 0s-.8 0-1.2 0c-2.4 0-4.4.4-4.4 3.5 3.9.9 7.2 1.7 11.4 2.6-1.1 1-1.7 1.6-2.5 2.3 2.3 1.9 3.6 2.5 4.6 2.5.6 0 1.1-.2 1.6-.5.5-.2 1-.5 1.7-.5s1.7.3 3 1.1c-1.2 1.2-1.9 1.9-3.4 3.3 5.9 2.4 9 5.2 12 5.2.5 0 1.1-.1 1.6-.3 3.4-1.3 15-4.8 20.6-8.3-6.7 6.3-12.9 13.1-20.4 18.1-2.3 3.1-7.1 5.3-10.7 7.2-7.5 9.8-14.6 18.2-26 22.8 0 0 4 3.7 8.4 3.7.7 0 1.3-.1 2-.3.2 0 .4 0 .6.1-.4.5-.8 1.1-1.3 1.8.1.1.3.1.4.1.8 0 1.5-.9 2.2-1.8 7.5-.1 10.8-8.6 18.2-9.3.8-.3-2.2-2.7-.2-3.1h.1c6.8 0 12.6-5.6 16.9-12h.3c2.5 0 3.4-3 5.2-5.2-.1 0-.2 0-.4 0-.7 0-1.6.2-2.5.6l-.9-.4c.4-.7 1.4-.8 2.4-.8h.3.3c1 0 1.9 0 2.4-.7-.4-.5-1-.4-1.2-1.4.3.3.7.4 1 .4.5 0 .9-.2 1.4-.4s.9-.4 1.4-.4c.2 0 .4 0 .6.1.1-1-.9-2.2-.7-3.4l2.1 1.2c.9.4 1.6.6 2.2.6 3.1 0 3.5-4.8 7.3-4.8-.4-.3-1-.4-1-1 2.4-.3 4.6-1.2 6.8-2.3l.3 1.2c-3 1.3-5.7 2.4-7.8 5.1.5.3 1 .4 1.5.4 2.2 0 4.2-2.3 6.3-4h.4c.1.4.2.9.4 1.4h1.5c-.6.2-1.3.3-2 .4-.1.3-.2.5-.3.7-2 .3-2.9 2.4-5.4 4.3.7.2 1.3.3 1.8.3h.4c-1.7 1.8-3.8 3.2-5.9 4.6-.1 0-.2 0-.2 0-2.4 0-5.1 2.3-7 4.6-1.8 1.3-3.5 2.7-5 4.5l.4.1c-1.4.6-2.5 1.7-2.1 3.4 1.8-.3 3.9-1.5 4.9-3 .9 0 1.8 0 2.7.1 1.8-.5-.4-2 1.4-2.5 3.5-2.2 7-4.4 10.4-6.7l-.1.4c1.1.3 2 .4 2.9.6.4.4.8.8 1.3 1.3.2-.2.4-.3.5-.5 1.4.9 2.5 1.3 3.5 1.3.6 0 1.1-.2 1.6-.5.1-.1.3-.1.4-.1.5 0 1.1.3 1.4.3v2.8c-.1 0-.3 0-.4 0-.5 0-1-.1-1.5-.1-.5-.1-1-.1-1.5-.1-1 0-1.8.3-2.3 1.4 1.9.6 3.6 1.2 5.7 1.8-.8.4-1.2.6-1.8.9 1 1.1 1.7 1.4 2.3 1.4.3 0 .6-.1.8-.1.3-.1.6-.1.9-.1.5 0 1 .1 1.7.7-.9.5-1.4.8-2.5 1.4 3.4 1.6 6.1 2.8 8.9 4 2.3 1.1 4.4 1.7 6.3 1.7.7 0 1.3-.1 1.9-.2 2.7-.7 5.8-1.1 7.5-3.1.1 1.1.7 2.3.5 3.2-.3.3-.5.6-.8.9-.2.1-.5.2-.8.3l.4.2c-1.3 1.9-1.6 3.5 1.2 3.9.3.6-3.8 4.5-8 8.2-2.1 1.9-4.2 3.7-5.8 5.1s-2.7 2.3-2.7 2.3c18.7-6.9 33.2-14 39.4-16.3 4.2-.9 9.2-1.2 13.6-2.2.1.1.2.1.2.1.1 0 .1-.1.2-.2.4-.1.8-.2 1.2-.3 1.5-.4 2.9-.9 4.2-1.5 3.7-1.8 7.2-4 10.7-6.3.3-.1.5-.2.7-.5.8-.5 1.5-1 2.3-1.6l.1.2c0 .7-1 1.4.8 3.2-.6.2-1 .7-1.4 1.2-.6-1.1-1.2-2.1-2-2.4.1.5.1 1-.2 1.3.5.5.9 1.2 1.3 1.8l-.3.1h-.1c-.2 0-.6-.2-1-.3-.3-.2-.7-.3-.8-.3s-.2 2.1 0 2.1c-1-.1-2.4-2-3-2-.2 0-.3.1-.4.4.4 1.9 2.2.6 2.6 2.9-.2 1.5-1 2.6-1.5 3.9 1.8 2 .7 2.1 1.7 3.6 3-1.6 4.8-5 7.8-5.2-1.4 3.1-6.5 6.8-8.2 9.7.8.5 1.6.8 2.3.9-.7 1.1-1.4 2.1-2.4 2.8l-.4.2c.4.8.7 1.2.9 1.3 1.3-.2 3 .1 4.2-1.3.2 1.3.7 2.5 1.6 3.7.7-2.2.4-6.9 2.8-6.9.3 0 .7.1 1.2.3 1.4 2.2 1.4 4.2 1.3 6.1h-.1l.1.1v1l-.3-.1.3.4c0 .5.1 1 .2 1.5v.4c.2.1.3.2.4.3.2.8.5 1.6 1.2 2.4.9.7 1.7.9 2.4.9 1 0 1.9-.5 2.7-1.1.2 0 .3-.1.5-.2l-.1-.1c.2-.1.4-.2.5-.4h.3c.3 0 .6-.2.8-.6.4-.2.8-.3 1.3-.3.8 0 1.7.3 2.7 1.2 3.1-2.8 6.2-5.1 9.4-7.2 2.9-2 5.7-3.8 8.6-5.6.9-.4 1.7-.9 2.4-1.5.5-.3 1-.7 1.6-1l.4.3c0-.2.1-.4.1-.6.5-.3 1-.6 1.5-1h.1c.9 0 2 .4 3 .7l-.9-1.4c.6.4 1.1.6 1.5.6 1.2 0 1.3-2.1 2.1-3.1-.1-.2-.1-.4-.2-.6.3-.3.7-.5 1-.8 1.2.8 1.7.7 3.2 1.3.8-.5 1.6-1.9 1.9-3.3.7.2 1.4.3 2 .3s1.1-.1 1.6-.2l.1.1c1.1 0 2.1-.8 3.1-1.6 1.2-.6 2.4-1.2 3.9-1.2l-.2-.4.4.1c.4 4.3-6.6 4.2-6.3 7.8.7.9 1.2 1.2 1.7 1.2 1 0 1.7-1.4 2.7-1.6h.5c3.6 0 6.4-1.5 9.1-3.4 2.8-2 5.5-4.4 8.7-6.1 2.1-1.1 4.4-2.2 6.7-3.2s4.7-2 7-3.2c14.9-7.6 30.4-13.8 47.1-19.3 2.7-.9 5.4-1.7 8.2-2.6.8-.9-.3-3 1-3.6 1.4-.9 3.1-1.1 4.9-1.1h2 2c1.8 0 3.6-.2 5-1 3.3-2 6.6-6.8 10.4-6.9-.6-.8-1.2-1.1-1.9-1.1-1.5 0-2.9 1.5-3.4 2.5-.2 0-.4 0-.6 0-10.2 0-19.2 5.5-27.5 9.6-1.2.6-2.4 1.2-3.6 1.7-.6-.3-1.1-.4-1.7-.4-1.4 0-2.6.7-3.9 1.3-1.3.7-2.6 1.3-3.9 1.3-.8 0-1.6-.2-2.5-.8-.2-.5-.1-.8-.4-1.4.1-.9.4-1.1 1-1.1.4 0 .8.1 1.3.3.5.1.9.3 1.3.3.3 0 .5-.1.7-.2.6-.7-.9-2.6-.4-3.2 3.3-.5 5-3.8 8.7-4.2 1.2 2.7-1.4.9-1 2.8 1.2-.2 2.9 0 4.4-.4 2.1-.4 3.7-1.8 2-6 .2 1.2-.7 2.3.5 3-.8 0-1.7.1-2.5.1-.7 0-1.4.1-2.1.1-.5-1.6.2-1.9 1.1-1.9.3 0 .6 0 1 .1h.1c.3 0 .6.1.9.1s.6 0 .7-.2c-.1-1.3.5-2.2.2-3.7 3.1-1.9 6.5-3.3 10.1-4.8 2.6-.9 5.2-1.7 7.8-2.5 4.1-1.2 8.2-2.3 12.2-3.9 3.7-2.2 7.6-3.6 11.5-5.1s7.7-3.4 11.4-5.9c.6-2.8.8-3.6 1.9-3.6.4 0 .9.1 1.6.2-.3-.5-.4-.5-.5-1.1.4.9.7 1.1 1 1.1.1 0 .2 0 .3-.1.1 0 .2-.1.3-.1.3 0 .6.2 1 1 2.8-1.6 5.8-2 8.9-3-.6-.1-1.5-2.1-.9-2.2l1.1 1.4-.1-.8c.5.2 1.4 1.4 1.2 2.3 8.5-.4 14.6-8.1 22.6-9.6 1.2-1.2 3.2-1.4 5-1.4h.8.7.1c4.5-4.4 8.7-8.1 14.4-8.1.7 0 1.4.1 2.2.2 0 0-2.5-6.6-5.5-7.6l-.3-.3c.3-.3.6-.6.9-1-.2-.3-.3-.4-.5-.4-.3 0-.7.3-1.1.7-1-.8-1.9-1-2.7-1-1 0-2 .4-3 .8s-1.9.8-3 .8c-.8 0-1.6-.2-2.4-.8-.2 0 0 .7.2 1.4s.3 1.4-.1 1.4c-.1 0-.1 0-.2-.1-1.3-1-2.6-1.5-3.8-1.5-2.5 0-4.9 1.8-6.8 4.2-.3-.3-.7-.5-.9-.5-1 0-1.7 1.6-2.6 2.4.4.4 1 .7 1.7.8l.5.8c-.1.1-.2.2-.3.2-.3 0-.8-.4-1.3-.8s-1-.8-1.3-.8c-.1 0-.2 0-.3.1.2.6.5.8.6 1.7-.8-1.8-1.8-.4-2.6-1.7-.1.8.4 2.3.2 3.2l-1.1-2c-.8-1.4-1.5-1.8-2-1.8s-.9.4-1.3.8-.9.8-1.4.8c-.3 0-.6-.1-1-.4.2.5.5.8.5 1.3-1.4-.8-2.8-1-4.2-1-2.2 0-4.2.6-6.4.7.8-.8 1.7-1.5 2.7-1.8.6-.2 1.1-.2 1.7-.2.7 0 1.4.1 2.1.2s1.3.2 2 .2c1 0 1.9-.2 2.8-1.1-.6-1-1.3-1.4-1.9-1.4-.9 0-1.9.7-2.8 1-1.5-1.3-3-1.8-4.6-1.8-1 0-2 .2-3 .5 1.4-.7 2.8-1.3 4.4-1.3 1 0 2.1.2 3.2.8.1-.2.2-.3.2-.5.2.1.4.2.6.2.9 0 1.5-1 2.8-1.5-.5-.6-.9-1-1.3-1.3 1.1-.8 2.4-1.1 3.8-1.3.5.5 1.1.6 1.7.6 1 0 2-.5 2.9-1.2 1.1-.3 2.2-.7 3.2-1.6l-.2-.2h.3c.7 0 1.3-.5 1.2-1.9-.4-.2-.9-.4-1.4-.4-.6 0-1.3.2-1.6.8-.5-.4-1-.8-1.6-1.3-.1 0-.2 0-.2 0-.3 0-.3.4-.3.8s0 .8-.3.8c-.1 0-.1 0-.2 0-3.7.5-7.4 1.2-11 2-.1-.2-.2-.3-.3-.5-.1-.1-.2-.1-.3-.1-.2 0 0 .3.1.7-2 .4-3.9.9-5.9 1.4-.2-.1-.4-.2-.5-.2h-.1c0-.2.1-.4 0-.7-.3-.1-.7-.2-1-.3-.1-.7.2-.9.6-.9.3 0 .8.1 1.2.2s.8.2 1.1.2c.4 0 .6-.2.5-.9.7.3 1.4.5 2.1.5 1.8 0 3.6-.9 5.4-2.3-.2-.6-.5-1.2-.7-1.8-2.2 1.2-5.4 1.1-6.8 3.5-.1-.4-.4-1-.8-1.8-6.1.2-10.2 1.9-12.7 6.3-.2 0-.3 0-.5 0s-.4 0-.6 0c.5-1.4.8-2.9.6-4.6 2.4-3.8 7.1-3.9 10.4-6.2.6-.4 1.1-.9 1.6-1.5-2.7-3.7-5.9-6.5-8.3-11.4 1.9-.8 4-1.7 6.1-3 .1-.1.1-.1.2-.1.2 0 .4.3.6.6s.4.6.6.6h.1c.7-.1-.3-1.3.1-1.6 4.2-2.6 7.8-3.5 11.7-5.8.3 0 .8 1.3 1.1 1.3.3-.7-.7-1.2-.5-1.8.6.2 1.7.7 2.4.7.6 0 1-.4.6-1.8.2.1.4.1.5.1.5 0 .8-.4 1.1-.7.3-.4.6-.7 1.1-.7.3 0 .6.1 1.1.4.5-.2-.2-1.1.5-1.2.1-.1.1-.1.2-.1.2 0 .4.2.6.4s.4.4.6.4h.1c.6-.7 2.2-.1 1.4-1.8 7.5-1.5 15.4-9.6 22.6-14.3.1-.1.2-.1.3-.1.2 0 .4.1.6.2s.4.2.6.2c.1 0 .2 0 .3-.2 2.9-3.9 6.8-7.3 10.6-11.2 1.9-1.9 3.7-4 5.3-6.2.8-1.1 1.6-2.2 2.3-3.4s1.3-2.5 1.8-3.8c-.7-.5 2.4-3.8 1.7-4.3-.5-.6-.9-.7-1.2-.7-.1 0-.3 0-.4.1-.1 0-.2.1-.3.1-.2 0-.4-.1-.6-.7-.4-.2-.7-.2-1.1-.2-.8 0-1.7.4-2.6.9-.2-.1-.4-.1-.6-.1s-.3 0-.4.1c1.4-1.3 2.9-2.6 4.5-3.7 3-2.2 4.1-6.3 9.2-6.3 1.2 0 1.1-1.7 1.7-2.7-.7-1.1-1.6-2.5-2.9-4.4-1.1.2-2.1.5-3 .7-.7-1.5-1.4-2.8-2.1-4.2 1-.4 2-.8 3.1-1.1h.5.7.7c.8 0 1.3-.3.7-1.7-2-1.5-3.2-1.6-4.1-1.6-.2 0-.3 0-.5 0s-.3 0-.5 0c-.6 0-1.1-.1-1.9-.4.3-.4.8-.5 1.4-.5.5 0 1 .1 1.6.1.5.1 1.1.1 1.6.1 1.3 0 2.1-.4 1.6-2.3-.3 0-.5 0-.7 0s-.5 0-.7 0-.4 0-.6 0c-.6 0-1.3-.1-2-.4-1.2-.5-2.1-.7-2.8-.7s-1.3.2-1.6.8c-.1.2-.3.2-.6.2-.2 0-.3 0-.5 0s-.3 0-.4 0c-.3-.8-.7-1.8-1-2.5 1.5-.5 4 .3 3.9-1.9-1.7-.2-3.2-.5-5.1-.7.5-.5.7-.7 1-1.1-1-.7-1.6-.9-2-.9-.3 0-.6.1-.8.3-.2.1-.5.3-.8.3-.1 0-.2 0-.3 0 7.5-4.8 14.6-10 18.9-16.7-4.5 2.8-11.4 10.5-18.7 14.6l-.1.1c-.4-.1-.7-.2-1-.3-.2-.3-.4-.6-.6-.6-.1 0-.2 0-.2.1l-.3.2-.4-.1c3.3-1.7 7.3-1.7 9.1-4.7-.5-.7-1-.7-1.5-.7-.1 0-.2 0-.3 0s-.2 0-.3 0-.2 0-.4 0c1.3-.8 2.3-1.6 2.8-2.5l.3.1c-.1-.2-.1-.3-.1-.5l.1-.4-.3-.3c-.1-.7-.2-1.3-.2-2 1-.4 2-.8 2.6-.9h.1c.5 0 .8.8.4 1 6.9-1.4 13.5-10.9 20.6-15.7-.7-.5-1.4-.7-2-.7-2.4 0-4.1 2.9-6.3 4.5-2.5-1.3 2.4-2.4-.4-4.9 1.1-.4 2-1.1 2.8-1.8.4 1.2.9 2.2 2 2.4.2-.6.3-1.2 1-1.7-.4-.4-.8-.9-1-1.5-.1-.1-.1-.3-.2-.4.2-.1.4-.2.6-.2.1 0 .3-.1.4-.1.4 0 .8.1 1.2.2s.7.2 1 .2h.2c.1 0 1.3-2.6 1-2.6h.2c.7 0 1.3.4 1.9.9.6.4 1.1.9 1.6.9.3 0 .6-.2.9-.7.4-2.3-3.1-.1-2.7-2.9.3-2 2.1-3.6 3.7-5.4zm-406.2 19.4h.3c-.2.2-.3.5-.5.7-.3-.2-.5-.4-.7-.7zm-19.1 19.1c.7-.9 1.5-1.7 2.8-1.8-.9.6-1.8 1.2-2.8 1.8zm2.6-4.2c.6.1 1.1.2 1.6.2.8 0 1.5-.2 2.2-.5-.9.7-1.8 1.5-2.8 2.1-.6-.7-1.8-1.8-1-1.8zm5.9 5.1c-.2-.1-.5-.1-.9-.3-.3.8-.9 1.4-1.5 1.9l-.2.2c.4-.8.8-1.5 1.2-2.3.4-.4.9-.6 1.5-.6h.5l.3.6c-.3.2-.6.3-.9.5zm-.4-6.9c.9-1.2 1.5-2.9 1.8-4.8.2.1.4.1.6.1 1.2 0 .9-1.9 1.4-3.1-.3-.1-.6-.2-.9-.2s-.5 0-.8.1l-.8-.5c0-.2.2-.3.5-.3s.7.1 1.1.2.8.2 1.1.2c.2 0 .4-.1.5-.3-.4-.5-.8-.5-1.3-1.3.5.4.8.5 1.1.5.2 0 .4-.1.6-.1.2-.1.3-.1.5-.1s.4.1.7.2c-.3-.8-1.4-1.9-1.7-2.8l1.8 1.3c1 .7 1.7.9 2.1.9.7 0 .9-.6 1.1-1.2s.5-1.2 1.3-1.2h.2c-3.4 4.8-6.9 8.9-10.9 12.4zm15.7-9.6c-1.1 0-1.1 1.3-2 2.3.7.4 1.2.6 1.6.7l-.3.4c-.8.6-1.7 1.3-2.5 1.9-.2 0-.3-.1-.5-.1-1.3 0-2.1 1.1-2.6 2.3-.5.4-1 1-1.3 1.6-1 1.1-1.9 2.3-2.6 3.6-.4.8-1.6 1.1-2.3 1.5l-.2.2c-.8-4.6 3.4-6 5.5-9.8h-.2c2.2-1.8 4.6-3.4 7.2-4.7l.4-.1v.2c-.1.1-.1 0-.2 0zm2.4-8.2c-.3-.4-.7-.8-.9-1.1.4.4.8.7 1.2.9zm10.2-7.8c-.1 0-.2 0-.4 0-.4 0-.8.2-.9.8-.3.2-.5.3-.8.5h-.1c-.2-.2-.5-.6-.7-1.1 1.6-.2 2.9-.7 4.1-1.5l.1.3c-.3.3-.8.7-1.3 1zm4-2.6c-.8.5-1.6 1-2.3 1.5l-.2-.2c1.1-.6 2-1.4 2.9-2.2-.1.3-.3.6-.4.9zm2.8-5.6c-.1-.2-.2-.3-.3-.5h.2c.2 0 .4-.1.6-.1.2-.1.4-.1.7-.1s.6.1 1 .3c-.7.2-1.6.2-2.2.4zm2.7-.7c-.1.2-.4.3-.6.3-.2-.2-.6-1.2-.5-1.4 0-.2 0-.3.2-.3.3 0 .8.4 1.3.7-.1.3-.2.5-.4.7zm.6-1.2c-.5-.3-.9-.8-1.3-1.3.6.4 1.1.5 1.5.6-.1.1-.1.4-.2.7zm2-4c0-.4 0-.6.2-.6.1 0 .2.1.3.2-.2.1-.4.2-.5.4zm-23.4 42c.1-.2.3-.3.5-.4-.2.2-.3.3-.5.4zm31.1-46.8-.4-.5.4.5c-.2.2-.4.3-.5.5-.6-.8-1.1-1.6-.4-1.8.5.6.9.9 1.2 1zm2.3-4h-.1l-.4-1.1c.2-.1.5-.3.8-.4-.1.6-.2 1.1-.3 1.5zm-92 192.9c-.2 0-.5-.4-.8-.7 0-.2-.1-.5.1-.5.2 0 .5.4.8.6-.1.2 0 .6-.1.6zm.5-3.1.6.1.1.6zm11.7 35.9-.7-1h2.5l.7 1zm55.9 29.2c-.7-.2-1.4-.4-2-.5.3-.2.7-.4 1-.6.6.3 1.1.4 1.7.5-.3.2-.5.4-.7.6zm155.7-304.7.2.2c-.1-.2-.1-.3-.2-.5v-.2l-.2-.3c-.2-.6-.4-1.3-.5-1.8.4-.1.7-.1 1-.1h.3c.3 0 .7.9.5 1 .2 0 .4.1.5.1 1.6 0 2.9-1.3 4.1-2.9 1.4-1.8 2.8-3.9 4.4-5-.8-1-1.3-1.3-1.8-1.3-1 0-1.5 1.6-2.4 2.2-1.3-1.4-.1-1.5-.2-2.7.5-.1 1.1-.1 1.6-.2.1.2.3.4.5.5 0-.2 0-.4 0-.6 1.3-.3 2.5-.6 3.6-1 .1 0 .1.1.2.1s.2-.1.3-.2c.3-.1.6-.2.8-.3 3.4-1.3 6.2-3.4 8.4-6.8.4.1.9.2 1.3.2 1 0 1.9-.3 2.7-.7-.8.8-1.5 1.6-2.4 2.4-2.8 2.4-6.4 3.3-8.2 6-2.4 3.7-5.3 7.6-9 10.9l.1-.4c-.6.4-1.3 1.1-2.1 1.9-.5.4-1 .8-1.6 1.2-.7.3-1.3.6-2 .9-.5-.7-.8-.6-1.2-.9.7-.6 1.2-1 1.3-1.7zm-2.4 160.4c0 .3 0 .6.3.9-.4 1.3-1.4 1.8-2.7 2-.2-.3-.3-.6-.4-.9.9-.6 1.8-1.3 2.8-2zm-3.7 2.6.2.5c-.4 0-.7.1-1.1.1.4-.2.7-.4.9-.6zm-5.7 5.7c.1 0 .3 0 .5.1-.3.1-.6.3-.9.4 0-.4.1-.5.4-.5zm-1.7-.6c.3.5.5.9.8 1.4-.3.2-.5.3-.8.5-.2-.3-.4-.5-.5-.8.1-.2.1-.4.2-.6-.4.2-.8.5-1.3.7h-.3c.6-.4 1.3-.8 1.9-1.2zm-2.6 1.8c-1.8 1.1-3.4 2.3-5 3.7-.2.2-.1.9-.1 1.3 1-.9 2.1-1.4 3.3-1.9-2.5 1.8-5.1 3.7-8.4 4.9-1-2 1-2 2-2.8 2.7-1.8 5.5-3.5 8.2-5.3zm-6.5-2c2-.3 4-1.3 6.1-2.5-2.2 2.1-3.3 5.8-6.9 5.8-.4 0-.9 0-1.4-.2 0 0 0 0-.1 0-.6 0-.4 2.2-.7 3.5h.1c-1.3.4-2.7.9-4.2 1.4 2.5-2.6 4.8-5.4 7.1-8zm-6 11.1c.6 2.1-1.7 2.7-3.9 3.2-.3-.5-.6-1.1-.8-1.6 1.5-.5 3.1-1.1 4.7-1.6zm-5.8 1.9-.3.3c.2.5.4 1 .6 1.4-.3.1-.6.2-.9.3-.2-.2-.4-.5-.7-.8l.9-.9-.1-.2zm-2.1-4.9c.7.7 1.3 1.5 1.9 2.4-.4.3-.8.6-1.1.9-.5-.8-1-1.7-1.7-2.7zm-2.4 7.3c.9.6 1.8 1.3 2.7 2-.3.8-.7 1.6-.5 2.4-3.1 2.1-6.4 4.2-9.8 6.3-.4-.7-.8-1.4-1.3-2.1-.4-.2-.6-.3-.9-.3-.5 0-.7.4-1 .7-.2.4-.4.7-.9.7-.3 0-.7-.2-1.4-.7.7 1.5 1.2 2.7 1.6 3.9-.8.5-1.5.9-2.3 1.4-1.1.7-2.2 1.3-3.2 2-1 .6-2 1.1-3 1.6-1.6-2.4-1.5-.4-2.9-2.5 6.8-7.5 14.8-9.8 22.9-15.4zm-19.7 52.1c-.9.5-1.9 1-2.7 1.5.1-.7.4-1.4 1.2-2 .4-.2.7-.5 1.1-.7.3.5.4.9.4 1.2zm-11.7-10.4c.5-.3 1.1-.5 1.6-.8-.5.8-1 1.5-1.5 2.1h-.2zm-4.9-15.5c.2.1.5.2.7.4-.9.5-1.7 1-2.6 1.5-.1-.2-.1-.5-.2-.7zm-2.5 21.8c.4.7.9.9 1.4 1-.2.2-.5.3-.7.5l-.3-.5.3.5c-.4.3-.8.5-1.2.8-.5-.9-.8-1.8.5-2.3zm-.2 15.9-.2.1v-.2h.1zm-6.3 4.6c.5-.4.9-.8 1.4-1.2l.2.2c-.6.5-1.1 1-1.5 1.5h-.1c-.2 0-.4.1-.5.1s-.1 0-.2 0c.2-.2.5-.4.7-.6zm-1.8-215c-.2.2-.5.4-.7.6l-.2-.1c.3-.1.6-.3.9-.5zm-9.6 5.8c.6.8 1.2 1.3 1.6 1.3.1 0 .3-.1.3-.2-.2-.6-.6-1.2-.9-1.7.6-.4 1.2-.8 1.8-1.2.3-.2.7-.4 1-.6.3.6.7 1.3 1.2 2-.1 0-.3 0-.4 0-1.2 0-2.1.6-1.2 3.1-.1 0-.1 0-.2 0-.6 0-1.1.2-1.5.4-.5-.1-1-.1-1.5-.1-1.5 0-3 .3-4.5.9v-.1l-.1-.2c1.4-1.4 2.9-2.5 4.4-3.6zm-7.4 207.3c.2-.4.4-.6.7-.6.5 0 1 .3 1.6.5-.3.4-.7.8-1.1 1.1s-.8.5-1.2.7c-.2-.2-.2-1.4 0-1.7zm-.1 1.8c-1.2.6-2.7.9-4 1.5 0-.2-.1-.4-.2-.6.8 0 2.2-1 3.4-1 .4 0 .6 0 .8.1zm1.8-4.1c.5.2 1 .3 1.4.3.3 0 .5 0 .8-.1-.3.4-.6.8-.9 1.2-.6-.3-1-.7-1.3-1.4zm2.3 15.4c1.4-1 2.8-1.9 4.2-2.8.3-.2.6-.5.8-.9.2.5.3 1.1.3 1.5-2.6.5-4.9 2.5-7.2 4.4.6-.7 1.2-1.4 1.9-2.2zm5.2-20.4c.3-.7.5-.9.8-.9.1 0 .3.1.4.1-.4.2-.8.5-1.2.8zm-12.6-193.4c.5 0 .7-.3.5-1l-.1-.1c.3.1.6.3.9.6-.5.2-.9.5-1.4.7zm5.7 1.8c-.5.5-1 1-1.6 1.5-1.7 1.3-3.7 2.2-6.1 2.3 2.5-1.4 5.1-2.6 7.7-3.8zm-8.5 4.2c.4.6.7 1.2.7 1.6-2.1.3-4.2.7-6.1 1.5 1.8-1.1 3.6-2.1 5.4-3.1zm-7.5 4.2c-.3.3-.6.5-.9.8-.2.3-.3.9-.6 1.1-.2.1-.4.1-.6.1-.4 0-.8-.1-1.1-.1zm-4.2 29.5c-.5.4-1 .8-1.5 1.2h-.2c-.4-.4-.8-.8-1-.8.3.4.5.7.7.8-.2.1-.5.2-.7.4 0-.3-.1-.5-.2-.8-.9 0-1.7.5-2.4 1-.1-.3-.2-.5-.1-.5 1.6-1.2 3.1-1.5 4.7-2.1-.1.2-.2.3-.3.5.3.1.6.2 1 .3zm-5.7-23.3c1.2-.8 2.5-1.6 3.7-2.3-1.2 1-2.3 1.9-3.7 2.3zm-20.1 109.8c.5-.3.9-.5 1.4-.8.4.5.7.9 1.1 1.5 1.4.4 2.8.6 4 .7.3.3.5.5.8.7-.1-.2-.1-.4-.2-.7h.8 1c.2.8.5 1.7.9 2.6.3.3.5.6.8.9-.3.7-.1 1.7.7 4.2l.1.2c-2.1.9-4.1 1.9-6.1 3-1.2.5-2.1.8-2.9 1.1-1.3-3-2.6-6.1-3.8-9 .8-.1 1.7-.1 2.4-.2-.4-1.5-.7-2.9-1-4.2zm9.7 60.2-.4.3.3-.4zm-5.5 7.2c-.6.4-1.1.8-1.7 1.2.5-.5.9-1 1.4-1.5zm-1.9-53.4-.3.2.3-.4zm-20.9 12.5 1.7 2.1c-1.1 1.3-2.3 2.6-3.4 3.8l-1.7-2c1.1-1.3 2.3-2.6 3.4-3.9zm9.1 69.1c-.9 0-2-.5-1.9-1.6-4.8 2.7-9 6-13 9.7 2.2-4.6 8.2-5.5 10.8-9.7.2-.4.6-.5 1-.5.5 0 1 .2 1.5.3.5.2 1 .3 1.4.3h.1c0 .3.1.5.2.8h-.1l.3.7s-.1 0-.3 0zm-1.6-75.8-1.5-.6c.8-.8 1.5-1.6 2.3-2.4 2.6-.6 6-1.1 5.8-6.8l2.4 5.5c-2.9 1.6-5.9 3-9 4.3zm6.9 55-1.3 2-1.2-1.5 2.4-.6zm-1.8 55.1c.2-.1.3-.2.5-.4l.2.1c-.2.2-.5.3-.7.3zm4-6.9-.2-.2.2-.2.1.1zm-2.7-10.4c1.7-1 3.3-2.1 5-3-.5.7-1.1 1.3-1.7 2-1 .5-2.1.9-3.3 1zm3.7 25.9-.2-.5 1.4.1.2.5zm1.7-29.4c-.7-.5-1.5-1.4-1.7-2.2.7.7 1.5 1 2.3 1h.3c-.3.3-.6.8-.9 1.2zm5.8 27.2-.2-.6.3.4zm7-36.7c.1-.2.3-.3.5-.3.1 0 .2 0 .3.1l.1.2c-.3-.1-.6-.1-.9 0zm-4.1-17.4c.5.3.7.3.8.8-.4-.5-.8-.6-1.1-.6-.4 0-.8.2-1.1.5-.4.2-.7.5-1.2.5-.3 0-.7-.1-1.1-.5-3.5 3.2-7.2 5.6-11 8.2 0-.9 0-1.7 0-2.6-1.4.3-2.8.7-3.6 1.7 0-3.4 1.2-5.6 4.2-5.6 1.3 0 3 .4 5 1.4-2.2-9.1 6.3-5 7.7-9.4 1.5 1.9 2.3 2.8 3.1 3.9 1.9-2.6 4.7-4.1 2.2-11.3-2.4.7-4.9.9-6.9 1.6-.4.2-.9.3-1.3.5 3.5-3.4 7-8 11.4-9-.3-.8-1.1-1.2-1.9-1.2-1.7 0-4 1.5-4.3 3.9-2 .2-3.9 1-5.9 2.3l4.9-5.3c-.2-.3-.3-.5-.5-.8.5-.2.9-.5 1.4-.7.5.4.9.7 1.3.7h.2c3-1.8 6.2-3.4 9.4-4.9-.1.5-.1 1-.1 1.4 1.5-.2 2.7-1.6 3.7-3.1 5.5-2.4 11.1-4.6 16.8-6.9l8.4-3.3c.8.9 1.6 1.7 2.4 2.5-12.5 9.4-25.7 17.3-37.1 28.5-1.3 5.2-1.6 5.3-5.8 6.8zm19.6 8.5c-.9.7-1.7 1.4-2.6 1.9-.4.3-.7.9-1 1.4-1.3-1.4 2-2.7.3-4.2 2.3-1.4 4.4-2.9 6.6-4.4-1.4 1.7-2.9 3.3-4.9 4.3.5.6 1.1.9 1.6 1zm-9.4 3.6c.3.4.4.8.5 1.2-.1 0-.2 0-.2 0-.1 0-.2 0-.4 0-.1 0-.3 0-.4 0-.6 0-1.2-.2-1.5-1.7 2.9-1 5.5-2.4 8.1-3.9 0 4.6-3.8.3-6.1 4.4zm5.5.4c-.1.3-.3.5-.5.6-.3.2-.6.3-.9.5.5-.4.9-.8 1.4-1.1zm-8.5 4.6c-.3 0-.6 0-.9 0 .3-.5.4-1.3 1.2-1.5l-.1-.4c1.8-.6 2.4-2 3.1-2 .1 0 .2 0 .3.1.1.4.2.9.5 1.3-1.6.7-3 1.3-4.1 2.5zm6.4 21.8s-.1 0-.2 0c-.3 0-1-.3-2.1-.5 3-2.1 5.6-4.5 8.3-6.6.7-.6 1.5-1.1 2.2-1.7.5.4 1.1.5 1.6.5.3 0 .6 0 .8-.1.4.3.7.4.9.4.5 0 .7-.5.9-1 .3-.1.6-.1.9-.2.1.5-.5.8.7 2-.6.2-.7 1-1.3 1.1-.1 0-.4-.1-.6-.2s-.4-.2-.5-.2l.2 1.2c-.6-.1-1.5-1.3-1.9-1.3-.1 0-.2.1-.2.3.3 1.1 1.2.5 1.6 1.6-1 .3-1.9.6-2.9.9-3 1.1-5.9 2.1-8.4 3.8zm13.7 5.7-1 1-.5-.7zm7.4 6.4c-.2-.3-.4-.6-.7-.9 1 0 2-1 2.9-2.2-.4-.4-.9-.6-1.3-.6-1.6 0-3.1 2.7-4.7 4.1.7.5 1.1.9 1.3 1.4-1.1.8-2.3 1.5-3.4 2.2.1-.4.2-.9.3-1.3-1.2.3-2.4.6-2.9 1.7h-.4c0-.2 0-.3-.1-.5-.4-.6-.6-.7-.7-.7s-.2.1-.3.3c-.1.1-.2.3-.3.3h-.1c.2.4.4.7.5.9-2.7.5-5.4 2.1-6.6 4.7h.8c.9 0 1.7-.1 2.6-.2-.7.6-1.4 1.2-2.1 1.9-.5.5-1.2 1.1-1.9 1.7 0-.2 0-.4-.2-.6-.4-.6-.7-.8-1-.8s-.5.1-.8.2-.5.2-.8.2c0 0 0 0-.1 0 1.9-2.1 3.8-4.1 5.8-6 .9-.9 1.6-1.7 1.8-3.3.3-2.4 1.4-4 3.6-4 .7 0 1.5.2 2.4.5 0-1.2.3-2 .8-2.4.6.1 1.1.1 1.6.1 1.5 0 2.9-.4 4.2-1l.2.3c.3-.3.7-.6 1-1 .7-.5 1.5-1 2.2-1.5.6.8.8 1.7 1 2.5-1.4 1.3-3 2.7-4.6 4zm8.2-7.6c-.6-.3-1.2-.7-1.5-1.3l-.3.1c.9-.8 1.7-1.5 2.6-2.1.6.4 1.1.6 1.7.7-.8.8-1.6 1.7-2.5 2.6zm2.2-9.7c-.7.4-1.3 1-1.9 1.6l-.3.2-.1-.1-.1.3c-2.6 2.2-5.2 4.3-7.8 6.3-.4.1-.9.2-1.3.4-1.9.7-3.8 1.3-5.7 1.9.8-.5 1.5-1.1 2.3-1.6 1.4-1.1 2.8-2.3 4.1-3.6h.2c.1 0 .2 0 .3-.1.4-.2.6-.7.8-1.2.7-.7 1.4-1.4 2.1-2.1.2-.2.4-.4.6-.6.5-.2 1-.4 1.4-.6 0 .2.1.4.1.6.3.5.5.7.6.7s.2-.1.2-.2c.1-.1.1-.2.2-.2h.1c-.3-.5-.5-.9-.7-1.2 2.3-1 4.9-1.8 7.2-3v.3c-.6.8-1.5 1.5-2.3 2.2zm3.1-32.5c-.3 0-.3.2-.5.5-.1.2-.2.5-.5.5-.1 0-.3-.1-.6-.2 0-.4.1-.9.1-1.3.6-.1 1.1-.1 1.6-.2.1.2.2.5.4.9-.2-.2-.4-.2-.5-.2zm1.4-.9c.2-.1.4-.1.5-.2.2.3.4.5.4.7-.2-.1-.6-.3-.9-.5zm25.2 3.5c-.2 0-.3 0-.4 0-1.7 0-2.6 1.3-4.3 1.6.9-.4 1.6-1 2-2 3.6-2 7.1-4.2 10.5-6.1-.8 1.1-1.6 2.1-2.6 3-1.9 1-3.8 2-5.2 3.5zm15.4-.8c-1.5.4-3 .9-4.2 1.6l.1.1c-1.1.1-2.2.4-2.7 1.3-2.2.9-4.3 2-6.5 3.2 0-.3-.1-.6-.1-.8.6-.3 1.2-.7 1.7-1.1 2.4-1.4 4.8-2.7 7-4.1.8-.5 1.5-1 2.2-1.5.3 0 .5.1.8.2.3-.4.5-.8.7-1.2.6-.4 1.2-.9 1.9-1.3.4-.1.8-.2 1.2-.3-.9 1-1.4 2.7-2.1 3.9zm-1.9-8.9c1.1-.8 1.3-2.3 2.4-3 3.1-2.2 6.7-4.2 10.2-6-.5.7-1 1.3-1.7 2-1.7 1.3-3.3 2.7-4.8 4.2-2 1.2-4 2.3-6.1 2.8zm10.3 4.3c-.5.2-1.1.3-1.7.3-.4 0-.7 0-1.1 0s-.7 0-1.1 0-.9 0-1.2.1c0-.3 0-.5.1-.8h.1c.3 0 .7.4 1 .5 3.2-2.9 7.6-4.9 11.3-7.6-.1.2-.2.4-.3.7h-.1c-.2 0-.2.2-.2.5-.1.3-.3.5-.4.8.2-.1.5-.1.7-.2.6.8 1 1.2 1.4 1.4-2.7 1.7-5.5 3.1-8.5 4.3zm8.7-4.6c-.3-.6-.6-1-.8-1.4 1.4-.4 2.7-.7 4-1-1 .9-2.1 1.7-3.2 2.4zm10.3-9.6c-1.3.6-2.5 1.3-3.7 1.9.8-.5 1.5-1.1 2.3-1.7l.4.2c.5-.8 1.3-1.3 2.1-1.7-.4.5-.8.9-1.1 1.3zm15.4-9.5c.2-.2.3-.5.5-.8l.3.4c-.3.2-.5.3-.8.4zm2.1-24.9c-.7.3-1.3.7-2 1.1 0-.1-.1-.3-.1-.4-.2 0-.5-.1-.7-.1-.1 0-.2 0-.3 0l.2.9.2.1-.4.3c-.3 0-.5 0-.8 0-.2 0-.4 0-.5 0-.2.2-.4.3-.6.5-.7-.3-1.3-.4-1.8-.4-.6 0-1.2.1-1.7.2-1.4 1.8-2.6 3.4-3.8 5-.3.3-.5.7-.8 1 .2.1.3.3.5.4-.6.4-1.2.8-1.8 1.3l-.2-.3c-.2 0-.1.3-.1.5-.6.4-1.2.8-1.8 1.2-.2-.1-.4-.2-.5-.2-.2 0-.4.2-.3.7-.7.4-1.4.8-2.1 1.2.4-1.1.8-2.2 1.3-3.2-4.4 2.2-8.7 4.4-12.5 7.3-.3.1-.6.1-.9.2l.2.4c-.5.4-1 .8-1.5 1.2-.2-.3-.4-.5-.6-.5v1c-.8.7-1.6 1.5-2.4 2.3-.6-.9-1.2-1.4-1.5-1.4-.1 0-.1 0-.2.1.4.6.7 1.2 1 1.8-.5.3-1.1.6-1.6.9h-.2v.1c-1.1.6-2.2 1.3-3.3 2-.2-.4-.3-.7-.5-1.1-.4-.1-.8-.2-1.1-.2-1.2 0-1.6.9-1.5 2.4-.2.1-.3.2-.5.3.2.3.5.6.7.9-.2.2-.5.3-.8.4-.4.1-.6.4-.9.6-.3-.6-.6-1.2-1.1-2.3-.4 1.1-.8 1.9-1.1 2.7l.5.5c-.6.3-1.2.5-1.8.8-.1 0-.2 0-.3 0-.5 0-.9.2-1.1.6-2.2.8-4.4 1.5-6.7 2 1 .3 2 0 3 .7l-.1.3c-.5.3-1 .7-1.5 1-.8-.2-1.7-1.3-2.9-1.3-.5 0-1.1.2-1.7.8-.1 1 .4 1.2.9 1.2h.5.5c.3 0 .7.1.9.3v.2c-3.3 2.1-6.9 4.2-10.5 6.1-.2-.4-.4-.9-.7-1.5-.3-.2-.7-.2-1-.2-.5 0-.9.2-1.2.5.4.7.8 1.4 1.2 2.1l-.2.1c-.3.2-.5.5-.7.7.2-.4.4-.8.5-1.2-.6.4-1.2.7-1.9 1.1l-.3-.3.2.4c-1.1.7-2.3 1.3-3.4 2v1.1c-.2.2-.5.3-.7.5 0 .1 0 .1-.1.1s-.4-.3-.6-.6-.5-.6-.6-.6c-.4 0 .6 1.2.4 1.4-1.4 1.1-2.8 1.7-4.2 2.3-.8.3-1.5.7-2.3 1.2-.1 0-.3-.3-.5-.6.3-.2.5-.5.7-.8l.1.2.4-.3-.2-.3.1-.2c.6-.4 1.1-.8 1.6-1.3 0 0 .1-.1.1-.1.3.1.5.1.7.1.1 0 .2 0 .3-.1.9-.7 1.8-1.5 2.7-2.3.2.3.5.7 1.1 1.8.1 0 .1-.2.1-.4s0-.4.1-.4.2 0 .4.2c-.9-1.3-1.1-1.3-1.4-1.5 1.8-1.6 3.7-3.3 5.5-5-.8-.5-1.4-.9-2.1-1.3 1-.7 2-1.4 3.1-2.1.3.1.5.2.8.3-.1-.2-.2-.4-.3-.6 1.6-.7 3-1.6 4.3-2.9.7-.5 1.4-1 2.2-1.4.7.2 1.5.3 2.2.3.3 0 .7 0 1-.1l.2.2c2-.2 4.1-1.2 5.4-2.5l.2-.2.3-.4v-.1c.4-.5.6-1 .8-1.5s.4-1 .7-1.4c.1-.1.2-.1.3-.1.3 0 .4.4.7.8.2.4.5.8.9.8.2 0 .5-.1.8-.4 2.1-1.1.6-2.4 1-3.6.5-.2 1.1-.3 1.6-.5-.2.9-.7 1.6-1.1 2.5 3.3-1.3 5.8-3.3 7.8-6.2l4.2-3c.7-.5 1.4-1 2.2-1.5 0 .7.1 1.3.1 2.2 1.5-1 3.1-2 4.6-2.9-.1-.3-.2-.8-.3-1.4l-.4-.1c2-.9 4-1.5 6.2-1.5 1.7-1.3 2.8-2.6 3.7-4 0-.1.1-.1.1-.2h.1c0 .1-.1.1-.1.2-.1.2-.1.4-.2.6.3-.2.7-.4 1-.6.1 0 .1-.1.2-.1s.1.1.2.1c.7.3 1.5.9 2.2 1.1.5-.4 1-.8 1.6-1.1 6.7-4.8 13.7-9.1 21-13.1-1 1.2-2 2.4-3 3.4-.6.3-1.3 1-1.7 2.1zm13.7 19.5-.3.4c-2 .2-3.9.6-5.8 1.2.5-.5 1-1.1 1.3-2 1.7-.8 3.4-1.3 5-1.3h.6c1.1-1.4 2.3-2.3 3.4-3-1.5 1.4-2.9 2.9-4.2 4.7zm6.7-30.3c-3.5 1.3-7.4 2.7-8.3 3.7-2.8.3-5.5 1.4-5.5 4.8-.7.1-1.4.3-2 .5 1.7-2.6 4-4.4 5.5-7.2 4.2-2.3 8.5-4.5 12.8-6.8h.1c-1.5.9-2.9 1.9-4.4 2.8.6 1.3 1.4.8 1.8 2.2zm40.4-76.5c-5.8 3.3-11.5 6.5-17.3 9.6l-.2-.2v.3c-1.9 1-3.8 2.1-5.7 3.1.1-.2.3-.5.5-.8-3.5 1.4-7.1 2.7-10.6 4.1-.2.8-.4 1.7-.6 2.5-3.1 1.7-6.2 3.3-9.3 5l.2-.2c.4-.4.8-.8 1.3-1.2.3-.3.5-.7.8-1.1.2.2.4.3.7.3.6 0 1.2-.6 1.3-1.1-.1-.1-.2-.1-.4-.1-.5 0-1 .5-1.5.6.3-.6.5-1.3.8-2 1.4-.7 2.8-1.5 4.2-2.2 3.9-2 7.8-4.3 11.3-7 5.1-1.7 10.1-3.5 14.8-6.1.2-.1.4-.1.6-.3v-.1c2.5-1.4 5-3 7.3-4.9h.8c1.5 0 1.9-.2 1.8-1.9.6-.1 1.1-.3 1.5-.6-.3 0-.5-.2-.7-.4.3-.1.6-.2.8-.3.2 1.1.5 2.2.8 3.3-1.2.6-2.2 1.1-3.2 1.7zm18.2-32c.2-.1.4-.2.5-.3.5-.3.9-.7 1.3-1.1 1.9-.6 3.9-1.3 5.9-2-.1.3-.1.8-.3 1-2.5.9-5 1.8-7.4 2.7-.3.1-.7.3-1 .4.3-.3.7-.5 1-.7zm-9.7 27.4c-.8.4-1.6.8-2.4 1.2.1-.4.1-.7.1-1.2-.4-.6-.7-1-1-1.5l.2-.1c.2 0 .4 0 .6.1.2-.1.4-.2.7-.3.3.7.6.9.8.9.3 0 .5-.4.8-.4v-.4c.3.2.6.3.8.3l-.7.2c-.1.4 0 .8.1 1.2zm2.1-1.1-.4-.6-.8.3c.2-.2.4-.7.3-1.5l.1-.1c.3 0 .9.8 1.4 1.6-.2 0-.4.2-.6.3zm-1.7-69.1c.8-.6 1.6-1.1 2.5-1.7l.5-.2c-.6.9-1.8 1.4-3 1.9zm5.5 67.1c.1-.3.1-.5.1-.9l-1.9.9c-.1-.3-.1-.6-.2-.9.8-.3 1.6-.6 2.4-.9l-.1.7.8-.7-.2-.2.3-.1c.2.4.4.8.7 1.2-.7.2-1.3.6-1.9.9zm3.8-2c-.3.2-.6.3-.9.5-.2-.4-.4-.7-.6-1.1.5-.2 1-.4 1.5-.6.9-.3 1.9-.7 2.9-1l.3.5c-1.1.6-2.1 1.1-3.2 1.7zm3.6-1.9-.3-.4c1-.4 2-.7 3.1-1.1-.9.5-1.9 1-2.8 1.5zm8-17.3c-3 1.1-6.1 2.3-9.1 3.4.2-.2.4-.4.6-.6l-.1-.1h.1c2.8-.8 5.5-1.4 7.7-3.4.7-.2 1.4-.5 2.1-.8h.8c-.8.3-1.5.8-2.1 1.5zm3.1-2 .4-.1zm4.1 166.2.1-.1zm15.2-240.9c.5-.7 1.1-1.3 1.7-2 0 .3-.1.5-.1.8h1.1c-.5.3-1 .6-1.4.8v-.4zm-.5.6c.2-.2.3-.4.5-.5l.2.2c-.3 0-.5.2-.7.3zm6.6 52.2c-1.6 1.5-3.2 2.8-5.1 3.5 1.7-1.2 3.4-2.3 5.1-3.5zm-3.2 179.1.1.1zm3-2c.2-.1.3-.2.5-.4 0 .2 0 .3.1.5-.1 0-.3 0-.6-.1zm2.3-150c-1.1.5-2.3 1-3.6 1.4.1-.2.1-.4-.2-.8l-.6.4c.1.3.2.5.4.5-.2.1-.5.1-.7.2l.1.5c-.2 0-.4 0-.6 0h-.1c.2-.9.7-1.7 1.4-2.4.3-.2.6-.3 1-.5.3 0 .7 1.3 1 1.4.3-.6-.7-1.2-.5-1.8.6.3 1.6.9 2.3.9zm.6-1.2c0-.2-.1-.4-.2-.7.2.1.3.1.5.2-.1.2-.2.4-.3.5zm21.7 140c.4.7.8 1.9.9 2.7-.4-1.1-1-1.7-1.5-2 .2-.3.4-.5.6-.7zm-9.8 2.7c-.1 0-.1 0-.2 0l.1.4c-.1 0-.2 0-.3 0h-.1c.2-.5.5-.8 1-.8-.2.2-.3.4-.5.4zm1.7 0c-.1 0-.2-.1-.3-.2l-.1-.1v-.1c.2.1.4.2.6.3-.1.1-.2.1-.2.1zm-2.6-4.4c.7.3 1.4.5 2.1.5h.3c-.7.3-1.4.6-2.1.7-.3-.4-.5-.8-.3-1.2zm-.7 7.1c.2-.2.4-.5.5-.9.1.3.2.8.3 1.4-.4-.1-.8-.1-1.2-.2zm.8-181.9.3-.2.2.2c-.2.1-.5.3-.7.4zm-8.9 7c.6-.3 1.3-.7 1.9-1-.2.4-.2.9-.5 1.1-.6.4-1.4.4-2.2.6zm1.5 28.3-.2-.5h-.1c0-.3-.1-.5.2-.6v.5h.8l.1.1c-.3.2-.5.3-.8.5zm8.4-3.1c-1.5.2-2.8.6-4.1 1.1l-.1-.1c-.6.1-1.1.3-1.7.6 0-.1-.1-.3-.2-.5 2.1-.3 4.1-1.1 6.2-2.3 0 .5 0 .9-.1 1.2zm9.6-39c-.2.1-.5.1-.7.2.5-.3 1-.7 1.5-1l.2.1c-.3.2-.7.5-1 .7zm14.9 94.6.1-.1c-.9.2-2.4 1.4-3.6 2.3-.4.3-.8.6-1.2.9.4-.6.8-1.2 1.1-1.9.7-.6 1.5-1.1 2.2-1.7 1.9-1.2 3.9-2.5 5.9-3.8-1.4 1.3-2.8 2.8-4.5 4.3zm5.8 14c-.4.4-.5 1.2-1 1.6-.3.2-.6.4-1 .5.4-.5.9-1 1.2-1.6.4-.3.8-.6 1.1-.9v.2h.1zm.1-101.2c.1-.2.2-.4.2-.6.2 0 .3 0 .5.1-.3.1-.5.3-.7.5zm4.6 97.2c.5-.4.9-.7 1.4-1.1v.3c-.5.2-1 .5-1.4.8zm4-2.5c-.6.3-1.1.7-1.7 1v-.1l-.4.1c.7-.6 1.5-1.2 2.2-1.8-.1.2-.1.5-.1.8zm2.4-1.4-.2.1-.1-.9.5.5zm3.9-112 .1-.3.3.6zm4.9 106.2-.8-.9c.5-.6.9-1.2 1.4-1.8l.8.8c-.5.7-1 1.3-1.4 1.9zm1.5-109.8-.3-.4 1.5-.3.3.4zm3.7 16.3v-.3l.4.3zm1.4-1.1-.4-.2.1-.3.4.2zm.1-11.3c-.5.5-1.6.3-2 .4-.1-.9-.3-2-.5-2.8.8-.3 1.8-.4 2.7-.6l-.6.4c.5 1 .9 1.6 1.3 1.9-.3.2-.6.4-.9.7zm17.9 86.2.4.3v.2l-.4-.2zm-.1 1.4h-.3l-.1-.3zm-6.2-15.3.4.4-1.1.1-.3-.4zm-.5 33.8c-.1.2-.3.4-.4.7-.3.2-.6.3-.9.5.4-.5.9-.9 1.3-1.2zm-4-30.3-.4-.2v-.3zm-323.7 128.6.1-.3v-.2h-.3c.1.2.1.3.2.5zm-66-87.1c-.4-.4-.6-.6-.8-.6s-.4.2-.5.4-.3.4-.5.4c0 0 0 0-.1 0 .7.9 1.2 1.3 1.5 1.3.5 0 .6-1 .4-1.5zm18.6-26.4c.2 0 .3-.2.4-.3.1-.2.2-.3.3-.3h.1c-.9-1.2-1.4-1.6-1.6-1.6-.4 0-.1 1.1.1 1.7.3.4.5.5.7.5zm-2.3 7.1c4.9 0 9.3-9.5 11.7-13.3-5.4 2.3-9.3 8.8-12.1 13.3zm-3.6-8.2s-.1 0-.1.1c.3.5.8 1.1 1.2 1.3.3 0-.2-.6-.1-.7-.4-.3-.8-.7-1-.7zm293.4-115 .3-.2v-.2h-.3zm-301.8 120.9c.6.8.9 1.1 1.2 1.2 1.9-.1 1-2.9 2.4-4-.9-.5-1.5-.7-1.9-.7-1.6 0-1.2 2.4-1.7 3.5zm4.7-5c-.3-.2-.6-.3-.8-.3-.6 0-.7.6-.9.9.5.5.9.7 1.1.7.5 0 .5-1 .6-1.3zm322.6-122.7.5 1.8-.4-1.7-.6-2zm3.5-1.9c.3 0 .4-.8-.2-1.9l.1-1.3-1.7-1.7v3l1.2 1.1h-.1c.3.6.5.8.7.8zm-305.1 117.1c-.6-.7-1.1-1-1.4-1-.7 0-1 1-.8 1.7.3.3.6.4.8.4.5.1.7-1.1 1.4-1.1zm-12-.1c-1.2-1.8-1.8-2.3-2.3-2.3s-.7.6-1.2.8c.9 1.3 1.4 1.6 1.8 1.6.2 0 .4-.1.5-.2.2-.1.3-.2.5-.2.3.1.5.2.7.3zm-4.2 5.6c.5.3 1.2.6 1.7.6.3 0 .5-.2.2-.8-.3-.3-.6-.5-.7-.5-.2 0-.2.3.2.8-.4-.4-.9-.6-1.2-.6-.3-.1-.4.1-.2.5zm-2.8 4.8c-.3-.3-.5-.4-.6-.4-.2 0-.2.2 0 .5.2.2.3.2.4.2s.2-.1.2-.3zm-26.7.1c-.1 0-.3 0-.5-.1-.2 0-.3-.1-.4-.1-.2 0-.2.1-.1.4 1.1 1 1.7.9 2.5 1.4.7-1.5 4.8-2.6 4.7-4.7-.3-.3-.6-.4-.9-.4-.4 0-.6.4-.5.9-1.8.3-3.6 1.6-4.6 2.5 0 .1-.1.1-.2.1zm228.5 7.1.2.3.6-.5-.3-.4zm-229.3-4.3c.3.2.6.3.9.3.4 0 .6-.2.5-.7-.1 0-.2 0-.3 0-.5-.1-.8.2-1.1.4zm-2.1 2.6c.1-.2.2-.4.4-.4h.2c-.4-.3-.7-.5-.8-.5-.2 0-.3.2-.3.4-.1.2-.1.4-.3.4h-.1c.3.3.6.4.7.4 0 .1.1-.1.2-.3zm14.1 6.1c.2-.3.4-.5.9-.5.1 0 .3 0 .4.1-1.2-1.2-2-1.6-2.5-1.6-.6 0-.9.6-1.2 1.2.9 1 1.4 1.3 1.7 1.3s.5-.3.7-.5zm6.9-14.4c-.1 0-.1.1.1.4.6.4 1.2 1 1.6 1-.5-.4-1.5-1.4-1.7-1.4zm323.4-126.9c.4 0 .9.1 1.3.2.5.1.9.2 1.3.2.9 0 1.3-.6.3-3.1-8.9.7-14.9 3.4-19.2 10.2.9.9 1.6 1.2 2.2 1.2.8 0 1.4-.6 2-1.1.6-.6 1.2-1.1 1.9-1.1.2 0 .4 0 .6.1 1.6 2.7-.1 1.6 1.8 4.6.2.1.3.1.4.1.7 0 .1-1.6-.4-3.3-.5-1.6-1-3.3.1-3.3 1.1 2.7 2.3 3.6 1.4 3.8.3.1.6.2.9.2 1.2 0 2.4-.9.3-4.5 1.2 1.4 2.1 1.9 2.8 1.9 1.6 0 2.3-2.5 3.9-2.7-.6-1-1.2-1.3-1.6-1.3-.6 0-.9.5-.9.8-.5-2.4 0-2.9.9-2.9zm-215.7 252.2c-.1 0-.2 0-.2.1.5.4.9.8 1.2.8h.1c-.5-.6-.8-.9-1.1-.9zm13.7-9.6c-.4 0 0 1.5.2 3 .2.1.3.2.4.2.5 0 .4-1 1-1.5-.9-1.3-1.4-1.7-1.6-1.7zm4.1-3.1.1-.1.1-.3-.2.2zm0 1.1v-1.2l-.6.7zm.2-1.5 1-1-.6-.7zm115.6 68.9c-.5 0-1 .1-1.3.2.4.4.9.7.7 1.1.3.2.6.3.8.3.6 0 1.1-.4 1.6-1.1 0-.3-.9-.5-1.8-.5zm-8.8 3.7c-2.1.3-4.1 1.9-6.3 1.9-.6 0-1.1-.1-1.7-.3l-1.7 2c-4.5 3.3-12.9 4.3-17.2 6.7-.5.3-2.7 1.5-1.3 2.6.6 1 .9 1.4 1.2 1.4.4 0 .3-1.5.8-1.8 3.2-.2 7-.8 10.5-2.2 3.4-1.4 6.6-3.4 8.5-6.4.9.1 1.7.2 2.5.2 2.2 0 4.2-.6 6.1-2.5-.6-1.1-.9-.9-1.4-1.6zm-99.3 37.7c-.4 0-.6-.3-.7-.5-.1-.3-.1-.5-.2-.5 0 0-.1.2-.2.6.4.5.8.8 1 .8s.2-.1.1-.4zm-.7-3.8c.7 1.1 1.2 2.4 1.9 3.4-.5-1.3-.3-2.3-1.9-3.4zm104.5-35c-.4-.3-.9-.4-1.3-.4-.8 0-1.5.5-2.2 1.4.6.9 1.1 1.2 1.6 1.2s.9-.3 1.3-.7c.4-.3.9-.7 1.3-.7h.1c-.4-.3-1-.1-.8-.8z"/></svg>
            <?php endif; ?>
                <?php if ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) : ?>
                    <div <?php echo $this->get_render_attribute_string( 'graphic_element' ); ?>>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings , 'graphic_image' ); ?>
                    </div>
                <?php elseif ( 'icon' === $settings['graphic_element'] && ! empty( $settings['icon'] ) ) : ?>
                    <div <?php echo $this->get_render_attribute_string( 'graphic_element' ); ?>>
                        <div class="elementor-icon">
                            <i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $settings['title'] ) ) : ?>
                    <<?php echo $title_tag . ' ' . $this->get_render_attribute_string( 'title' ); ?>>
                    <?php echo $settings['title']; ?>
                    </<?php echo $title_tag; ?>>
                <?php endif; ?>

                <?php if ( ! empty( $settings['description'] ) ) : ?>
                    <div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
                        <?php echo $settings['description']; ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $settings['button'] ) ) : ?>
                <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item <?php echo $animation_class; ?>">
                    <<?php echo $button_tag . ' ' . $this->get_render_attribute_string( 'button' ); ?>>
                    <?php echo $settings['button']; ?>
                    </<?php echo $button_tag; ?>>
                    </div>
                <?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $settings['ribbon_title'] ) ) :
			$this->add_render_attribute( 'ribbon-wrapper', 'class', 'elementor-ribbon' );

			if ( ! empty( $settings['ribbon_horizontal_position'] ) ) {
				$this->add_render_attribute( 'ribbon-wrapper', 'class', 'elementor-ribbon-' . $settings['ribbon_horizontal_position'] );
			} ?>
			<div <?php echo $this->get_render_attribute_string( 'ribbon-wrapper' ); ?>>
				<div class="elementor-ribbon-inner"><?php echo $settings['ribbon_title']; ?></div>
			</div>
		<?php endif; ?>
		</<?php echo $wrapper_tag; ?>>
		<?php
	}
}
$widgets_manager->register_widget_type(new OSF_Elementor_CallToAction());