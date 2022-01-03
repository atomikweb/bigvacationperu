<?php global $wpdb;

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
/* Create price range table */

$sql = "CREATE TABLE `" . $wpdb->prefix . "entrada_price_range` (
		id BIGINT(20) NOT NULL AUTO_INCREMENT,
		pr_title VARCHAR(100) NOT NULL,
		min_price INT(100) NOT NULL,
		max_price INT(100) NOT NULL,
		PRIMARY KEY  (id)
    );";

dbDelta($sql);

/* Create Polls table */
$sql_polls = "CREATE TABLE `" . $wpdb->prefix . "polls` (
		id BIGINT(20) NOT NULL AUTO_INCREMENT,
		poll_question VARCHAR(240) NOT NULL,
		poll_options VARCHAR(240) NOT NULL,
		added_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id)
	);";
dbDelta($sql_polls);


/* Create Entrada Options table */

$sql_entrada_options = "CREATE TABLE `" . $wpdb->prefix . "entrada_options` (
		entrada_id BIGINT(20) NOT NULL AUTO_INCREMENT,
		entrada_key VARCHAR(240) NOT NULL,
		entrada_value TEXT NOT NULL,
		entrada_autoload enum('yes','no') NOT NULL DEFAULT 'yes',
		PRIMARY KEY  (entrada_id)
	);";
dbDelta($sql_entrada_options);

/* Create Entrada Poll answers table */

$sql_poll = "CREATE TABLE `" . $wpdb->prefix . "poll_answer` (
		id BIGINT(20) NOT NULL AUTO_INCREMENT,
		question_id INT(20) NOT NULL,
		ip VARCHAR(240) NOT NULL,
		vote INT(4) NOT NULL,
		vote_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id)
	);";
dbDelta($sql_poll);

/* Create Entrada Wishlist table */

$sql_wishlist = "CREATE TABLE `" . $wpdb->prefix . "entrada_wishlist` (
		id BIGINT(20) NOT NULL AUTO_INCREMENT,
		post_id INT(10) NOT NULL,
		user_id INT(10) NOT NULL,
		guest_id VARCHAR(120) NOT NULL,
		added_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id)
	);";
dbDelta($sql_wishlist);
