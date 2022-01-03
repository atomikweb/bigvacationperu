    <?php
    global $wpdb;
    $settings = array();
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
    $message = '';
    $page_title = 'Facebook Settings';
    $page_subtitle = 'Facebook Settings';
    /* Widget : API Key */
    $settings[] = array(
        'title'           => __('Facebook App ID', 'eaddons'),
        'entrada_key'     => 'entrada_facebook_app_id',
        'desc'            => __('Please set app ID (Example : 1530139877297980 ). ', 'eaddons'),
        'type'             => 'text',
        'std'             => '',
        'hint'             => '',
    );
    if (isset($_POST['bannerbtn'])) {
        foreach ($settings as $setting) {
            if (array_key_exists('entrada_key', $setting)) {
                $field_val = $setting['entrada_key'];
                update_option($setting['entrada_key'], $_POST[$field_val]);
            }
        }
        $message = __('Setting has successfully saved.', 'eaddons');
    } ?>
    <div id="wrap">
        <div class="wrap">
            <h2><img src="<?php echo  plugin_dir_url(dirname(__FILE__)); ?>assets/img/addons.png"> <?php echo esc_attr($page_title); ?> </h2>
        </div>
        <?php
        if (isset($message) && $message != '') :
            echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
            echo '<p>' . $message . '</p>';
            echo '</div></div>';
        endif; ?>
        <div class="wrap">
            <?php if (count($settings)) { ?>
                <form name="bannerfrm" action="" method="post" enctype="multipart/form-data">
                    <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
                        <thead>
                            <tr>
                                <th width="20%"> <strong> <?php echo esc_attr($page_subtitle); ?> </strong> </th>
                                <th width="80%;">&nbsp; </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($settings as $setting) {
                                    switch ($setting['type']) {
                                        case 'heading':
                                            echo '<tr><td colspan="2"> <h4>' . $setting['title'] . '</h4> </td></tr> ';
                                            break;
                                        case 'select':
                                            $seelcted_val = get_option($setting['entrada_key']);
                                            echo '<tr><td width="20%"><label>' . $setting['title'] . '</label> </td><td  width="80%"><select name="' . $setting['entrada_key'] . '" id="' . $setting['entrada_key'] . '">';
                                            if (count($setting['choices']) > 0) {
                                                foreach ($setting['choices'] as $key => $val) {
                                                    echo '<option value="' . $key . '"';
                                                    if (isset($seelcted_val) && $key == $seelcted_val) {
                                                        echo ' selected = "selected"';
                                                    }
                                                    echo ' >' . $val . '</option>';
                                                }
                                            }
                                            echo '</select></td></tr>';
                                            break;
                                        default:
                                            echo '<tr><td width="20%"><label>' . $setting['title'] . '</label> </td>
										<td  width="80%"><input type="text"  style="width:350px;" name="' . $setting['entrada_key'] . '" id="' . $setting['entrada_key'] . '" value="' . get_option($setting['entrada_key']) . '"><span> ' . $setting['desc'] . '</span></td>
										</tr> ';
                                    }
                                } ?>
                                <tr>
                                    <td width="20%">&nbsp;</td>
                                    <td width="80%"> <input class="button button-primary button-large" type="submit" name="bannerbtn" value="<?php esc_attr_e('Save Changes', 'eaddons'); ?>" style="cursor:pointer;" /></td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <?php
                                            $thisurl = 'https://developers.facebook.com/docs/apps/register';
                                            echo sprintf(wp_kses(__('You\'ll need Facebook App ID to share post on Facebook. If you don\'t have App ID, please <a href="%s">Get Facebook APP ID</a> now . Skip this step, if you already updated App ID.', 'eaddons'), array('a' => array('href' => array()))), esc_url($thisurl)); ?>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </form>
            <?php } ?>
        </div>
    </div>