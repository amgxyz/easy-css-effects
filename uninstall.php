<?php

//require_once('admin/class-woo-reset.php');
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}


delete_sit_settings();


function delete_sit_settings() {

	delete_option('sit_settings');
	
}
