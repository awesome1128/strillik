<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class OSF_Elementor_Team_Box extends Elementor\Widget_Base
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
        return 'opal-team-box';
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
        return __('Opal Team Box', 'strollik5-core');
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
        return 'eicon-person';
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
            'section_team',
            [
                'label' => __('Team', 'strollik5-core'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
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

        $this->add_control(
            'teams',
            [
                'label' => __('Team Item', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choose Image', 'strollik5-core'),
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __('Name', 'strollik5-core'),
                'default' => 'John Doe',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link Name', 'strollik5-core'),
                'placeholder' => __('https://your-link.com', 'strollik5-core'),
                'default' => [
                    'url' => '#',
                ],
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'job',
            [
                'label' => __('Job', 'strollik5-core'),
                'default' => '',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'strollik5-core'),
                'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.',
                'type' => Controls_Manager::TEXTAREA,
            ]
        );


        $this->add_control(
            'facebook',
            [
                'label' => __('Facebook', 'strollik5-core'),
                'placeholder' => __('https://www.facebook.com/opalwordpress', 'strollik5-core'),
                'default' => 'https://www.facebook.com/opalwordpress',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'twitter',
            [
                'label' => __('Twitter', 'strollik5-core'),
                'placeholder' => __('https://twitter.com/opalwordpress', 'strollik5-core'),
                'default' => 'https://twitter.com/opalwordpress',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'youtube',
            [
                'label' => __('Youtube', 'strollik5-core'),
                'placeholder' => __('https://www.youtube.com/user/WPOpalTheme', 'strollik5-core'),
                'default' => 'https://www.youtube.com/user/WPOpalTheme',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'google',
            [
                'label' => __('Google', 'strollik5-core'),
                'placeholder' => __('https://plus.google.com/u/0/+WPOpal', 'strollik5-core'),
                'default' => 'https://plus.google.com/u/0/+WPOpal',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Layout', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'layout_1',
                'options' => [
                    'layout_1' => __('Layout 1', 'strollik5-core'),
                    'layout_2' => __('Layout 2', 'strollik5-core'),
                ],
            ]
        );

        $this->add_responsive_control(
            'team_align',
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Wrapper
        $this->start_controls_section(
            'section_style_team_wrapper',
            [
                'label' => __('Wrapper', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __( 'Margin', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => __( 'Padding', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-team-content-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout' => 'layout_2',
                ]
            ]
        );

        $this->end_controls_section();


        // Image.
        $this->start_controls_section(
            'section_style_team_image',
            [
                'label' => __('Image', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'img_border_radius',
            [
                'label' => __( 'Border Radius', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-team-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_space',
            [
                'label' => __( 'Margin', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_team_name',
            [
                'label' => __('Name', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'name!' => '',
                ]
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label' => __('Hover Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name',
            ]
        );

        $this->add_responsive_control(
            'name_space',
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
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_team_job',
            [
                'label' => __('Job', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'job!' => '',
                ]
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label' => __('Text Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-job',
            ]
        );

        $this->add_responsive_control(
            'spacing_job',
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
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-job' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Description.
        $this->start_controls_section(
            'section_style_team_description',
            [
                'label' => __('Description', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'description!' => '',
                ]
            ]
        );

        $this->add_control(
            'description_text_color',
            [
                'label' => __('Text Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-description',
            ]
        );

        $this->add_responsive_control(
            'spacing_description',
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
                    '{{WRAPPER}} .elementor-teams-wrapper .elementor-team-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Social.
        $this->start_controls_section(
            'section_style_icon_social',
            [
                'label' => __('Icon Social', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => __('Font Size', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .team-icon-socials a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_icon',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .team-icon-socials a',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'strollik5-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_icon_social_style');

        $this->start_controls_tab(
            'tab_icon_social_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'color_icon_social',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',

                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials a:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bgcolor_icon_social',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',

                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_social_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'color_icon_social_hover',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-team-socials a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bgcolor_icon_social_hover',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bdcolor_icon_social_hover',
            [
                'label' => __('Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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

        $this->add_render_attribute('wrapper', 'class', 'elementor-teams-wrapper');


        // Item
        $this->add_render_attribute('item', 'class', 'elementor-team-item');

        $this->add_render_attribute('meta', 'class', 'elementor-team-meta');

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('item'); ?>>
                <?php $this->render_style($settings) ?>
            </div>
        </div>
        <?php
    }

    protected function render_style($settings)
    {
        $team_name_html = $settings['name'];
        if (!empty($settings['link']['url'])) :
            $team_name_html = '<a href="' . esc_url($settings['link']['url']) . '">' . $team_name_html . '</a>';
        endif;

        ?>

        <div class="elementor-team-meta-inner">

            <?php if ($settings['layout'] == 'layout_1'): ?>
                <div class="elementor-team-image">
                    <?php
                    if (!empty($settings['image']['url'])) :
                        $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
                        echo $image_html;
                    endif;
                    ?>
                </div>
                <div class="elementor-team-details">
                    <div class="elementor-team-name"><?php echo $team_name_html; ?></div>
                    <div class="elementor-team-job"><?php echo $settings['job']; ?></div>
                    <div class="elementor-team-description"><?php echo $settings['description']; ?></div>
                </div>
                <div class="elementor-team-socials">
                    <ul class="team-icon-socials">
                        <?php foreach ($this->get_socials() as $key => $social): ?>
                            <?php if (!empty($settings[$key])) : ?>
                                <li class="social">
                                    <a href="<?php echo esc_url($settings[$key]) ?>">
                                        <i class="fa <?php echo esc_attr($social); ?>"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($settings['layout'] == 'layout_2'): ?>

                <div class="elementor-team-image">
                    <?php
                    if (!empty($settings['image']['url'])) :
                        $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
                        echo $image_html;
                    endif;
                    ?>
                </div>

                <div class="elementor-team-content-1">
                    <div class="elementor-team-details">
                        <div class="elementor-team-name"><?php echo $team_name_html; ?></div>
                        <div class="elementor-team-job"><?php echo $settings['job']; ?></div>
                        <div class="elementor-team-description"><?php echo $settings['description']; ?></div>
                    </div>
                    <div class="elementor-team-socials">
                        <ul class="team-icon-socials">
                            <?php foreach ($this->get_socials() as $key => $social): ?>
                                <?php if (!empty($settings[$key])) : ?>
                                    <li class="social">
                                        <a href="<?php echo esc_url($settings[$key]) ?>">
                                            <i class="fa <?php echo esc_attr($social); ?>"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="elementor-team-content-2">
                    <div class="elementor-team-socials">
                        <ul class="team-icon-socials">
                            <?php foreach ($this->get_socials() as $key => $social): ?>
                                <?php if (!empty($settings[$key])) : ?>
                                    <li class="social">
                                        <a href="<?php echo esc_url($settings[$key]) ?>">
                                            <i class="fa <?php echo esc_attr($social); ?>"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            <?php endif; ?>

        </div>
        <?php
    }

    private function get_socials()
    {
        return array(
            'facebook'  => 'fa-facebook',
            'twitter'   => 'fa-twitter',
            'youtube'   => 'fa-youtube',
            'google'    => 'fa-google-plus',
        );
    }

}

$widgets_manager->register_widget_type(new OSF_Elementor_Team_Box());
