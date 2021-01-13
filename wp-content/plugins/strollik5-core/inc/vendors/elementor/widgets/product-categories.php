<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!osf_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
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
class OSF_Elementor_Products_Categories extends Elementor\Widget_Base {

    public function get_categories() {
        return array('opal-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-product-categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Opal Product Categories', 'strollik5-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    public static function get_button_sizes()
    {
        return [
            'xs' => __('Extra Small', 'strollik5-core'),
            'sm' => __('Small', 'strollik5-core'),
            'md' => __('Medium', 'strollik5-core'),
            'lg' => __('Large', 'strollik5-core'),
            'xl' => __('Extra Large', 'strollik5-core'),
        ];
    }


    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function _register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => __('Settings', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'categories_name',
            [
                'label' => __('Alternate Name', 'strollik5-core'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => __('Categories', 'strollik5-core'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_product_categories(),
                'multiple' => false,
            ]
        );

        $this->add_control(
            'categories_style',
            [
                'label'   => __('Style', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Default', 'strollik5-core'),
                    'image' => __('Background image', 'strollik5-core'),
                    'embed' => __('Transparent', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-style-',
            ]
        );

        $this->add_control(
            'categories_embed',
            [
                'label'     => __('Size', 'strollik5-core'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1by1',
                'options'   => [
                    '21by9' => __('Ratio 21:9', 'strollik5-core'),
                    '16by9' => __('Ratio 16:9', 'strollik5-core'),
                    '4by3'  => __('Ratio 4:3', 'strollik5-core'),
                    '1by1'  => __('Ratio 1:1', 'strollik5-core'),
                ],
                'condition' => [
                    'categories_style' => 'embed'
                ]
            ]
        );

        $this->add_control(
            'category_image',
            [
                'label'      => __('Choose Image', 'strollik5-core'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
                'condition'  => [
                    'categories_style' => ['image','default']
                ]
            ]

        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
                'condition'  => [
                    'categories_style' => ['image','default']
                ]
            ]
        );

        $this->add_control(
            'text_align_h',
            [
                'label'       => __('Horizontal Alignment', 'strollik5-core'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'     => '',
                'options'     => [
                    'left'   => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'text_align_v',
            [
                'label'        => __('Vertical Alignment', 'strollik5-core'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'default'      => 'center',
                'options'      => [
                    'flex-start' => [
                        'title' => __('Top', 'strollik5-core'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => __('Middle', 'strollik5-core'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end'   => [
                        'title' => __('Bottom', 'strollik5-core'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                    'stretch'    => [
                        'title' => __('Stretch', 'strollik5-core'),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor-vertical-align-',
                'selectors'    => [
                    '{{WRAPPER}} .product-cats-meta' => 'justify-content: {{VALUE}}',
                ],
                'condition'  => [
                    'categories_style' => ['image']
                ]
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label'     => __('Show Button', 'strollik5-core'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'     => __('Text', 'strollik5-core'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => __('View Collection', 'strollik5-core'),
                'condition' => [
                    'show_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label' => __('Type', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    '' => __('Default', 'strollik5-core'),
                    'primary' => __('Primary', 'strollik5-core'),
                    'secondary' => __('Secondary', 'strollik5-core'),
                    'outline_primary' => __('Outline Primary', 'strollik5-core'),
                    'outline_secondary' => __('Outline Secondary', 'strollik5-core'),
                    'dark' => __('Dark', 'strollik5-core'),
                    'light' => __('Light', 'strollik5-core'),
                    'link' => __('Link', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-button-',
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __('Size', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => self::get_button_sizes(),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'show_button_when_hover',
            [
                'label'        => __('Show When Hover', 'strollik5-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'active',
                'prefix_class' => 'show-button-hover-',
                'condition'    => [
                    'show_button' => 'yes',
                    'categories_style!' => ['default']
                ]
            ]
        );

        $this->end_controls_section();

        //STYLE
        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __('Wrapper', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'categories_style' => 'image',
                ]
            ]
        );

        $this->add_control(
            'text_padding',
            [
                'label'      => __('Padding', 'strollik5-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cats-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('categories_colors');

        $this->start_controls_tab(
            'categories_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label'     => __('Overlay Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cats-image:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_category_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );


        $this->add_control(
            'overlay_color_hover',
            [
                'label'     => __('Overlay Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .cats-image:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __('Image', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'img_spacing',
            [
                'label'      => __('Spacing', 'strollik5-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .cats-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_name_style',
            [
                'label' => __('Name', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_name_style');

        $this->start_controls_tab(
            'tab_name_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => __('Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cats:not(:hover) .cats-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_name_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'name_color_hover',
            [
                'label'     => __('Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cats:hover .cats-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'category_name_typography',
                'selector' => '{{WRAPPER}} .cats-title',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'label'    => 'Typography'
            ]
        );

        $this->add_responsive_control(
            'name_spacing',
            [
                'label'      => __('Spacing', 'strollik5-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .cats-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_total_style',
            [
                'label' => __('Total', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'total_color',
            [
                'label'     => __('Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cats-total' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'total_name_typography',
                'selector' => '{{WRAPPER}} .cats-total',
                'label'    => 'Typography'
            ]
        );

        $this->add_responsive_control(
            'total_spacing',
            [
                'label'      => __('Spacing', 'strollik5-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .cats-total' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label'     => __('Button', 'strollik5-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Text Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label'     => __('Background Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'     => __('Text Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_background_color_hover',
            [
                'label'     => __('Background Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'     => __('Border Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .elementor-button',
                'separator' => 'before',

            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );
        $this->add_responsive_control(
            'button_text_padding',
            [
                'label'      => __('Padding', 'strollik5-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_text_margin',
            [
                'label'      => __('Margin', 'strollik5-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['categories'])) {
            return;
        }

        $category = get_term_by('slug', $settings['categories'], 'product_cat');
        if (!is_wp_error($category)) {

            if (!empty($settings['category_image']['id'])) {
                $image = Group_Control_Image_Size::get_attachment_image_src($settings['category_image']['id'], 'image', $settings);
            } else {
                $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
                if (!empty($thumbnail_id)) {
                    $image = wp_get_attachment_url($thumbnail_id);
                } else {
                    $image = wc_placeholder_img_src();
                }
            }
            ?>

            <div class="product-cats">
                <div class="cats-image">
                    <?php
                    if (($settings['categories_style']) === 'embed') {
                        ?>
                        <div class="embed-responsive embed-responsive-<?php echo esc_attr($settings['categories_embed']); ?>"></div>
                        <?php
                    } else {
                        ?>
                        <img src="<?php echo esc_url_raw($image); ?>"
                             alt="<?php echo esc_html($category->name); ?>">
                        <?php
                    }
                    ?>
                </div>
                <div class="product-cats-meta">
                    <a class="link_category_product" href="<?php echo esc_url(get_term_link($category)); ?>"
                       title="<?php echo esc_attr($category->name); ?>">
                        <span class="screen-reader-text"><?php echo esc_html($category->name); ?></span>
                    </a>
                    <div class="cats-title">
                        <a href="<?php echo esc_url(get_term_link($category)); ?>"
                           title="<?php echo esc_attr($category->name); ?>">
                            <?php echo empty($settings['categories_name']) ? esc_html($category->name) : wp_kses_post($settings['categories_name']); ?>
                        </a>
                    </div>
                    <div class="cats-total">
                        <?php echo esc_html($category->count) . esc_html__(' items', 'strollik5-core'); ?>
                    </div>
                    <?php
                    if ($settings['show_button'] === 'yes') {
                        ?>
                        <div class="cats-button">
                            <a class="elementor-button elementor-size-<?php echo $settings['button_size']; ?>" href="<?php echo esc_url(get_term_link($category)); ?>"
                               title="<?php echo esc_attr($category->name); ?>">
                                <?php echo esc_html($settings['button_text']); ?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <?php

        }

    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Products_Categories());

