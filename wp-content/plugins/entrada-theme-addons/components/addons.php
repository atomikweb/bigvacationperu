<?php
global $wpdb;
echo '<div id="wrap"><div class="wrap"><h2><img src="' .  plugin_dir_url(dirname(__FILE__))  . 'assets/img/addons.png"> ' . __('Addons', 'eaddons') . '</h2></div>';
echo '<div class="wrap">';
echo '<ul class="entrada-addons">';
echo '<li><a href="' . admin_url('admin.php?page=eaddons-facebook') . '"><span class="img-wrap"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'assets/img/icon-facebook.png"></span>' . __("Facebook", "eaddons") . '</a></li>';

echo '<li><a href="' . admin_url('admin.php?page=eaddons-googleapi') . '"><span class="img-wrap"><img src="' .  plugin_dir_url(dirname(__FILE__))  . 'assets/img/icon-google_api.png"></span>' . __("Google API Key", "eaddons") . '</a></li>';


echo '<li><a href="' . admin_url('admin.php?page=eaddons-price-range') . '"><span class="img-wrap"><img src="' .  plugin_dir_url(dirname(__FILE__))  . 'assets/img/icon-price-tag.png"></span>' . __("Price Range", "eaddons") . '</a></li>';
echo '<li><a href="' . admin_url('admin.php?page=eaddons-polls') . '"><span class="img-wrap"><img src="' .  plugin_dir_url(dirname(__FILE__))  . 'assets/img/icon-poll.png"></span>' . __("Community Polls", "eaddons") . '</a></li>';
echo '</ul>';
echo '</div>';
echo '</div>';
