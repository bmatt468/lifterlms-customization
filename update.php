<?php
add_action( 'init', 'activate_au' );	
function activate_au()
{
	require_once ( 'wp_autoupdate.php' );
	$plugin_current_version = '0.9.0';
	$plugin_remote_path = 'http://benjaminrmatthews.com/update-server/update-handler.php';	
	$plugin_slug = 'lifterlms-customization/lifterlms-customization.php';
	new wp_AutoUpdate ( $plugin_current_version, $plugin_remote_path, $plugin_slug);	
}
?>