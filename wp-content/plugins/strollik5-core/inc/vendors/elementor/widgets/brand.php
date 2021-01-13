<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Brand extends OSF_Elementor_Carousel_Base {

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-brand';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Opal Brands', 'strollik5-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'section_brands',
            [
                'label' => __('Brands', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'brands',
            [
                'label'       => __('Brand Items', 'strollik5-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => [
                    [
                        'name'        => 'brand_title',
                        'label'       => __('Brand name', 'strollik5-core'),
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __('Brand Name', 'strollik5-core'),
                        'placeholder' => __('Brand Name', 'strollik5-core'),
                        'label_block' => true,
                    ],
                    [
                        'name'    => 'brand_image',
                        'label'   => __('Choose Image', 'strollik5-core'),
                        'type'    => Controls_Manager::MEDIA,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'default' => [
                            'url' => Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'        => 'link',
                        'label'       => __('Link to', 'strollik5-core'),
                        'type'        => Controls_Manager::URL,
                        'dynamic'     => [
                            'active' => true,
                        ],
                        'placeholder' => __('https://your-link.com', 'strollik5-core'),
                    ]
                ],
                'title_field' => '{{{ brand_title }}}',
            ]
        );

        $this->add_control(
            'heading_settings',
            [
                'label'     => __('Settings', 'strollik5-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'brand_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => __('Columns', 'strollik5-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );

        $this->add_responsive_control(
            'brand_align',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-brand-image a' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_brand_image',
            [
                'label' => __( 'Image', 'strollik5-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_image_style' );

        $this->start_controls_tab(
            'tab_image_normal',
            [
                'label' => __( 'Normal', 'strollik5-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-brand-image',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_hover',
            [
                'label' => __( 'Hover', 'strollik5-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow_hover',
                'selector' => '{{WRAPPER}} .elementor-brand-image:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_image',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-brand-image',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-brand-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => __( 'Padding', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-brand-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __( 'Margin', 'strollik5-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-brand-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Add Carousel Control
        $this->add_control_carousel();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['brands']) && is_array($settings['brands'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-brand-wrapper');

            // Row
            $this->add_render_attribute('row', 'class', 'row');

            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
            } else {
                // Item
                $this->add_render_attribute('item', 'class', 'elementor-brand-item');
                $this->add_render_attribute('item', 'class', 'column-item');
            }

            $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
            if (!empty($settings['column_tablet'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
            }
            if (!empty($settings['column_mobile'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
            }


        }
        ?>
        <div class="elementor-brands">
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('row') ?>>
                    <?php foreach ($settings['brands'] as $item) : ?>
                        <div <?php echo $this->get_render_attribute_string('item'); ?>>
                            <div class="elementor-brand-image">
                                <?php
                                $item['image_size']             = $settings['brand_image_size'];
                                $item['image_custom_dimension'] = $settings['brand_image_custom_dimension'];

                                if (!empty($item['link'])) {
                                    if (!empty($item['link']['is_external'])) {
                                        $this->add_render_attribute('brand-image', 'target', '_blank');
                                    }

                                    if (!empty($item['link']['nofollow'])) {
                                        $this->add_render_attribute('brand-image', 'rel', 'nofollow');
                                    }

                                    echo '<a href="' . esc_url($item['link']['url'] ? $item['link']['url'] : '#') . '" ' . $this->get_render_attribute_string('brand-image') . ' title="' . esc_attr($item['brand_title']) . '">';
                                }

                                if (!empty($item['brand_image']['url'])) {
                                    $image_html = Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'image', 'brand_image');
                                    echo($image_html);
                                }

                                if (!empty($item['link'])) {
                                    echo '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Brand());
