<?php
class Entrada_Taxonomy_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'entrada_taxonomy_widget',
            __('Entrada Tag Cloud', '_waituk_theme_text_domain'),
            array(
                'classname'   => 'entrada_taxonomy_widget',
                'description' => __('Add a taxonomy to your sidebar.', '_waituk_theme_text_domain')
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
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        echo $before_title;
        if ($title) {
            echo $title;
        }
        echo $after_title;
        $tags = get_tags();
        if ($tags) {
            echo '<ul class="side-list horizontal-list hovered-list">';
            foreach ($tags as $tag) {
                $icomoon_class = entrada_icomoon_class($tag->slug);
                if (!empty($icomoon_class)) :
                    echo '<li><a href="' . get_tag_link($tag->term_id) . '"><span class="' . $icomoon_class . '"></span><span class="popup">' . $tag->name . '</span></a></li>';
                endif;
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
        $instance           = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
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

        $title = isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title *', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php esc_attr_e($title); ?>" />
        </p>
<?php
    }
}

/* Register the widget */
add_action('widgets_init', function () {
    register_widget('Entrada_Taxonomy_Widget');
}); ?>