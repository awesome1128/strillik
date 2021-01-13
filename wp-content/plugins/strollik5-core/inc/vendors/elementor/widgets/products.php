<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!osf_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Products extends OSF_Elementor_Carousel_Base {


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
        return 'opal-products';
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
        return __('Opal Products', 'strollik5-core');
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
        return 'eicon-product-categories';
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
            'limit',
            [
                'label'   => __('Posts Per Page', 'strollik5-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => __('columns', 'strollik5-core'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
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
            'orderby',
            [
                'label'   => __('Order By', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'       => __('Date', 'strollik5-core'),
                    'id'         => __('Post ID', 'strollik5-core'),
                    'menu_order' => __('Menu Order', 'strollik5-core'),
                    'popularity' => __('Number of purchases', 'strollik5-core'),
                    'rating'     => __('Average Product Rating', 'strollik5-core'),
                    'title'      => __('Product Title', 'strollik5-core'),
                    'rand'       => __('Random', 'strollik5-core'),
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

        $this->add_control(
            'categories',
            [
                'label'    => __('Categories', 'strollik5-core'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_product_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label'     => __('Category Operator', 'strollik5-core'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => __('AND', 'strollik5-core'),
                    'IN'     => __('IN', 'strollik5-core'),
                    'NOT IN' => __('NOT IN', 'strollik5-core'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_control(
            'tags',
            [
                'label'    => __('Tags', 'strollik5-core'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_product_tags(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'product_type',
            [
                'label'   => __('Product Type', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'newest',
                'options' => [
                    'newest'       => __('Newest Products', 'strollik5-core'),
                    'on_sale'      => __('On Sale Products', 'strollik5-core'),
                    'best_selling' => __('Best Selling', 'strollik5-core'),
                    'top_rated'    => __('Top Rated', 'strollik5-core'),
                    'featured'     => __('Featured Product', 'strollik5-core'),
                ],
            ]
        );

        $this->add_control(
            'paginate',
            [
                'label'   => __('Paginate', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'       => __('None', 'strollik5-core'),
                    'pagination' => __('Pagination', 'strollik5-core'),
                ],
            ]
        );

        $this->add_control(
            'product_layout',
            [
                'label'   => __('Product Layout', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => __('Grid', 'strollik5-core'),
                    'list' => __('List', 'strollik5-core'),
                ],
            ]
        );

        $this->add_control(
            'list_layout',
            [
                'label'   => __('List Layout', 'strollik5-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Style 1', 'strollik5-core'),
                    '2' => __('Style 2', 'strollik5-core'),
                ],
                'prefix_class' => 'elementor-product-list-style-',
                'condition' => [
                    'product_layout' => 'list'
                ]
            ]
        );

        $this->add_control(
            'show_border',
            [
                'label'   => __('Show Border', 'strollik5-core'),
                'type'    => Controls_Manager::SWITCHER,
                'condition' => [
                    'product_layout' => 'list',
                    'list_layout'   => '2'
                ],
                'return_value' => 'style',
                'prefix_class' => 'elementor-product-list-border-'
            ]
        );

        $this->add_responsive_control(
            'product_gutter',
            [
                'label'      => __('Gutter', 'strollik5-core'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} ul.products li.product' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} ul.products'            => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->end_controls_section();
        // End Section Query

        // Carousel Option
        $this->add_control_carousel();
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

    protected function get_product_tags(){
        $tags = get_terms(array(
                'taxonomy'   => 'product_tag',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $results[$tag->slug] = $tag->name;
            }
        }

        return $results;
    }

    protected function get_product_type($atts, $product_type) {
        switch ($product_type) {
            case 'featured':
                $atts['visibility'] = "featured";
                break;

            case 'on_sale':
                $atts['on_sale'] = true;
                break;

            case 'best_selling':
                $atts['best_selling'] = true;
                break;

            case 'top_rated':
                $atts['top_rated'] = true;
                break;

            default:
                break;
        }

        return $atts;
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
        $this->woocommerce_default($settings);
    }

    private function woocommerce_default($settings) {
        $type = 'products';
        $atts = [
            'limit'          => $settings['limit'],
            'columns'        => $settings['column'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'product_layout' => $settings['product_layout'],
        ];

//        if(!empty($settings['show_rating']) && $settings['show_rating'] == 'yes') {
//            $atts['show_rating'] = true;
//        }

        if($settings['product_layout'] =='list') {
            $atts['show_rating'] = true;
        }

        if(!empty($settings['list_layout']) && $settings['list_layout'] == '2') {
            $atts['show_category'] = true;
            $atts['show_rating'] = true;
            $atts['show_except'] = true;
            $atts['show_time_sale'] = true;
        }

        $atts = $this->get_product_type($atts, $settings['product_type']);
        if (isset($atts['on_sale']) && wc_string_to_bool($atts['on_sale'])) {
            $type = 'sale_products';
        } elseif (isset($atts['best_selling']) && wc_string_to_bool($atts['best_selling'])) {
            $type = 'best_selling_products';
        } elseif (isset($atts['top_rated']) && wc_string_to_bool($atts['top_rated'])) {
            $type = 'top_rated_products';
        }

        if (!empty($settings['categories'])) {
            $atts['category'] = implode(',', $settings['categories']);
            $atts['cat_operator'] = $settings['cat_operator'];
        }

        if (!empty($settings['tags'])) {
            $atts['tag'] = implode(',', $settings['tags']);
        }

        // Carousel
        if ($settings['enable_carousel'] === 'yes') {
            $atts['carousel_settings'] = json_encode(wp_slash($this->get_carousel_settings()));
            $atts['product_layout'] = 'carousel';
            if($settings['product_layout'] =='list') {
                $atts['product_layout'] = 'list-carousel';
                $atts['show_rating'] = true;
                $atts['class'] = 'woocommerce-product-list';
                if(!empty($settings['list_layout']) && $settings['list_layout'] == '2') {
                    $atts['show_category'] = true;
                    $atts['show_rating'] = true;
                    $atts['show_except'] = true;
                    $atts['show_time_sale'] = true;
                }
            }
        }else {
            $atts['class'] = '';

            if (!empty($settings['column_tablet'])) {
                $atts['class'] .= ' columns-tablet-'.$settings['column_tablet'];
            }

            if (!empty($settings['column_mobile'])) {
                $atts['class'] .= ' columns-mobile-'.$settings['column_mobile'];
            }
        }

        if ($settings['paginate'] === 'pagination') {
            $atts['paginate'] = 'true';
        }

        $shortcode = new WC_Shortcode_Products($atts, $type);

        echo $shortcode->get_content();
    }
}

$widgets_manager->register_widget_type(new OSF_Elementor_Products());