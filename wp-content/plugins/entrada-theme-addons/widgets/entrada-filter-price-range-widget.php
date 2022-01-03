<?php
class Entrada_Filter_Price_Range_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'entrada_pricerangefilter_widget',
            __('Entrada Price Range Filter', '_waituk_theme_text_domain'),
            array(
                'classname'   => 'entrada_pricerangefilter_widget',
                'description' => __('Add a price range slider to filter tour on sidebar.', '_waituk_theme_text_domain')
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
        $title                = apply_filters('widget_title', $instance['title']);
        $range_min            = 0;
        $range_max            = $instance['range'];
        $range_selector       = $range_min . ', ' . $range_max;
        $currency_symbol      = get_woocommerce_currency_symbol();
        echo $before_widget;
        echo $before_title;
        if ($title) {
            echo $title;
        }
        echo $after_title;

        if (isset($_REQUEST['price_range']) && $_REQUEST['price_range'] != '') {
            if (preg_match('/-/', $_REQUEST['price_range'])) {
                $search_range_arr = explode('-', $_REQUEST['price_range']);
                if ((count($search_range_arr) == 2) && (is_numeric($search_range_arr[0]) && is_numeric($search_range_arr[1]))) {
                    $range_selector = $search_range_arr[0] . ', ' . $search_range_arr[1];
                }
            }
        } ?>
        <div id="slider-range"></div>
        <input type="text" id="amount" readonly class="price-input">
        <div id="ammount" class="price-input"></div>
        <input class="btn btn-default filter_price_range" type="button" value="<?php esc_attr_e('Filter', '_waituk_theme_text_domain'); ?>">
        <input id="currency_symbol" type="hidden" value="<?php esc_attr_e($currency_symbol); ?>">
        <input id="filter_range_slider" type="hidden" value="">
        <?php echo $after_widget; ?>
        <script>
            // Jquery UI range slider
            jQuery(document).ready(function() {
                var currency_symbol = jQuery('#currency_symbol').val();
                var $sliderRange = jQuery('#slider-range');
                var $amount = jQuery('#amount');
                var $filter_range_slider = jQuery('#filter_range_slider');
                if ($sliderRange.length) {
                    $sliderRange.slider({
                        range: true,
                        values: [<?php echo $range_selector; ?>],
                        max: <?php echo $range_max; ?>,
                        slide: function(event, ui) {
                            $amount.val(currency_symbol + ui.values[0] + ' - ' + currency_symbol + ui.values[1]);
                            $filter_range_slider.val(ui.values[0] + ' - ' + ui.values[1]);
                        }
                    });
                    $amount.val(currency_symbol + $sliderRange.slider('values', 0) + ' - ' + currency_symbol + $sliderRange.slider('values', 1));
                    $filter_range_slider.val($sliderRange.slider('values', 0) + ' - ' + $sliderRange.slider('values', 1));
                }
            });
        </script>
    <?php
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
            $instance          = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['range'] = strip_tags($new_instance['range']);
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
            $title         = isset($instance['title']) ? esc_attr($instance['title']) : '';
            $range         = isset($instance['range']) ? esc_attr($instance['range']) : '';
            $default_range = isset($instance['default_range']) ? esc_attr($instance['default_range']) : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title *', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php esc_attr_e($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('range'); ?>"><?php _e('Max. range value *', '_waituk_theme_text_domain'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('range'); ?>" name="<?php echo $this->get_field_name('range'); ?>" type="text" value="<?php esc_attr_e($range); ?>" />
            <span class="howto"> <?php _e('Please add max. range value here (E. g. 3000).', '_waituk_theme_text_domain'); ?></span>
        </p>

<?php
    }
}
/* Register the widget */
add_action('widgets_init', function () {
    register_widget('Entrada_Filter_Price_Range_Widget');
}); ?>