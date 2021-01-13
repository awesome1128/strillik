<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Class Portfolio
 */
class OSF_Elementor_Portfolio extends OSF_Elementor_Carousel_Base {

    public function get_name() {
        return 'opal-portfolio';
    }

    public function get_title() {
        return __('Opal Portfolio', 'strollik5-core');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array('opal-addons');
    }

    public function get_script_depends() {
        return ['isotope', 'imagesloaded'];
    }


    protected function _register_controls() {
        $this->register_query_section_controls();
    }

    public static function get_button_sizes() {
        return [
            'xs' => __('Extra Small', 'strollik5-core'),
            'sm' => __('Small', 'strollik5-core'),
            'md' => __('Medium', 'strollik5-core'),
            'lg' => __('Large', 'strollik5-core'),
            'xl' => __('Extra Large', 'strollik5-core'),
        ];
    }

    private function register_query_section_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => __('Columns', 'strollik5-core'),
                'type'               => Controls_Manager::SELECT,
                'default'            => '3',
                'tablet_default'     => '2',
                'mobile_default'     => '1',
                'options'            => [
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

        $this->add_control(
            'posts_per_page',
            [
                'label'   => __('Posts Per Page', 'strollik5-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label'      => __('Gutter', 'strollik5-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); padding-bottom: calc({{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .row'         => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->add_control(
            'show_filter_bar',
            [
                'label'     => __('Filter Bar', 'strollik5-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'strollik5-core'),
                'label_on'  => __('On', 'strollik5-core'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'        => __('Style', 'strollik5-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'default',
                'options'      => [
                    'default' => __('Default', 'strollik5-core'),
                    'overlay' => __('Overlay', 'strollik5-core'),
                    'caption' => __('Caption', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-portfolio-style-',
            ]
        );

        $this->add_control(
            'masonry',
            [
                'label'     => __('Layout', 'strollik5-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'default' => __('Default', 'strollik5-core'),
                    'masonry' => __('Masonry', 'strollik5-core'),
                    'metro'   => __('Metro', 'strollik5-core'),

                ],
                'default'      => 'default',
                'condition' => [
                    'style' => 'default',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_loadmore',
            [
                'label' => __('Button Load more', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_carousel!' => 'yes',
                ]
            ]

        );

        $this->add_control(
            'show_load_more',
            [
                'label'     => __('Show load more', 'strollik5-core'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'strollik5-core'),
                'label_on'  => __('On', 'strollik5-core'),
                'condition' => [
                    'enable_carousel!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'button_type',
            [
                'label'        => __('Type', 'strollik5-core'),
                'type'         => Controls_Manager::SELECT,
                'default'      => '',
                'options'      => [
                    ''        => __('Default', 'strollik5-core'),
                    'info'    => __('Info', 'strollik5-core'),
                    'success' => __('Success', 'strollik5-core'),
                    'warning' => __('Warning', 'strollik5-core'),
                    'danger'  => __('Danger', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-button-',
                'condition'    => [
                    'show_load_more' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label'       => __('Text', 'strollik5-core'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('View more', 'strollik5-core'),
                'placeholder' => __('Enter text here', 'strollik5-core'),
                'condition'   => [
                    'show_load_more' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'        => __('Alignment', 'strollik5-core'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
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
                    'justify' => [
                        'title' => __('Justified', 'strollik5-core'),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default'      => '',
                'condition'    => [
                    'show_load_more' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'size',
            [
                'label'     => __('Size', 'strollik5-core'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'sm',
                'options'   => self::get_button_sizes(),
                'condition' => [
                    'show_load_more' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'advanced',
            [
                'label' => __('Advanced', 'strollik5-core'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => __('Categories', 'strollik5-core'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_portfolio_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __('Order By', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'       => __('Date', 'strollik5-core'),
                    'title'      => __('Title', 'strollik5-core'),
                    'menu_order' => __('Menu Order', 'strollik5-core'),
                    'rand'       => __('Random', 'strollik5-core'),
                    'ID'         => __('ID', 'strollik5-core')
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __('Order', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => __('ASC', 'strollik5-core'),
                    'desc' => __('DESC', 'strollik5-core'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_design_filter',
            [
                'label'     => __('Filter Bar', 'strollik5-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_filter',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-portfolio__filter',
            ]
        );

        $this->start_controls_tabs('tabs_wrapper_style');

        $this->start_controls_tab(
            'tab_filter_normal',
            [
                'label' => __('Normal', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'color_filter',
            [
                'label'     => __('Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#777777',
                'selectors' => [
                    '{{WRAPPER}} .elementor-portfolio__filter' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background_filter',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementor-portfolio__filter',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_filter_hover',
            [
                'label' => __('Hover', 'strollik5-core'),
            ]
        );
        $this->add_control(
            'color_filter_active',
            [
                'label'     => __('Active Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .elementor-portfolio__filter.elementor-active,{{WRAPPER}} .elementor-portfolio__filter:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background_filter_hover',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementor-portfolio__filter.elementor-active,{{WRAPPER}} .elementor-portfolio__filter:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'filter_item_spacing',
            [
                'label'     => __('Space Between', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 5,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-portfolio__filter:not(:last-child)'  => 'margin-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .elementor-portfolio__filter:not(:first-child)' => 'margin-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'filter_spacing',
            [
                'label'     => __('Spacing', 'strollik5-core'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 50,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-portfolio__filters' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_padding',
            [
                'label'      => __('Filter Padding', 'strollik5-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-portfolio__filters' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'filter_align',
            [
                'label'        => __('Alignment', 'strollik5-core'),
                'type'         => Controls_Manager::CHOOSE,
                'default'      => 'top',
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'strollik5-core'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'strollik5-core'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'strollik5-core'),
                        'icon'  => 'fa fa-align-right',
                    ]
                ],
                'toggle'       => false,
                'prefix_class' => 'elementor-filter-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Button', 'strollik5-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
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
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __('Background Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} a.button-primary:hover, {{WRAPPER}} .button-primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label'     => __('Background Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.button-primary:hover, {{WRAPPER}} .button-primary:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => __('Border Color', 'strollik5-core'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} a.button-primary:hover, {{WRAPPER}} .button-primary:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __('Hover Animation', 'strollik5-core'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .button-primary',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'      => __('Border Radius', 'strollik5-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} a.button-primary, {{WRAPPER}} .button-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .button-primary',
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => __('Padding', 'strollik5-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} a.button-primary, {{WRAPPER}} .button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
        $this->add_responsive_control(
            'text_margin',
            [
                'label'      => __('Margin', 'strollik5-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} a.button-primary, {{WRAPPER}} .button-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->end_controls_section();

        $this->add_control_carousel();
    }

    public function query_posts() {
        $query_args = [
            'orderby'             => $this->get_settings_for_display('orderby'),
            'order'               => $this->get_settings_for_display('order'),
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish', // Hide drafts/private posts for admins
            'post_type'           => 'osf_portfolio',
            'posts_per_page'      => $this->get_settings_for_display('posts_per_page')
        ];

        if (!empty($this->get_settings_for_display('categories'))) {
            $query_args['tax_query'] = [
                [
                    'taxonomy' => 'osf_portfolio_cat',
                    'field'    => 'slug',
                    'terms'    => $this->get_settings_for_display('categories'),
                ]
            ];
        }
        return new WP_Query($query_args);
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $wp_query = $this->query_posts();

        if (!$wp_query->found_posts) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-post-wrapper');

        if ($settings['masonry'] === 'masonry') {
            $this->add_render_attribute('wrapper', 'class', 'elementor-portfolio-masonry');
        }

        if ($settings['masonry'] === 'metro') {
            $this->add_render_attribute('wrapper', 'class', 'elementor-portfolio-metro');
        }


        $this->add_render_attribute('wrapper', 'id', 'isotope-' . $this->get_id());

        $this->add_render_attribute('row', 'class', 'row');

        if ($settings['enable_carousel'] === 'yes') {
            $this->add_render_attribute('row', 'class', 'owl-carousel owl-theme');
            $carousel_settings = $this->get_carousel_settings();
            $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));
        } else {
            $this->add_render_attribute('row', 'class', 'isotope-grid');
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

        if ($this->get_settings('show_filter_bar')) {
            $this->render_filter_menu($settings['categories']);
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('row') ?>>
                <?php
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();

                    $item_classes = '__all ';
                    $item_cats = get_the_terms($wp_query->post->ID, 'osf_portfolio_cat');
                    foreach ((array)$item_cats as $item_cat) {
                        if (!empty($item_cats) && !is_wp_error($item_cats)) {
                            $item_classes .= $item_cat->slug . ' ';
                        }
                    }
                    echo '<div class="column-item portfolio-entries ' . esc_attr($item_classes) . '">';
                    get_template_part('template-parts/portfolio/content');
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <?php if ($settings['show_load_more'] && $wp_query->found_posts > $this->get_settings_for_display('posts_per_page')): ?>
            <?php
            $query_args = [
                'orderby'             => $this->get_settings_for_display('orderby'),
                'order'               => $this->get_settings_for_display('order'),
                'ignore_sticky_posts' => 1,
                'post_status'         => 'publish', // Hide drafts/private posts for admins
                'post_type'           => 'osf_portfolio',
                'posts_per_page'      => $this->get_settings_for_display('posts_per_page')
            ];

            if (!empty($this->get_settings_for_display('categories'))) {
                $query_args['tax_query'] = [
                    [
                        'taxonomy' => 'osf_portfolio_cat',
                        'field'    => 'slug',
                        'terms'    => $this->get_settings_for_display('categories'),
                    ]
                ];
            }

            if (is_front_page()) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            } else {
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            }

            $this->add_render_attribute('elementor-button', 'data-settings', wp_json_encode($query_args));
            $this->add_render_attribute('elementor-button', 'data-paged', $paged);
            $this->add_render_attribute('elementor-button', 'class', 'button-primary elementor-button-load-more');
            if (!empty($settings['size'])) {
                $this->add_render_attribute('elementor-button', 'class', 'elementor-size-' . esc_attr($settings['size']));
            }

            ?>
            <div class="elementor-button-wrapper">
                <a href="#" <?php echo $this->get_render_attribute_string('elementor-button'); ?> role="button">
                    <span class="elementor-button-text"><?php echo !empty($settings['text']) ? $settings['text'] : esc_html__('Load more', 'strollik5-core'); ?></span>
                </a>
            </div>

        <?php endif; ?>
        <?php
        wp_reset_postdata();
    }


    protected function render_filter_menu($categories) {
        $terms = [];

        if ($categories && !empty($categories)) {
            foreach ($categories as $category) {
                $term = get_term_by('slug', $category, 'osf_portfolio_cat');

                if ($term->count != 0) {
                    $terms[$term->slug] = $term->name;
                }

                if ($term->parent == 0) {
                    $chirlds = get_term_children($term->term_id, 'osf_portfolio_cat');

                    if (!is_wp_error($chirlds)) {
                        foreach ($chirlds as $chirld) {
                            $category = get_term_by('term_id', $chirld, 'osf_portfolio_cat');
                            $terms[$category->slug] = $category->name;
                        }

                    }
                }
            }
        } else {
            $terms = $this->get_portfolio_categories();
        }

        ?>
        <ul class="elementor-portfolio__filters" data-related="isotope-<?php echo esc_attr($this->get_id()); ?>">
            <li class="elementor-portfolio__filter elementor-active"
                data-filter=".__all"><?php echo __('All', 'strollik5-core'); ?></li>
            <?php foreach ($terms as $key => $term) { ?>
                <li class="elementor-portfolio__filter"
                    data-filter=".<?php echo esc_attr($key); ?>"><?php echo $term; ?></li>
            <?php } ?>
        </ul>
        <?php
    }

    protected function get_portfolio_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'osf_portfolio_cat',
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
}

$widgets_manager->register_widget_type(new OSF_Elementor_Portfolio());