<?php

global $db_version;
$db_version = '1.0';

function install()
{
    global $wpdb;
    global $db_version;

    $table_name = $wpdb->prefix . 'papiliond_traditio';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		`time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('db_version', $db_version);
}

register_activation_hook(__FILE__, 'install');
