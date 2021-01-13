<?php

//namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Control_Media;

class OSF_Elementor_TimelineCarousel extends OSF_Elementor_Carousel_Base
{

    public function get_name()
    {
        return 'opal-timelinecarousel';
    }

    public function get_title()
    {
        return __('Opal Timeline Carousel', 'strollik5-core');
    }

    public function get_categories()
    {
        return array('opal-addons');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }


//    public function get_script_depends()
//    {
//        return [
//            'timeline',
//            'parallaxmouse',
//            'tweenmax',
//            'tilt',
//            'waypoints',
//        ];
//    }

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


    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => __('Columns', 'strollik5-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __('Title & Content', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Timeline Title', 'strollik5-core'),
                'label_block' => true,
            ]


        );
        $repeater->add_control(
            'content',

            [
                'label' => __('Content', 'strollik5-core'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Timeline Content', 'strollik5-core'),
                'show_label' => false,
            ]
        );
        $repeater->add_control(
            'content_animation',
            [
                'label' => __('Content Animation', 'strollik5-core'),
                'type' => Controls_Manager::ANIMATION,
                'frontend_available' => true,
            ]
        );
        $repeater->add_control(
            'content_animation_duration',
            [
                'label' => __('Animation Duration', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'slow' => __('Slow', 'strollik5-core'),
                    '' => __('Normal', 'strollik5-core'),
                    'fast' => __('Fast', 'strollik5-core'),
                ],
                'condition' => [
                    'content_animation!' => '',
                ],
            ]
        );
        $repeater->add_control(
            'content_animation_delay',
            [
                'label' => __('Animation Delay', 'strollik5-core') . ' (ms)',
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'min' => 0,
                'step' => 100,
                'condition' => [
                    'content_animation!' => '',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'buttom',
            [
                'label' => __('Buttom', 'strollik5-core'),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'placeholder' => __('Buttom name', 'strollik5-core'),

                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'strollik5-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'strollik5-core'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'activate',
            [
                'label' => __('Activate', 'strollik5-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'strollik5-core'),
                'label_on' => __('On', 'strollik5-core'),
            ]
        );


        $this->add_control(
            'timeline_list',
            [
                'label' => __('Timeline Items', 'strollik5-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __('Timeline #1', 'strollik5-core'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'strollik5-core'),
                        'image' => Utils::get_placeholder_image_src(),
                        'bottom' => '',
                        'link' => '#'
                    ],
                    [
                        'title' => __('Timeline #2', 'strollik5-core'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'strollik5-core'),
                        'image' => Utils::get_placeholder_image_src(),
                        'bottom' => '',
                        'link' => '#'
                    ],
                    [
                        'title' => __('Timeline #3', 'strollik5-core'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'strollik5-core'),
                        'image' => Utils::get_placeholder_image_src(),
                        'bottom' => '',
                        'link' => '#'
                    ],
                ],
                'title_field' => '{{{ title }}}',

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item_style',
            [
                'label' => __('Item', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );

        $this->add_control(
            'content_align_mobile',
            [
                'label' => __('Alignment Mobile', 'strollik5-core'),
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
                'selectors' => [
                    '(mobile){{WRAPPER}} .timeline-content ' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control('padding',
            [
                'label' => esc_html__('Padding', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-content ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .timeline-content ',
            ]
        );
        $this->add_responsive_control(
            'item_spacing_item',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'number_style',
            [
                'label' => __('Number', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('number_colors_tab');

        $this->start_controls_tab(
            'number_color_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'number_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .timeline-number' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'number_background_color',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-number' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'number_color_activate',
            [
                'label' => __('Activate', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'number_color_2',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .timeline-item-activate .timeline-number' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .timeline-carosuel-item:hover .timeline-number'=> 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'number_background_color_2',
            [
                'label' => __('Background Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-item-activate .timeline-number' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .timeline-carosuel-item:hover .timeline-number' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'number_border_color',
            [
                'label' => __('Border Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-item-activate .timeline-number' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .timeline-carosuel-item:hover .timeline-number' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control(
            'line_color',
            [
                'label' => __('Line Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .timeline-carosuel-item .timeline-content:after' => 'background: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_number',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .timeline-number',
            ]
        );

        $this->add_control(
            'number_border_radius',
            [
                'label' => __('Border Radius', 'strollik5-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
//        $this->add_responsive_control(
//            'side_number',
//            [
//                'label' => __('Size', 'strollik5-core'),
//                'type' => Controls_Manager::SLIDER,
//                'range' => [
//                    'px' => [
//                        'min' => 50,
//                        'max' => 200,
//                    ],
//                ],
//                'size_units' => ['px', 'em', '%'],
//                'selectors' => [
//                    '{{WRAPPER}} .timeline-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
//                ],
//            ]
//        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .timeline-number',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_responsive_control(
            'number_spacing_item',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Title', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __('Title', 'strollik5-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .timeline-title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .timeline-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_responsive_control(
            'title_spacing_item',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .timeline-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __('Color', 'strollik5-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .content',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );
        $this->add_responsive_control(
            'content_spacing_item',
            [
                'label' => __('Spacing', 'strollik5-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'buttom_style',
            [
                'label' => __('Butttom', 'strollik5-core'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                    'link' => __('Link', 'strollik5-core'),
                    'info' => __('Info', 'strollik5-core'),
                    'success' => __('Success', 'strollik5-core'),
                    'warning' => __('Warning', 'strollik5-core'),
                    'danger' => __('Danger', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-button-',
            ]
        );
        $this->add_control(
            'buttom_size',
            [
                'label' => __('Size', 'strollik5-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => self::get_button_sizes(),
                'style_transfer' => true,
            ]
        );


        $this->end_controls_section();

// Carousel Option
        $this->add_control_carousel();

    }

    public function set_render_attribute($element, $key = null, $value = null)
    {
        return $this->add_render_attribute($element, $key, $value, true);
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'elementor-timeline-carousel');
        if ($settings['enable_carousel'] === 'yes') {
            $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
            $carousel_settings = $this->get_carousel_settings();
            $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
        } else {
            $this->add_render_attribute('row', 'class', 'timeline-carousel');
        }

        ?>

        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('row') ?>>
                <?php
                foreach ($settings['timeline_list'] as $index => $item) :

                    //content
                    $content_animation_dur = '';
                    $content = 'content_' . $index;

                    if ('' != $item['content_animation_duration']) {
                        $content_animation_dur = 'animated-' . $item['content_animation_duration'];

                    }
                    $content_animation_class = $item['content_animation'] ? $item['content_animation'] : '';

                    if (!empty($item['content_animation_delay'])) {
                        $this->add_render_attribute($content, 'data-timeline-animation-delay', $item['content_animation_delay']);
                    }
                    $this->add_render_attribute($content, 'class', 'timeline-content');
                    $this->add_render_attribute($content, 'class', 'timeline-animation');
                    $this->add_render_attribute($content, 'data-timeline-animation',
                        [
                            $content_animation_class,
                            $content_animation_dur,
                        ]
                    );

                    //button
                    $link_key = 'link_' . $index;
                    $number = $index + 1;
                    $this->add_render_attribute($link_key, 'class', 'elementor-button');
                    $this->add_render_attribute($link_key, 'class', 'elementor-size-' . $settings['buttom_size']);
                    $class_item = $index;
                    if ($item['activate']) {
                        $class_item .= ' timeline-item-activate';
                    }

                    if (!empty($item['link']['url'])) {
                        $this->add_render_attribute($link_key, 'href', $item['link']['url']);
                        if ($item['link']['is_external']) {
                            $this->add_render_attribute($link_key, 'target', '_blank');
                        }

                        if ($item['link']['nofollow']) {
                            $this->add_render_attribute($link_key, 'rel', 'nofollow');
                        }
                    }

                    ?>

                    <div class="timeline-carosuel-item timeline-item-<?php echo esc_attr($class_item) ?>">

                        <div <?php echo $this->get_render_attribute_string($content); ?>>
                            <div class="timeline-number">
                                <span><?php echo $number; ?></span>
                            </div>
                            <?php if (!empty($item['title'])) : ?>
                                <h2 class="timeline-title"><?php echo $item['title']; ?></h2>
                            <?php endif; ?>

                            <?php if (!empty($item['content'])) : ?>
                                <div class="content">
                                    <?php echo $this->parse_text_editor($item['content']); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($item['buttom'])) : ?>
                                <div class="timeline-buttom">
                                    <a <?php echo $this->get_render_attribute_string($link_key); ?>>
                                        <?php echo $item['buttom']; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_TimelineCarousel());