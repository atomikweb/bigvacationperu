<?php
class Entrada_Filter_Activity_Level_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'entrada_activitylevelfilter_widget',
            __('Entrada Activity Level Filter', '_waituk_theme_text_domain'),
            array(
                'classname'   => 'entrada_activitylevelfilter_widget',
                'description' => __('Add a activity level to filter tour on sidebar.', '_waituk_theme_text_domain')
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

        $activity_levels_array = array();

        $title      = apply_filters('widget_title', $instance['title']);
        $order_by   = $instance['order_by'];
        $hide_empty = $instance['hide_empty'];

        echo $before_widget;
        echo $before_title;
        if ($title) {
            echo $title;
        }
        echo $after_title;

        $featured_cat_args = array(
            'orderby'        => $order_by,
            'order'            => 'ASC',
            'hide_empty'    => $hide_empty,
        );

        $activity_levels = get_terms('activity_level', $featured_cat_args);

        if (!empty($activity_levels) && !is_wp_error($activity_levels)) {
            foreach ($activity_levels as $activity_level) {
                $term_meta = get_option("taxonomy_" . $activity_level->term_id);
                $taxonomy_value = esc_attr($term_meta['activity_level_val']);
                $activity_levels_array[$taxonomy_value]    = array(
                    'name'         => $activity_level->name,
                    'slug'         => $activity_level->slug,
                    'term_id'     => $activity_level->term_id,
                );
            }
        }
        ksort($activity_levels_array);
        if (isset($activity_levels_array) && count($activity_levels_array) > 0) { ?>
            <ul class="side-list horizontal-list hovered-list activity-level">
                <?php foreach ($activity_levels_array as $key => $val) { ?>
                    <li id="aclevel_<?php echo $val['slug']; ?>">
                        <a href="javascript:void(null);">
                            <span class="icon-level<?php esc_attr_e($key); ?>"></span>
                            <span class="popup">
                                <?php echo $val['name']; ?>
                            </span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php
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
                $instance               = $old_instance;
                $instance['title']      = strip_tags($new_instance['title']);
                $instance['order_by']   = $new_instance['order_by'];
                $instance['hide_empty'] = $new_instance['hide_empty'];
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
                $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
                $order_by = isset($instance['order_by']) ? esc_attr($instance['order_by']) : '';
                $hide_empty = isset($instance['hide_empty']) ? esc_attr($instance['hide_empty']) : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title *', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>" value="1" type="checkbox" <?php if (isset($hide_empty) && $hide_empty == '1') {
                                                                                                                                                                            echo 'checked="checked"';
                                                                                                                                                                        } ?>>
            <label for="<?php echo $this->get_field_id('hide_empty'); ?>"><?php _e('Hide Empty', '_waituk_theme_text_domain'); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order_by'); ?>"><?php _e('Order by :', '_waituk_theme_text_domain'); ?></label>
            <select id="<?php echo $this->get_field_id('order_by'); ?>" name="<?php echo $this->get_field_name('order_by'); ?>">
                <option value="name" <?php if (isset($order_by) && $order_by == 'name') {
                                                    echo ' selected="selected"';
                                                } ?>> Name </option>
                <option value="id" <?php if (isset($order_by) && $order_by == 'id') {
                                                echo ' selected="selected"';
                                            } ?>> Id </option>
                <option value="slug" <?php if (isset($order_by) && $order_by == 'slug') {
                                                    echo ' selected="selected"';
                                                } ?>> Slug </option>
            </select>
        </p>
<?php
    }
}
/* Register the widget */
add_action('widgets_init', function () {
    register_widget('Entrada_Filter_Activity_Level_Widget');
}); ?>