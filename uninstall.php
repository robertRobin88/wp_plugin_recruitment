<?php 


if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

global $wpdb;

$wpdb->query(sprintf(
	"DELETE FROM %s WHERE meta_key='recruitment'",
	$wpdb->prefix . 'postmeta'
));
delete_transient('recruitmentPostCache');