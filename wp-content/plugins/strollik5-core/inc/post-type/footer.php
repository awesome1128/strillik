<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Footer
 */
class OSF_Custom_Post_Type_Footer extends OSF_Custom_Post_Type_Abstract
{

    /**
     * @return void
     */
    public function create_post_type()
    {

        $labels = array(
            'name'               => __('Footer', "strollik5-core"),
            'singular_name'      => __('Footer', "strollik5-core"),
            'add_new'            => __('Add New Footer', "strollik5-core"),
            'add_new_item'       => __('Add New Footer', "strollik5-core"),
            'edit_item'          => __('Edit Footer', "strollik5-core"),
            'new_item'           => __('New Footer', "strollik5-core"),
            'view_item'          => __('View Footer', "strollik5-core"),
            'search_items'       => __('Search Footers', "strollik5-core"),
            'not_found'          => __('No Footers found', "strollik5-core"),
            'not_found_in_trash' => __('No Footers found in Trash', "strollik5-core"),
            'parent_item_colon'  => __('Parent Footer:', "strollik5-core"),
            'menu_name'          => __('Footer Builder', "strollik5-core"),
        );

        $args = array(
            'labels'              => $labels,
            'hierarchical'        => true,
            'description'         => __('List Footer', "strollik5-core"),
            'supports'            => array('title', 'editor', 'thumbnail'), //page-attributes, post-formats
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => $this->get_icon(__FILE__),
            'show_in_nav_menus'   => false,
            'publicly_queryable'  => true,
            'exclude_from_search' => true,
            'has_archive'         => true,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => true,
            'capability_type'     => 'post'
        );
        register_post_type('footer', $args);
    }


}

new OSF_Custom_Post_Type_Footer;