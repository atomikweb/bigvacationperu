<?php

global $wpdb;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
$message = '';

$entrada_icons = array();
$entrada_icons = get_option('entrada_icons');
if (!empty($entrada_icons)) {
    $entrada_icons = get_option('entrada_icons');
}

if (isset($_POST['iconsave_btn'])) {

    $entrada_temp_icons = array();
    $entrada_ico_title = sanitize_title($_POST['entrada_ico_title']);
    $entrada_temp_icons[$entrada_ico_title] = addslashes($_POST['entrada_ico_class']);
    $entrada_temp_icons = array_merge($entrada_icons, $entrada_temp_icons);

    update_option('entrada_icons', $entrada_temp_icons);

    $message = __('Icon has been saved.', 'eaddons');
}

if ($mode == 'delete') {
    $entrada_ico_key = $_REQUEST['pid'];
    unset($entrada_icons[$entrada_ico_key]);
    update_option('entrada_icons', $entrada_icons);

    $message = __('Icon has been deleted.',  'eaddons');
}

$entrada_icons = get_option('entrada_icons');
ksort($entrada_icons);
?>

<div id="wrap">
    <div class="wrap">
        <h2>
            <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/img/addons.png"> <?php _e('Custom Icomoon Settings',  'eaddons'); ?>
            <a href="<?php echo esc_url($_SERVER["PHP_SELF"]) ?>?page=custom_icons&mode=add" class="button button-primary button-small"><?php _e('Add New',  'eaddons'); ?></a>
        </h2>
    </div>

    <?php
    if (isset($message) && $message != '') :
        echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
        echo '<p>' . $message . '</p>';
        echo '</div></div>';
    endif; ?>

    <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
        <tr>
            <td width="50%">
                <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
                    <form name="bannerfrm" action="" method="post" enctype="multipart/form-data">
                        <?php
                        if ($mode == 'edit') {
                            $entrada_ico_title = $_REQUEST['pid'];
                        } ?>
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <strong>
                                        <?php
                                        if ($mode == 'edit') {
                                            echo __('Update', 'eaddons');
                                        } else {
                                            echo __('Add', 'eaddons');
                                        }
                                        _e(' Custom Icon', 'eaddons'); ?>
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label> <?php _e('Icon Title', 'eaddons'); ?> : </label> </td>
                                <td>
                                    <input type="text" name="entrada_ico_title" style="width:200px;" id="entrada_ico_title" value="<?php if ($mode == 'edit') {
                                                                                                                                        echo stripslashes($_REQUEST['pid']);
                                                                                                                                    } ?>" />

                                </td>
                            </tr>
                            <tr>
                                <td><label> <?php _e('Icon Class Name', 'eaddons'); ?> : </label></td>
                                <td><input type="text" name="entrada_ico_class" style="width:200px;" id="entrada_ico_class" value="<?php if ($mode == 'edit') {
                                                                                                                                        echo stripslashes($entrada_icons[$entrada_ico_title]);
                                                                                                                                    } ?>" /></td>
                            </tr>


                            <tr>
                                <td>&nbsp; </td>
                                <td><input type="submit" class="button button-primary button-large" name="iconsave_btn" value=" <?php esc_attr_e('Save', 'eaddons'); ?>" style="cursor:pointer;" /></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="2"><strong> <?php _e('Note', 'eaddons'); ?></strong> : <?php _e('Please avoid blank space.', 'eaddons'); ?> </th>
                            </tr>
                        </tfoot>

                    </form>
                </table>
            </td>
            <td width="50%">
                <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
                    <thead>
                        <tr>
                            <th width="13%">#</th>
                            <th width="25%"><?php _e('Icon Title', 'eaddons'); ?> </th>
                            <th width="40%"><?php _e('Icon Class Name', 'eaddons'); ?></th>
                            <th width="22%"><?php _e('Action', 'eaddons'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($entrada_icons) {
                            //$currency_symbol = get_woocommerce_currency_symbol();
                            $count = 1;
                            $class = '';
                            foreach ($entrada_icons as $key => $value) {
                                if ($count % 2 == 1) {
                                    $class = 'class="alternate "';
                                } else {
                                    $class = '';
                                } ?>
                                <tr <?php echo $class; ?>>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo stripslashes($key); ?></td>
                                    <td><span class="<?php echo stripslashes($value); ?>"></span> <?php echo stripslashes($value); ?></td>

                                    <td> <a href="<?php echo admin_url('admin.php?page=eaddons-custom-icons'); ?>&pid=<?php echo $key; ?>&mode=edit">Edit</a> | <a href="<?php echo admin_url('admin.php?page=eaddons-custom-icons'); ?>&pid=<?php echo $key; ?>&mode=delete" onclick="return confirm('Are you sure you want to delete?')">Delete </a></td>
                                </tr>
                            <?php
                                    $count++;
                                }
                            } else { ?>
                            <tr class="alternate ">
                                <td colspan="4"><?php _e('No Record Found.', 'eaddons'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="13%">#</th>
                            <th width="25%"><?php _e('Icon Title', 'eaddons'); ?> </th>
                            <th width="40%"><?php _e('Icon Class Name', 'eaddons'); ?></th>
                            <th width="22%"><?php _e('Action', 'eaddons'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>

</div>