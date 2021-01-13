<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor icon list widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class OSF_Widget_Icon_List extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve icon list widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'icon-list';
    }

    /**
     * Get widget title.
     *
     * Retrieve icon list widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Icon List', 'strollik5-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve icon list widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-bullet-list';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'icon list', 'icon', 'list' ];
    }

    /**
     * Register icon list widget controls.
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
                'label' => __( 'Icon List', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __( 'Layout', 'strollik5-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'traditional',
                'options' => [
                    'traditional' => [
                        'title' => __( 'Default', 'strollik5-core' ),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => __( 'Inline', 'strollik5-core' ),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'render_type' => 'template',
                'classes' => 'elementor-control-start-end',
                'label_block' => false,
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => __( 'Text', 'strollik5-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'List Item', 'strollik5-core' ),
                'default' => __( 'List Item', 'strollik5-core' ),
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'strollik5-core' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'fa fa-check',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'Link', 'strollik5-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => __( 'https://your-link.com', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'icon_list',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => __( 'List Item #1', 'strollik5-core' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __( 'List Item #2', 'strollik5-core' ),
                        'icon' => 'fa fa-times',
                    ],
                    [
                        'text' => __( 'List Item #3', 'strollik5-core' ),
                        'icon' => 'fa fa-dot-circle-o',
                    ],
                ],
                'title_field' => '<i class="{{ icon }}" aria-hidden="true"></i> {{{ text }}}',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_icon_list',
            [
                'label' => __( 'List', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_list_item',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-icon-list-item',
            ]
        );

        $this->add_control(
            'list_item_border_radius',
            [
                'label'      => __( 'Border Radius', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label'      => __( 'Padding', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_item_margin',
            [
                'label'      => __( 'Margin', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_align',
            [
                'label' => __( 'Alignment', 'strollik5-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'strollik5-core' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'strollik5-core' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'strollik5-core' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'icon_position',
            [
                'label' => __( 'Position', 'strollik5-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Above', 'strollik5-core' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'strollik5-core' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Below', 'strollik5-core' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item,{{WRAPPER}} .elementor-icon-list-item a' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __( 'Icon', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => __( 'Font Size', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 14,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_icon',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-icon-list-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label'      => __( 'Border Radius', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __( 'Margin', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_icon_style' );

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => __( 'Normal', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-list .elementor-icon-list-item:not(:hover) i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => __( 'Hover', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => __( 'Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-list .elementor-icon-list-item:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_border_color_hover',
            [
                'label' => __( 'Border Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => __( 'Text', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_indent',
            [
                'label' => __( 'Text Indent', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-list-item',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->start_controls_tabs( 'tabs_text_style' );

        $this->start_controls_tab(
            'tab_text_normal',
            [
                'label' => __( 'Normal', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-list .elementor-icon-list-item:not(:hover) .elementor-icon-list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_text_hover',
            [
                'label' => __( 'Hover', 'strollik5-core' ),
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label' => __( 'Hover', 'strollik5-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-list .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render icon list widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'icon_list', 'class', 'elementor-icon-list-items' );
        $this->add_render_attribute( 'list_item', 'class', 'elementor-icon-list-item' );

        if ( 'inline' === $settings['view'] ) {
            $this->add_render_attribute( 'icon_list', 'class', 'elementor-inline-items' );
            $this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
        }
        ?>
        <ul <?php echo $this->get_render_attribute_string( 'icon_list' ); ?>>
            <?php
            foreach ( $settings['icon_list'] as $index => $item ) :
                $repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

                $this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-icon-list-text' );

                $this->add_inline_editing_attributes( $repeater_setting_key );
                ?>
                <li class="elementor-icon-list-item" >
                    <?php
                    if ( ! empty( $item['link']['url'] ) ) {
                        $link_key = 'link_' . $index;

                        $this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

                        if ( $item['link']['is_external'] ) {
                            $this->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $item['link']['nofollow'] ) {
                            $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }

                        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                    }

                    if ( ! empty( $item['icon'] ) ) :
                        ?>
                        <span class="elementor-icon-list-icon">
							<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
						</span>
                    <?php endif; ?>
                    <span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo $item['text']; ?></span>
                    <?php if ( ! empty( $item['link']['url'] ) ) : ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php
            endforeach;
            ?>
        </ul>
        <?php
    }
}
$widgets_manager->register_widget_type(new OSF_Widget_Icon_List());