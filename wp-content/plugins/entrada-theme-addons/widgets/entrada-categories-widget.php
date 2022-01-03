<?php
class Entrada_Categories_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'entrada_categories_widget',
            __( 'Entrada Categories', '_waituk_theme_text_domain' ),
            array(
                'classname'   => 'entrada_categories_widget',
                'description' => __( 'Add a blog categories to your sidebar.', '_waituk_theme_text_domain' )
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
    public function widget( $args, $instance ) {
        extract( $args );
        $title                     = apply_filters( 'widget_title', $instance['title'] );
        $entrada_cat_show_count    = $instance['entrada_cat_show_count'];
		$entrada_cat_hide_empty    = $instance['entrada_cat_hide_empty'];

        echo $before_widget;
		echo $before_title;
        if ( $title ) {
           echo $title;
        }
		echo $after_title;

		$args = array(
				'type'      => 'post',
				'orderby'   => 'name',
				'order'     => 'ASC',
				'taxonomy'  => 'category'
		);
		if(!empty($entrada_cat_hide_empty) && $entrada_cat_hide_empty == 1){
			$args['hide_empty'] = 1;
		}
		$categories = get_categories( $args );
		if($categories){
			echo '<ul class="side-list category-side-list hovered-list">';
				foreach($categories as $category) {
					echo '<li><a href="'.get_category_link( $category->term_id ) .'"><span class="text">'.$category->name.'</span>';
					if(!empty($entrada_cat_show_count) && $entrada_cat_show_count == 1){
						echo '<span class="count">'.$category->count.'</span>';
                    }
					echo '</a></li>';
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
    public function update( $new_instance, $old_instance ) {
        $instance                           = $old_instance;
        $instance['title']                  = strip_tags( $new_instance['title'] );
		$instance['entrada_cat_show_count'] = $new_instance['entrada_cat_show_count'];
        $instance['entrada_cat_hide_empty'] = $new_instance['entrada_cat_hide_empty'];
        return $instance;
    }

    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {
    	$title                  = isset($instance['title']) ? esc_attr( $instance['title'] ) : '';
		$entrada_cat_show_count = isset($instance['entrada_cat_show_count']) ? $instance['entrada_cat_show_count'] : '';
		$entrada_cat_hide_empty = isset($instance['entrada_cat_hide_empty']) ? $instance['entrada_cat_hide_empty'] : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title *', '_waituk_theme_text_domain' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('entrada_cat_show_count'); ?>" name="<?php echo $this->get_field_name('entrada_cat_show_count'); ?>" value="1" type="checkbox" <?php if(isset( $entrada_cat_show_count ) && $entrada_cat_show_count == '1') { echo 'checked="checked"';}?>>   <label for="<?php echo $this->get_field_id('entrada_cat_show_count'); ?>"><?php _e( 'Show Count', '_waituk_theme_text_domain' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('entrada_cat_hide_empty'); ?>" name="<?php echo $this->get_field_name('entrada_cat_hide_empty'); ?>" value="1" type="checkbox" <?php if(isset( $entrada_cat_hide_empty ) && $entrada_cat_hide_empty == '1') { echo 'checked="checked"';}?>>
            <label for="<?php echo $this->get_field_id('entrada_cat_hide_empty'); ?>"><?php _e( 'Hide Empty', '_waituk_theme_text_domain' ); ?></label>
        </p>
<?php
    }
}
/* Register the widget */
add_action( 'widgets_init', function(){
    register_widget( 'Entrada_Categories_Widget' );
}); ?>