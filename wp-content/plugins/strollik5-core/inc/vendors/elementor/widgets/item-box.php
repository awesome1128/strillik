<?php

use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class OSF_Elementor_Item_Box extends OSF_Elementor_Carousel_Base
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
        return 'opal-item-box';
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
        return __('Opal Item Box', 'strollik5-core');
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
        return 'eicon-image-box';
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
            'section_item_box',
            [
                'label' => __('Item Box', 'strollik5-core'),
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->add_control(
            'item',
            [
                'label' => __('Item Box Item', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $repeater->add_control(
            'view',
            [
                'label' => __('View', 'strollik5-core'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Choose Icon', 'strollik5-core' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __('Name', 'strollik5-core'),
                'default' => 'John Doe',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'strollik5-core'),
                'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.',
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link to', 'strollik5-core'),
                'placeholder' => __('https://your-link.com', 'strollik5-core'),
                'default' => [
                    'url' => '#',
                ],
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'item_box_items',
            [
                'label' => __('Item Box Items', 'strollik5-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columns', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label' => __('Gutter', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .elementor-item-box-wrapper' => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Text Alignment', 'strollik5-core'),
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} ' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Carousel Option
        $this->add_control_carousel();

        // Wrapper
        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => __('Wrapper', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-item-box-meta-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .layout_2 .item-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'item_box_layout' => 'layout_2',
                ]
            ]
        );

        $this->end_controls_section();

        // Icon
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
                'label' => __('Size', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_icon_style');

        $this->start_controls_tab(
            'tab_icon_normal',
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
                    '{{WRAPPER}} .elementor-item-box-meta-inner:not(:hover) i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-item-box-meta-inner:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Name
        $this->start_controls_section(
            'section_style_name',
            [
                'label' => __('Name', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_name',
                'selector' => '{{WRAPPER}} .elementor-item-box-name',
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
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-item-box-meta-inner:not(:hover) .elementor-item-box-name' => 'color: {{VALUE}};',
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
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-item-box-meta-inner:hover .elementor-item-box-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Description
        $this->start_controls_section(
            'section_style_description',
            [
                'label' => __('Description', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_description',
                'selector' => '{{WRAPPER}} .elementor-item-box-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-item-box-meta-inner .elementor-item-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-item-box-meta-inner .elementor-item-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
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

        $this->add_render_attribute('wrapper', 'class', 'elementor-item-box-wrapper');
        $this->add_render_attribute('wrapper', 'class', $settings['item_box_layout']);


        // Item
        $this->add_render_attribute('item', 'class', 'elementor-item-box-item');
        $this->add_render_attribute('item', 'class', 'column-item');

        $this->add_render_attribute('meta', 'class', 'elementor-item-box-meta');

        $this->add_render_attribute('row', 'class', 'row');



//        class carousel
        if ($settings['enable_carousel'] === 'yes') {
            $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
            $carousel_settings = array(
                'navigation' => $settings['navigation'],
                'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? 'true' : 'false',
                'autoplay' => $settings['autoplay'] === 'yes' ? 'true' : 'false',
                'autoplayTimeout' => $settings['autoplay_speed'],
                'items' => $settings['columns'],
                'items_tablet' => $settings['columns_tablet'],
                'items_mobile' => $settings['columns_mobile'],
                'loop' => $settings['infinite'] === 'yes' ? 'true' : 'false',

            );
            $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
        } else {
            if (!empty($settings['columns'])) {
                $this->add_render_attribute('row', 'data-elementor-columns', $settings['columns']);
            }

            if (!empty($settings['columns_tablet'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['columns_tablet']);
            }
            if (!empty($settings['columns_mobile'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['columns_mobile']);
            }
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('row') ?>>
                <?php foreach ($settings['item_box_items'] as $index => $item) : ?>
                    <div <?php echo $this->get_render_attribute_string('item'); ?>>
                        <?php $this->render_style($item,$index) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    protected function render_style($settings,$index)
    {
        //Icon
        if ( ! empty( $settings['icon'] ) ) {
            $element_icon = 'icon'.$index;
            $this->add_render_attribute( $element_icon, 'class', $settings['icon'] );
            $this->add_render_attribute( $element_icon, 'aria-hidden', 'true' );
        }
        ?>

        <div class="elementor-item-box-meta-inner">
            <div class="elementor-item-box-content">
                <?php
                if ( ! empty( $settings['icon'] ) ) {
                    ?>
                    <i <?php echo $this->get_render_attribute_string( $element_icon ); ?>></i>
                    <?php
                }
                ?>
                <?php
                $item_box_name_html = $settings['name'];
                if (!empty($settings['link']['url'])) :
                    $item_box_name_html = '<a href="' . esc_url($settings['link']['url']) . '">' . $item_box_name_html . '</a>';
                endif;
                ?>
                <div class="elementor-item-box-name"><?php echo $item_box_name_html; ?></div>
            </div>
            <?php
            $item_box_description_html = $settings['description'];
            ?>
            <div class="elementor-item-box-description"><?php echo $item_box_description_html; ?></div>

        </div>

        <?php
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Item_Box());
