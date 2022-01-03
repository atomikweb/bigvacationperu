<?php
class Entrada_Footer_Contact_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'entrada_footercontact_widget',
            __('Entrada Footer Contact', '_waituk_theme_text_domain'),
            array(
                'classname'   => 'entrada_footercontact_widget',
                'description' => __('Entrada footer contact widget.', '_waituk_theme_text_domain')
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
        $rendor_widget = '';
        extract($args);
        $title            = apply_filters('widget_title', $instance['title']);
        $entrada_phone    = $instance['entrada_phone'];
        $entrada_fax      = $instance['entrada_fax'];
        $entrada_email    = $instance['entrada_email'];
        $entrada_address  = $instance['entrada_address'];
        $rendor_widget .= $before_widget;
        if ($title) {
            $rendor_widget .= $before_title . $title . $after_title;
        }
        $rendor_widget .= '<ul class="menu address-block">';
        if ($entrada_phone) {
            $entrada_phone_filtered = preg_replace('/[^0-9]/', '', $entrada_phone);
            $rendor_widget .= '<li class="wrap-text"><span class="icon-tel"></span> <a href="tel:' . $entrada_phone_filtered . '">' . $entrada_phone . '</a></li>';
        }
        if ($entrada_fax) {
            $rendor_widget .= '<li class="wrap-text"><span class="icon-fax"></span>' . $entrada_fax . '</li>';
        }
        if ($entrada_email) {
            $rendor_widget .= '<li class="wrap-text"><span class="icon-email"></span> <a href="mailto:' . $entrada_email . '">' . $entrada_email . '</a></li>';
        }
        if ($entrada_address) {
            $rendor_widget .= '<li><span class="icon-home"></span> <address>' . $entrada_address . '</address></li>';
        }
        $rendor_widget .= '</ul>';
        $rendor_widget .= $after_widget;

        _e($rendor_widget, '_waituk_theme_text_domain');
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
        $instance                     = $old_instance;
        $instance['title']            = strip_tags($new_instance['title']);
        $instance['entrada_phone']    = strip_tags($new_instance['entrada_phone']);
        $instance['entrada_fax']      = strip_tags($new_instance['entrada_fax']);
        $instance['entrada_email']    = strip_tags($new_instance['entrada_email']);
        $instance['entrada_address']  = strip_tags($new_instance['entrada_address']);
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

        $title            = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $entrada_phone    = isset($instance['entrada_phone']) ? esc_attr($instance['entrada_phone']) : '';
        $entrada_fax      = isset($instance['entrada_fax']) ? esc_attr($instance['entrada_fax']) : '';
        $entrada_email    = isset($instance['entrada_email']) ? esc_attr($instance['entrada_email']) : '';
        $entrada_address  = isset($instance['entrada_address']) ? esc_attr($instance['entrada_address']) : ''; ?>
        <p>
            <label for="<?php esc_attr_e($this->get_field_id('title'), '_waituk_theme_text_domain'); ?>"><?php _e('Title *', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php esc_attr_e($this->get_field_id('title'), '_waituk_theme_text_domain'); ?>" name="<?php esc_attr_e($this->get_field_name('title'), '_waituk_theme_text_domain'); ?>" type="text" value="<?php esc_attr_e($title, '_waituk_theme_text_domain'); ?>" />
        </p>
        <p>
            <label for="<?php esc_attr_e($this->get_field_id('entrada_phone'), '_waituk_theme_text_domain'); ?>"><?php _e('Phone', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php esc_attr_e($this->get_field_id('entrada_phone'), '_waituk_theme_text_domain');  ?>" name="<?php esc_attr_e($this->get_field_name('entrada_phone'), '_waituk_theme_text_domain'); ?>" type="text" value="<?php esc_attr_e($entrada_phone, '_waituk_theme_text_domain'); ?>" />
        </p>
        <p>
            <label for="<?php esc_attr_e($this->get_field_id('entrada_fax'), '_waituk_theme_text_domain'); ?>"><?php _e('Fax', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php esc_attr_e($this->get_field_id('entrada_fax'), '_waituk_theme_text_domain'); ?>" name="<?php esc_attr_e($this->get_field_name('entrada_fax'), '_waituk_theme_text_domain'); ?>" type="text" value="<?php esc_attr_e($entrada_fax, '_waituk_theme_text_domain'); ?>" />
        </p>
        <p>
            <label for="<?php esc_attr_e($this->get_field_id('entrada_email'), '_waituk_theme_text_domain'); ?>"><?php _e('Email', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php esc_attr_e($this->get_field_id('entrada_email'), '_waituk_theme_text_domain'); ?>" name="<?php esc_attr_e($this->get_field_name('entrada_email'), '_waituk_theme_text_domain'); ?>" type="text" value="<?php esc_attr_e($entrada_email, '_waituk_theme_text_domain'); ?>" />
        </p>
        <p>
            <label for="<?php esc_attr_e($this->get_field_id('entrada_address'), '_waituk_theme_text_domain');  ?>"><?php _e('Address', '_waituk_theme_text_domain'); ?></label>
            <textarea class="widefat" rows="4" cols="20" id="<?php esc_attr_e($this->get_field_id('entrada_address'), '_waituk_theme_text_domain'); ?>" name="<?php esc_attr_e($this->get_field_name('entrada_address'), '_waituk_theme_text_domain'); ?>"><?php _e($entrada_address, '_waituk_theme_text_domain'); ?></textarea>
        </p>
<?php
    }
}

/* Register the widget */
add_action('widgets_init', function () {
    register_widget('Entrada_Footer_Contact_Widget');
});
?>