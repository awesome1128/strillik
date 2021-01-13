<?php

class OSF_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {

    public function widget($args, $instance) {
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (!empty($instance['title'])) ? $instance['title'] : __('Recent Posts', 'strollik5-core');

        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number) {
            $number = 5;
        }
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;

        $r = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        ), $instance));

        if (!$r->have_posts()) {
            return;
        }
        ?>
        <?php echo $args['before_widget']; ?>
        <?php
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <ul>
            <?php foreach ($r->posts as $recent_post) : ?>
                <?php
                $post_title = get_the_title($recent_post->ID);
                $title = (!empty($post_title)) ? $post_title : __('(no title)', 'strollik5-core');
                ?>
                <li class="item-recent-post">
                    <?php if (has_post_thumbnail($recent_post->ID)): ?>
                        <div class="thumbnail-post"><?php echo get_the_post_thumbnail($recent_post->ID, 'strollik-thumbnail'); ?></div>
                    <?php endif; ?>
                    <div class="title-post">
                        <a href="<?php the_permalink($recent_post->ID); ?>"><?php echo $title; ?></a>
                        <?php if ($show_date) : ?>
                            <span class="post-date"><?php echo get_the_date('', $recent_post->ID); ?></span>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        echo $args['after_widget'];
    }
}

class OSF_Widget_Property_Related extends WP_Widget {


    public function __construct() {
        $widget_ops = array(
            'classname'                   => 'widget_property_related',
            'description'                 => __('Your site&#8217;s most recent Property.', 'strollik5-core'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('recent-property', __('Recent Apartments', 'strollik5-core'), $widget_ops);
        $this->alt_option_name = 'widget_property_related';
    }


    public function widget($args, $instance) {
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (!empty($instance['title'])) ? $instance['title'] : __('Recent Apartments', 'strollik5-core');

        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number) {
            $number = 5;
        }

        $r = new WP_Query(apply_filters('widget_posts_args', array(
            'post_type'           => 'osf_property',
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        ), $instance));

        if (!$r->have_posts()) {
            return;
        }
        ?>
        <?php echo $args['before_widget']; ?>
        <?php
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <ul>
            <?php foreach ($r->posts as $recent_post) : ?>
                <?php
                $post_title = get_the_title($recent_post->ID);
                $title = (!empty($post_title)) ? $post_title : __('(No title)', 'strollik5-core');
                ?>
                <li class="item-recent-apartments">
                    <?php if (has_post_thumbnail($recent_post->ID)): ?>
                        <div class="thumbnail-apartments"><?php echo get_the_post_thumbnail($recent_post->ID, 'strollik-thumbnail'); ?></div>
                    <?php endif; ?>
                    <div class="apartments-content">
                        <span class="apartments-title"><?php echo $title; ?></span>
                        <a class="apartments-link"
                           href="<?php the_permalink($recent_post->ID); ?>"><?php echo esc_html__('View Details', 'strollik5-core') ?></a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = (int)$new_instance['number'];
        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'strollik5-core'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'strollik5-core'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>"
                   name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1"
                   value="<?php echo $number; ?>" size="3"/></p>
        <?php
    }
}

function osf_widget_registration() {
    register_widget('OSF_WP_Widget_Recent_Posts');
    register_widget('OSF_Widget_Property_Related');
}

add_action('widgets_init', 'osf_widget_registration');