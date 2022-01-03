<?php
class Entrada_Gallery_Posts_Widget extends WP_Widget
{

     public function __construct()
     {
          parent::__construct(
               'entrada_postsgallery_widget',
               __('Entrada Posts Gallery', '_waituk_theme_text_domain'),
               array(
                    'classname'   => 'entrada_postsgallery_widget',
                    'description' => __('Add a posts gallery to your sidebar.', '_waituk_theme_text_domain')
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
          $title         = apply_filters('widget_title', $instance['title']);
          $post_to_show  = $instance['post_to_show'];
          echo $before_widget;
          echo $before_title;
          if ($title) {
               echo $title;
          }
          echo $after_title;
          $args = array(
               'post_type' => 'post',
               'showposts' => 6,
          );

          if (!empty($post_to_show) && is_numeric($post_to_show)) {
               $args['showposts'] = $post_to_show;
          }
          $loop = new WP_Query($args);

          if ($loop->have_posts()) {
               echo '<ul class="side-list gallery-side-list horizontal-list">';
               while ($loop->have_posts()) : $loop->the_post();
                    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                    $image = matthewruddy_image_resize($image_url[0], 57, 57, true, false);
                    if (array_key_exists('url', $image) && $image['url'] != '') {
                         echo '<li><a href="' . get_permalink(get_the_ID()) . '"><img src="' . $image['url'] . '" alt="Image"></a></li>';
                    }
               endwhile;
               echo '</ul>';
               wp_reset_query();
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
          $instance                     = $old_instance;
          $instance['title']            = strip_tags($new_instance['title']);
          $instance['post_to_show']     = $new_instance['post_to_show'];
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
          $post_to_show = isset($instance['post_to_show']) ? $instance['post_to_show'] : ''; ?>
          <p>
               <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title *',  '_waituk_theme_text_domain'); ?></label>
               <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>
          <p>
               <label for="<?php echo $this->get_field_id('post_to_show'); ?>"><?php _e('No.of posts to show :',  '_waituk_theme_text_domain'); ?></label>
               <input class="widefat" id="<?php echo $this->get_field_id('post_to_show'); ?>" name="<?php echo $this->get_field_name('post_to_show'); ?>" type="text" value="<?php esc_attr_e($post_to_show); ?>" />
          </p>
<?php
     }
}

/* Register the widget */
add_action('widgets_init', function () {
     register_widget('Entrada_Gallery_Posts_Widget');
}); ?>