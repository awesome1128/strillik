<?php

use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class OSF_Elementor_Video_Popup extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-video-popup';
    }

    public function get_title() {
        return __('Opal Video', 'strollik5-core');
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_script_depends() {
        return ['magnific-popup'];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    protected function _register_controls() {
        $this->start_controls_section(
            'section_videos',
            [
                'label' => __('General', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => __( 'Link to', 'strollik5-core' ),
                'type' => Controls_Manager::TEXT,
                'description' => __('Support video from Youtube and Vimeo', 'strollik5-core'),
                'placeholder' => __( 'https://your-link.com', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'strollik5-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Tile', 'strollik5-core' ),
                'default'     => '',
            ]
        );

        $this->add_control(
            'position_title',
            [
                'label'   => __('Position Title', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before'        => __('Before', 'strollik5-core'),
                    'after'         => __('After', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-video-title-',
                'condition' => [
                    'title!'    => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'video_align',
            [
                'label'     => __('Alignment', 'strollik5-core'),
                'type'      => Controls_Manager::CHOOSE,
                'default'     => 'center',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_font',
            [
                'label' => __( 'Icon', 'strollik5-core' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'opal-icon-play',
            ]
        );

        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'section_video_style',
            [
                'label' => __( 'Icon', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'video_width',
            [
                'label'     => __('Width', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icons' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_height',
            [
                'label'     => __('Height', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icons' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_size',
            [
                'label'     => __('Font Size', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icons' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_style_icon',
            [
                'label'   => __('Border Style', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'        => __('None', 'strollik5-core'),
                    'dotted'      => __('Dotted', 'strollik5-core'),
                    'dashed'      => __('Dashed', 'strollik5-core'),
                    'solid'       => __('Solid', 'strollik5-core'),
                    'double'      => __('Double', 'strollik5-core'),
                    'groove'      => __('Groove', 'strollik5-core'),
                    'ridge'       => __('Ridge', 'strollik5-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-icons' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_size_icon',
            [
                'label'     => __('Border Size', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-icons' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'border_style_icon!'    => 'none'
                ]
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border_style_icon!'    => 'none'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .opal-video-popup .elementor-video-icons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_video_style' );

        $this->start_controls_tab(
            'tab_video_normal',
            [
                'label' => __( 'Normal', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label' => __( 'Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:not(:hover) .elementor-video-icons' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_bgcolor',
            [
                'label' => __( 'Background Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icons' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_bdcolor',
            [
                'label' => __( 'Border Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:not(:hover) .elementor-video-icons' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'border_style_icon!'    => 'none'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_video_hover',
            [
                'label' => __( 'Hover', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'video_hover_color',
            [
                'label' => __( 'Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default'     => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-icons' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_hover_bgcolor',
            [
                'label' => __( 'Background Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default'     => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-icons' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_hover_bdcolor',
            [
                'label' => __( 'Border Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-icons' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'border_style_icon!'    => 'none'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        //title
        $this->start_controls_section(
            'section_video_title',
            [
                'label' => __( 'Title', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .opal-video-popup .elementor-video-title',
            ]
        );

        $this->add_control(
            'border_style_title',
            [
                'label'   => __('Border Style', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'        => __('None', 'strollik5-core'),
                    'dotted'      => __('Dotted', 'strollik5-core'),
                    'dashed'      => __('Dashed', 'strollik5-core'),
                    'solid'       => __('Solid', 'strollik5-core'),
                    'double'      => __('Double', 'strollik5-core'),
                    'groove'      => __('Groove', 'strollik5-core'),
                    'ridge'       => __('Ridge', 'strollik5-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-title' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_size_title',
            [
                'label'     => __('Border Size', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-title' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'border_style_icon!'    => 'none'
                ]
            ]
        );

        $this->add_control(
            'title_border_radius',
            [
                'label' => __( 'Border Radius', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border_style_title!'    => 'none'
                ]
            ]
        );

        $this->add_control(
            'show_title_block',
            [
                'label' => __( 'Style Block', 'strollik5-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Off', 'strollik5-core' ),
                'label_on' => __( 'On', 'strollik5-core' ),
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup .elementor-video-popup' => 'flex-direction: column; align-items: center;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __( 'Normal', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .opal-video-popup:not(:hover) .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'title_bgcolor',
            [
                'label' => __( 'Background Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_bdcolor',
            [
                'label' => __( 'Border Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:not(:hover) .elementor-video-title' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'border_style_title!'    => 'none'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __( 'Hover', 'strollik5-core' ),
            ]
        );


        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_bgcolor',
            [
                'label' => __( 'Background Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default'     => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_bdcolor',
            [
                'label' => __( 'Border Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-title' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'border_style_icon!'    => 'none'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if(empty($settings['video_link'])){
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-video-wrapper' );
        $this->add_render_attribute( 'wrapper', 'class', 'opal-video-popup' );

        $this->add_render_attribute( 'button', 'class', 'elementor-video-popup' );
        $this->add_render_attribute( 'button', 'role', 'button' );
        $this->add_render_attribute( 'button', 'href',  esc_url( $settings['video_link']));
        $this->add_render_attribute( 'button', 'data-effect', 'mfp-zoom-in' );

        $contentHtml = '<i class="'. esc_attr( $settings['icon_font'] ).'"></i>';

        $titleHtml = !empty($settings['title']) ? '<span class="elementor-video-title">'.$settings['title'].'</span>' : '';


        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
                <span class="elementor-video-icons"><?php echo $contentHtml; ?></span>
                <?php echo ($titleHtml);?>
            </a>

        </div>
        <?php
    }

}
$widgets_manager->register_widget_type(new OSF_Elementor_Video_Popup());