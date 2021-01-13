<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor price menu widget.
 *
 * Elementor widget that displays price menu.
 *
 * @since 1.0.0
 */
class OSF_Widget_Price_Menu extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve price menu widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-price-menu';
    }

    public function get_title() {
        return __( 'Opal Price Menu', 'strollik5-core' );
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
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
        return [ 'price menu', 'price', 'menu' ];
    }

    /**
     * Register price menu widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_price_menu',
            [
                'label' => __( 'Price Menu', 'strollik5-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu',
            [
                'label' => __( 'Menu', 'strollik5-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Sunday', 'strollik5-core' ),
                'default' => __( 'Sunday', 'strollik5-core' ),
            ]
        );

        $repeater->add_control(
            'info',
            [
                'label' => __( 'Info', 'strollik5-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( '10.00 to 21.00', 'strollik5-core' ),
                'default' => __( '10.00 to 21.00', 'strollik5-core' ),
            ]
        );


        $this->add_control(
            'menu_list',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'menu' => __( 'Monday - Friday', 'strollik5-core' ),
                        'info' => __( '8.00 to 18.00', 'strollik5-core' ),
                    ],
                    [
                        'menu' => __( 'Saturday', 'strollik5-core' ),
                        'info' => __( '9.00 to 21.00', 'strollik5-core' ),
                    ],
                    [
                        'menu' => __( 'Sunday', 'strollik5-core' ),
                        'info' => __( '10.00 to 21.00', 'strollik5-core' ),
                    ],
                ],
                'title_field' => '{{{ menu }}}',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => __( 'Wrapper', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_spacing',
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
                    '{{WRAPPER}} .elementor-price-menu-list-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_menu',
            [
                'label' => __( 'Menu', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'width_menu',
            [
                'label' => __( 'Width', 'strollik5-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-menu-list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'menu_color',
            [
                'label'     => __('Text Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span.elementor-price-menu-list' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'selector' => '{{WRAPPER}} .elementor-price-menu-list',
            ]
        );

        $this->add_responsive_control(
            'menu_margin',
            [
                'label' => __( 'Margin', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-menu-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_padding',
            [
                'label' => __( 'Padding', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-price-menu-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_info',
            [
                'label' => __( 'Info', 'strollik5-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label'     => __('Text Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_typography',
                'selector' => '{{WRAPPER}} .info',
            ]
        );

        $this->add_responsive_control(
            'info_margin',
            [
                'label' => __( 'Margin', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_padding',
            [
                'label' => __( 'Padding', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render price menu widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'price_menu', 'class', 'elementor-price-menu' );
        ?>

        <ul <?php echo $this->get_render_attribute_string( 'price_menu' ); ?>>
            <?php
            foreach ( $settings['menu_list'] as $index => $item ) :
                $repeater_setting_key = $this->get_repeater_setting_key( 'menu', 'menu_list', $index );

                $this->add_render_attribute( $repeater_setting_key, 'class', 'elementor-price-menu-list' );

                $this->add_inline_editing_attributes( $repeater_setting_key );
                ?>
                <li class="elementor-price-menu-list-item" >
                    <span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>><?php echo $item['menu']; ?></span>
                    <span class="info"><?php echo $item['info']; ?></span>
                </li>
            <?php
            endforeach;
            ?>
        </ul>

        <?php
    }
}
$widgets_manager->register_widget_type(new OSF_Widget_Price_Menu());