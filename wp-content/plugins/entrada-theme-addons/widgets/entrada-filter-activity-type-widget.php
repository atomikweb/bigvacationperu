<?php
class Entrada_Filter_Activity_Type_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'entrada_activityfilter_widget',
            __('Entrada Activity Type Filter', '_waituk_theme_text_domain'),
            array(
                'classname'   => 'entrada_activityfilter_widget',
                'description' => __('Add a activity type to filter tour on sidebar.', '_waituk_theme_text_domain')
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
        $title      = apply_filters('widget_title', $instance['title']);
        $order_by   = $instance['order_by'];
        $hide_empty = $instance['hide_empty'];

        echo $before_widget;
        echo $before_title;
        if ($title) {
            echo $title;
        }
        echo $after_title;

        $featured_cat_ids = $this->eaddons_product_featured_categories('prod_featured_cat_val');
        $featured_cat_args = array(
            'orderby'        => $order_by,
            'order'            => 'ASC',
            'hide_empty'    => $hide_empty
        );
        $product_cats = get_terms('product_cat', $featured_cat_args);
        if (count($product_cats) > 0) { ?>
            <ul class="side-list horizontal-list hovered-list product-cat">
                <?php
                            foreach ($product_cats as $product_cat) {
                                $term_meta = get_option("taxonomy_" . $product_cat->term_id);
                                if (in_array($product_cat->term_id, $featured_cat_ids)) { ?>
                        <li <?php if (isset($_REQUEST['product_cat']) && $_REQUEST['product_cat'] == $product_cat->slug) {
                                                    echo 'class="active"';
                                                } ?> id="actype_<?php echo $product_cat->slug; ?>">
                            <a href="javascript:void(null);">
                                <span class="<?php echo $term_meta['prod_icomoon_cat_val']; ?>"></span>
                                <span class="popup">
                                    <?php echo $product_cat->name; ?>
                                </span>
                            </a>
                        </li>
                <?php
                                }
                            } ?>
            </ul>
        <?php
                }
                echo $after_widget;
            }

            public function eaddons_product_featured_categories($taxonomy_field = '')
            {
                global $wpdb;
                $include_taxonomy = array();
                $product_cats = get_terms('product_cat', 'hide_empty=0');

                foreach ($product_cats as $product_cat) {
                    $term_meta = get_option("taxonomy_" . $product_cat->term_id);
                    if (isset($term_meta[$taxonomy_field]) && $term_meta[$taxonomy_field] != '') {
                        $include_taxonomy[] = $product_cat->term_id;
                    }
                }
                return $include_taxonomy;
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
                $title        = isset($instance['title']) ? esc_attr($instance['title']) : '';
                $order_by     = isset($instance['order_by']) ? esc_attr($instance['order_by']) : '';
                $hide_empty   = isset($instance['hide_empty']) ? esc_attr($instance['hide_empty']) : ''; ?>
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
    register_widget('Entrada_Filter_Activity_Type_Widget');
}); ?>