<?php
class Entrada_Poll_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'entrada_poll_widget',
            __( 'Entrada Poll', '_waituk_theme_text_domain' ),
            array(
                'classname'   => 'entrada_poll_widget',
                'description' => __( 'Add poll to your sidebar.', '_waituk_theme_text_domain' )
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
        global $wpdb;
        extract( $args );
        $title 			= apply_filters( 'widget_title', $instance['title'] );
		$poll_id 		= $instance['poll_id'];
		$question_id 	= 0;
		$question_id 	= $poll_id;

		if( isset( $poll_id ) && is_numeric( $poll_id) ) {
			$sql 			= "select * from ".$wpdb->prefix."polls where id='".$poll_id ."'";
			$result_seelct 	= $wpdb->get_row($sql);
			if($result_seelct) {
				$poll_question 	= $result_seelct->poll_question;
				$poll_options 	= explode('%%', $result_seelct->poll_options );
			}
		}

        echo $before_widget;
		echo $before_title;
        if ( $title ) {
           echo $title;
        }
		echo $after_title;
		echo '<div id="poll_message_box"></div>';
		if( isset( $poll_question ) ) {
			echo '<strong class="title">'.$poll_question.'</strong>';
		}
		if( isset( $poll_options ) ){
			echo '<div id="poll_result_wrapper"><input type="hidden" id="question_id" value="'.$question_id.'"><ul class="side-list check-list">';
			$cnt = 0;
			foreach($poll_options as $opt){
				$cnt++ ;
				echo '<li><label for="check'.$cnt.'" class="custom-radio-sq"><input id="check'.$cnt.'" name="poll_answer" value="'.$cnt.'" type="radio">';
				echo '<span class="check-input"></span><span class="check-label">'.$opt.'</span>';
				echo '</label></li>';
			}
			echo '</ul><strong class="sub-link"><a href="javascript:void(null);" onClick="entrada_vote();">VOTE</a></strong></div>';
		}
        echo $after_widget;  ?>
        <script>
		function entrada_vote(){
			var question_id = jQuery('#question_id').val();
			var poll_answer = jQuery("input:radio[name ='poll_answer']:checked").val();
			if (poll_answer === undefined || poll_answer === null) {
				jQuery('#poll_message_box').addClass('alert alert-warning');
				jQuery('#poll_message_box').html('<ul><p><strong>ERROR : </strong> </p><li>Please select an answer.</li></ul>');
				} else {
					jQuery.ajax({
						type 	: "POST",
						dataType: "json",
						url 	: "<?php echo admin_url( 'admin-ajax.php' );?>",
						data 	: {
									'action' 		: 'entrada_vote_now',
									'question_id' 	: question_id,
									'poll_answer' 	: poll_answer
						},
						success : function(data){
							if(data.response == 'success') {
								jQuery('#poll_message_box').addClass('alert alert-success');
								jQuery('#poll_result_wrapper').html(data.poll_result);
							}
							else {
								jQuery('#poll_message_box').addClass('alert alert-warning');
							}
							jQuery('#poll_message_box').html(data.message);
							return false;
						}
					});
					return false;
				}
		}
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
    public function update( $new_instance, $old_instance ) {
        global $wpdb;
		$instance 				= $old_instance;
        $instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['poll_id'] 	= $new_instance['poll_id'];
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
    	global $wpdb;

		$title = isset($instance['title']) ? esc_attr( $instance['title'] ) : '';
		$poll_id = isset($instance['poll_id']) ?  $instance['poll_id']  : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title *', '_waituk_theme_text_domain' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('poll_id'); ?>"><?php _e( 'Select Poll', '_waituk_theme_text_domain' ); ?></label>
         	<select  id="<?php echo $this->get_field_id('poll_id'); ?>" name="<?php echo $this->get_field_name('poll_id'); ?>">
				<option value="0"> Select Poll </option>
			<?php
				$result = $wpdb->get_results("select * from ".$wpdb->prefix."polls WHERE 1= 1 order by id DESC ");
				if( $result ) {
					foreach( $result as $entry ) {
						echo '<option value="'. $entry->id. '"';
						if( $poll_id == $entry->id ){
							echo ' selected="selected"';
						}
						echo '>' . wp_trim_words( stripslashes($entry->poll_question), 5, ' ...' ).'</option>';
					}
				} ?>
			</select>
        </p>
<?php
    }
}
/* Register the widget */
add_action( 'widgets_init', function(){
    register_widget( 'Entrada_Poll_Widget' );
}); ?>