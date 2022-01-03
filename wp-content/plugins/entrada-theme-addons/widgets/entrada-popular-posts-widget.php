<?php
class Entrada_Popular_Posts_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'entrada_popularposts_widget',
            __('Entrada Popular Posts', '_waituk_theme_text_domain'),
            array(
                'classname'   => 'entrada_popularposts_widget',
                'description' => __('Add a popular posts to your sidebar.', '_waituk_theme_text_domain')
            )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        global $wpdb;
        extract($args);
        $title              = apply_filters('widget_title', $instance['title']);
        $display_post_date  = $instance['display_post_date'];
        $post_to_show       = $instance['post_to_show'];
        echo $before_widget;
        echo $before_title;
        if ($title) {
            echo $title;
        }
        echo $after_title;
        $sql = "SELECT id, post_title, post_date, comment_count FROM {$wpdb->prefix}posts WHERE post_type='post' and post_status = 'publish' ORDER BY comment_count DESC";
        if (!empty($post_to_show) && is_numeric($post_to_show)) {
            $sql .= " LIMIT 0, " . $post_to_show;
        } else {
            $sql .= " LIMIT 0, 3";
        }
        $result_ = $wpdb->get_results($sql);
        if ($result_) {
            echo '<ul class="side-list post-list hovered-list">';
            foreach ($result_ as $post) {
                echo '<li><a href="' . get_permalink($post->id) . '">';
                if (isset($display_post_date) && $display_post_date == 1) {
                    echo '<time datetime="' . date('Y-m-d', strtotime($post->post_date)) . '">' . date('jS F Y', strtotime($post->post_date)) . '</time>';
                }
                echo '<span class="text-block">' . $post->post_title . '</span></a></li>';
            }
            echo '</ul>';
        }
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title']              = strip_tags($new_instance['title']);
        $instance['display_post_date']  = $new_instance['display_post_date'];
        $instance['post_to_show']       = $new_instance['post_to_show'];
        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $title                = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $display_post_date    = isset($instance['display_post_date']) ? esc_attr($instance['display_post_date']) : '';
        $post_to_show         = isset($instance['post_to_show']) ? esc_attr($instance['post_to_show']) : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title *', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('display_post_date'); ?>" name="<?php echo $this->get_field_name('display_post_date'); ?>" value="1" type="checkbox" <?php if (isset($display_post_date) && $display_post_date == '1') {
                                                                                                                                                                                        echo 'checked="checked"';
                                                                                                                                                                                    } ?>> <label for="<?php echo $this->get_field_id('display_post_date'); ?>"><?php _e('Display Post Date?', '_waituk_theme_text_domain'); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_to_show'); ?>"><?php _e('No.of posts to show :', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('post_to_show'); ?>" name="<?php echo $this->get_field_name('post_to_show'); ?>" type="text" value="<?php esc_attr_e($post_to_show); ?>" />
        </p>
<?php
    }
}

/* Register the widget */
add_action('widgets_init', function () {
    register_widget('Entrada_Popular_Posts_Widget');
});
?>