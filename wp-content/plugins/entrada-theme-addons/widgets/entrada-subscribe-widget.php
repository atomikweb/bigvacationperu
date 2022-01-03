<?php
class Entrada_Subscribe_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'entrada_subscribe_widget',
			__('Entrada Subscribe Form', '_waituk_theme_text_domain'),
			array(
				'classname'   => 'entrada_subscribe_widget',
				'description' => __('Add subscribe form to your sidebar.', '_waituk_theme_text_domain')
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
		$title 			= apply_filters('widget_title', $instance['title']);
		$first_name 	= $instance['first_name'];
		$last_name 		= $instance['last_name'];
		$phone 			= $instance['phone'];
		$email 			= $instance['email'];
		$address 		= $instance['address'];
		$city 			= $instance['city'];
		$state 			= $instance['state'];
		$active_fields 	= array();
		echo $before_widget;
		echo $before_title;
		if ($title) {
			echo $title;
		}
		echo $after_title;

		if (isset($email) && !empty($email)) {
			echo '<form class="subscribe-form" id="subscribe-form-sidebar">';
			echo '<div id="subscribe_message_box"></div>';
			echo ' <fieldset>';
			if (isset($first_name) && !empty($first_name)) {
				echo '<div class="form-group"><input type="text" class="form-control" id="subscribe_fname" name="subscribe_fname" placeholder="' . $first_name . '"></div>';
				$active_fields[] = 'subscribe_fname';
			}

			if (isset($last_name) && !empty($last_name)) {
				echo '<div class="form-group"><input type="text" class="form-control" id="subscribe_lname" name="subscribe_lname" placeholder="' . $last_name . '"></div>';
				$active_fields[] = 'subscribe_lname';
			}

			if (isset($email) && !empty($email)) {
				echo '<div class="form-group"><input type="text" class="form-control" id="widget_subscribe_email" name="widget_subscribe_email" placeholder="' . $email . '"></div>';
				$active_fields[] = 'widget_subscribe_email';
			}

			if (isset($phone) && !empty($phone)) {
				echo '<div class="form-group"><input type="text" class="form-control" id="subscribe_phone" name="subscribe_phone" placeholder="' . $phone . '"></div>';
				$active_fields[] = 'subscribe_phone';
			}

			if (isset($address) && !empty($address)) {
				echo '<div class="form-group"><input type="text" class="form-control" id="subscribe_address" name="subscribe_address" placeholder="' . $address . '"></div>';
				$active_fields[] = 'subscribe_address';
			}

			if (isset($city) && !empty($city)) {
				echo '<div class="form-group"><input type="text" class="form-control" id="subscribe_city" name="subscribe_city" placeholder="' . $city . '"></div>';
				$active_fields[] = 'subscribe_city';
			}

			if (isset($state) && !empty($state)) {
				echo '<div class="form-group"><input type="text" class="form-control" id="subscribe_state" name="subscribe_state" placeholder="' . $state . '"></div>';
				$active_fields[] = 'subscribe_state';
			}
			echo '<div class="btn-holder"><button type="button" onClick="entrada_subscribe();" class="btn btn-default">' . __('SUBSCRIBE', '_waituk_theme_text_domain') . '</button></div>';
			echo ' </fieldset></form>';

			$comma_seperated_active_fields = implode(", ", $active_fields);
			$comma_seperated_active_fields = str_replace(',', '", "', $comma_seperated_active_fields);
			$active_fields_js_array = '["' . $comma_seperated_active_fields . '"]'; ?>
			<script>
				function entrada_subscribe() {
					var error = '';
					var active_fields = '<?php echo $active_fields_js_array; ?>';

					var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
					jQuery('#subscribe_message_box').removeAttr('class').attr('class', '');

					var subscribe_fname = (jQuery('#subscribe_fname').length) ? jQuery('#subscribe_fname').val() : '';
					var subscribe_lname = (jQuery('#subscribe_lname').length) ? jQuery('#subscribe_lname').val() : '';
					var widget_subscribe_email = (jQuery('#widget_subscribe_email').length) ? jQuery('#widget_subscribe_email').val() : '';
					var subscribe_phone = (jQuery('#subscribe_phone').length) ? jQuery('#subscribe_phone').val() : '';
					var subscribe_address = (jQuery('#subscribe_address').length) ? jQuery('#subscribe_address').val() : '';
					var subscribe_city = (jQuery('#subscribe_city').length) ? jQuery('#subscribe_city').val() : '';
					var subscribe_state = (jQuery('#subscribe_state').length) ? jQuery('#subscribe_state').val() : '';

					if (active_fields.indexOf("subscribe_fname") > -1) {
						if (subscribe_fname == "" || subscribe_fname == "<?php echo $first_name; ?>") {
							error += '<li><?php echo $first_name; ?> is Empty.</li>';
						}
					}

					if (active_fields.indexOf("subscribe_lname") > -1) {
						if (subscribe_lname == "" || subscribe_lname == "<?php echo $last_name; ?>") {
							error += '<li><?php echo $last_name; ?> is Empty.</li>';
						}
					}

					if (active_fields.indexOf("widget_subscribe_email") > -1) {
						if (widget_subscribe_email == "" || widget_subscribe_email == "<?php echo $email; ?>") {
							error += '<li><?php echo $email; ?> is Empty.</li>';
						}

						if (reg.test(widget_subscribe_email) == false) {
							error += '<li>Valid <?php echo $email; ?> must be filled.</li>';
						}
					}

					if (active_fields.indexOf("subscribe_phone") > -1) {
						if (subscribe_phone == "" || subscribe_phone == "<?php echo $phone; ?>") {
							error += '<li><?php echo $phone; ?> is Empty.</li>';
						}
					}

					if (active_fields.indexOf("subscribe_address") > -1) {
						if (subscribe_address == "" || subscribe_address == "<?php echo $address; ?>") {
							error += '<li><?php echo $address; ?> is Empty.</li>';
						}
					}

					if (active_fields.indexOf("subscribe_city") > -1) {
						if (subscribe_city == "" || subscribe_city == "<?php echo $city; ?>") {
							error += '<li><?php echo $city; ?> is Empty.</li>';
						}
					}

					if (active_fields.indexOf("subscribe_state") > -1) {
						if (subscribe_state == "" || subscribe_state == "<?php echo $state; ?>") {
							error += '<li><?php echo $state; ?> is Empty.</li>';
						}
					}

					if (error == '') {
						jQuery('#subscribe_message_box').addClass('alert alert-warning');
						jQuery('#subscribe_message_box').html('Processing...');

						jQuery.ajax({
							type: "POST",
							dataType: "json",
							url: "<?php echo admin_url('admin-ajax.php'); ?>",
							data: {
								'action': 'entrada_subscribe_mailchimp',
								'subscribe_fname': subscribe_fname,
								'subscribe_lname': subscribe_lname,
								'subscribe_email': widget_subscribe_email,
								'subscribe_phone': subscribe_phone,
								'subscribe_address': subscribe_address,
								'subscribe_city': subscribe_city,
								'subscribe_state': subscribe_state
							},
							success: function(data) {
								if (data.response == 'success') {
									jQuery('#subscribe_message_box').addClass('alert alert-success');
								} else {
									jQuery('#subscribe_message_box').addClass('alert alert-warning');
								}
								jQuery('#subscribe_message_box').html(data.message);
								jQuery('#subscribe-form-sidebar')[0].reset();
								return false;
							}
						});

					} else {
						error = '<ul><p><strong>ERROR : </strong> </p>' + error + '</ul>';
						jQuery('#subscribe_message_box').addClass('alert alert-warning');
						jQuery('#subscribe_message_box').html(error);
						return false;
					}
				}
			</script>
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
				$instance 				= $old_instance;
				$instance['title'] 		= strip_tags($new_instance['title']);
				$instance['first_name'] = $new_instance['first_name'];
				$instance['last_name'] 	= $new_instance['last_name'];
				$instance['phone'] 		= $new_instance['phone'];
				$instance['email'] 		= $new_instance['email'];
				$instance['address'] 	= $new_instance['address'];
				$instance['city'] 		= $new_instance['city'];
				$instance['state']		= $new_instance['state'];
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
				$title 		= isset($instance['title']) ? esc_attr($instance['title']) : '';
				$first_name = isset($instance['first_name']) ? esc_attr($instance['first_name']) : '';
				$last_name 	= isset($instance['last_name']) ? esc_attr($instance['last_name']) : '';
				$phone 		= isset($instance['phone']) ? esc_attr($instance['phone']) : '';
				$email 		= isset($instance['email']) ? esc_attr($instance['email']) : '';
				$city 		= isset($instance['city']) ? esc_attr($instance['city']) : '';
				$address 	= isset($instance['address']) ? esc_attr($instance['address']) : '';
				$state 		= isset($instance['state']) ? esc_attr($instance['state']) : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title *', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php esc_attr_e($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('first_name'); ?>"><?php _e('First Name', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('first_name'); ?>" name="<?php echo $this->get_field_name('first_name'); ?>" type="text" value="<?php esc_attr_e($first_name); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('last_name'); ?>"><?php _e('Last Name', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('last_name'); ?>" name="<?php echo $this->get_field_name('last_name'); ?>" type="text" value="<?php esc_attr_e($last_name); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php esc_attr_e($phone); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email *', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php esc_attr_e($email); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php esc_attr_e($address); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php esc_attr_e($city); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('state'); ?>"><?php _e('State', '_waituk_theme_text_domain'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" type="text" value="<?php esc_attr_e($state); ?>" />
		</p>
<?php
	}
}
/* Register the widget */
add_action('widgets_init', function () {
	register_widget('Entrada_Subscribe_Widget');
}); ?>