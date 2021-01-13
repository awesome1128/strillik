<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class OSF_Elementor_Testimonials_2 extends OSF_Elementor_Carousel_Base
{

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'opal-testimonials-2';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Opal Testimonials 2', 'strollik5-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    public function get_script_depends()
    {
        return [
            'imagesloaded',
            'event-move',
            'imgcompare'
        ];
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
        $this->add_control('title',
            [
                'label' => __('Title', 'strollik5-core'),
                'default' => 'Title',
                'type' => Controls_Manager::TEXT,
            ]);
        $this->add_control('sub_title',
            [
                'label' => __('Sub Title', 'strollik5-core'),
                'default' => 'Sub Title',
                'type' => Controls_Manager::TEXT,
            ]);
        $repeater = new Repeater();

        $repeater->add_control('testimonial_content',
            [
                'label' => __('Content', 'strollik5-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows' => '10',
            ]);
        $repeater->add_control('testimonial_name',
            [
                'label' => __('Name', 'strollik5-core'),
                'default' => 'John Doe',
                'type' => Controls_Manager::TEXT,
            ]);
        $repeater->add_control('testimonial_job',
            [
                'label' => __('Job', 'strollik5-core'),
                'default' => 'Design',
                'type' => Controls_Manager::TEXT,
            ]);
        $repeater->add_control('testimonial_link',
            [
                'label' => __('Link to', 'strollik5-core'),
                'placeholder' => __('https://your-link.com', 'strollik5-core'),
                'type' => Controls_Manager::URL,
            ]);

        $repeater->start_controls_tabs('testimonial_tab_image');
        $repeater->start_controls_tab('testimonial_tab_image_before',
            [
                'label' => __('Before', 'strollik5-core'),
            ]);
        $repeater->add_control('testimonial_image',
            [
                'label' => __('Image Before', 'strollik5-core'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'type' => Controls_Manager::MEDIA,
            ]);
        $repeater->end_controls_tab();
        $repeater->start_controls_tab('testimonial_tab_image_after',
            [
                'label' => __('After', 'strollik5-core'),
            ]);
        $repeater->add_control('testimonial_image_after',
            [
                'label' => __('Image After', 'strollik5-core'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'type' => Controls_Manager::MEDIA,
            ]);
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'testimonials',
            [
                'label' => __('Testimonials Item', 'strollik5-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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

        $this->end_controls_section();


        // Title
        $this->start_controls_section(
            'section_style_testimonial_title',
            [
                'label' => __('Title', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-title',
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


        // Title
        $this->start_controls_section(
            'section_style_testimonial_sub_title',
            [
                'label' => __('Sub Title', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-sub-title',
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_title_margin',
            [
                'label' => __('Margin', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-wrapper row');

            // Row
            $this->add_render_attribute('col', 'class', 'col-lg-6 col-12');

            // Item
            $this->add_render_attribute('item', 'class', 'elementor-testimonial-item');

            ?>
            <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                <div <?php echo $this->get_render_attribute_string('col') ?>>
                    <h3 class="elementor-testimonial-title"><?php echo esc_html($settings['title']); ?></h3>
                    <p class="elementor-testimonial-sub-title"><?php echo esc_html($settings['sub_title']); ?></p>
                    <div class="elementor-testimonial-wrapper-inner">
                        <div class="testimonials-decor">
                            <i class="opal-icon-quote2" aria-hidden="true"></i>
                        </div>
                        <div class="carousel-wrapper">
                            <div class="owl-carousel owl-theme owl-carousel-1">
                                <?php foreach ($settings['testimonials'] as $testimonial): ?>
                                    <div <?php echo $this->get_render_attribute_string('item'); ?>>
                                        <div class="item-box"
                                             data-trigger="<?php echo '.tes-item-' . esc_attr($testimonial['_id']); ?>">
                                            <div class="elementor-testimonial-content-top">
                                                <?php if ($testimonial['testimonial_content']): ?>
                                                    <div class="elementor-testimonial-content">
                                                        <?php echo $testimonial['testimonial_content']; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="elementor-testimonial-author-wrapper">
                                                <div class="elementor-testimonial-details">
                                                    <?php
                                                    $testimonial_name_html = $testimonial['testimonial_name'];
                                                    if (!empty($testimonial['testimonial_link']['url'])) :
                                                        $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . $testimonial_name_html . '</a>';
                                                    endif;
                                                    ?>
                                                    <div class="elementor-testimonial-author">
                                                        <div class="elementor-testimonial-name"><?php echo $testimonial_name_html; ?></div>
                                                        <div class="elementor-testimonial-job">
                                                            <?php echo $testimonial['testimonial_job']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                     <div class="owl-carousel-2 owl-carousel">
                    <?php foreach ($settings['testimonials'] as $index => $testimonial): ?>
                        <div class="elementor-testimonial-image-wrapper <?php echo 'tes-item-' . esc_attr($testimonial['_id']); ?>"
                             data-index="<?php echo esc_attr($index) ?>">
                            <?php $this->render_image($settings, $testimonial); ?>
                        </div>
                    <?php endforeach; ?>
                     </div>
                </div>

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
            if (!empty($testimonial['testimonial_image_after']['url'])) :
                $image_html = Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image_after');
                echo $image_html;
            endif;
            ?>
        </div>
        <?php
    }

}


$widgets_manager->register_widget_type(new OSF_Elementor_Testimonials_2());
