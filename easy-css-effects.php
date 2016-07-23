<?php
/*
* Plugin Name: Easy CSS Effects
* Plugin URI: http://andrewgunn.xyz
* Description: Easy CSS Effects
* Version: 1.0
* Author: Andrew M. Gunn
* Author URI: http://andrewmgunn.com
* Text Domain: easy-scroll-depth
* License: GPL2
*********
*/
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

/**
* Constants
*/
define( 'ECE_NAME', 'Easy CSS Effects' );
define( 'ECE_BASENAME', plugin_basename(__FILE__) );
define( 'ECE_URL', plugins_url( __FILE__ ) );
define( 'ECE_DIR', plugins_url( __DIR__ ));
define( 'ECE_CLASS', __CLASS__ );
define( 'ECE_VERSION', '1.0' );
define( 'ECE_TEXT_DOMAIN', 'easy-css-effects' );
define( 'ECE_MENU', 'easy-css-effects' );
define( 'ECE_AMG', 'http://andrewgunn.xyz' );
define( 'ECE_JS', 'inc/js/' );
define( 'ECE_CSS', 'inc/css/' );

interface I_ECE_Toolbox {

}
/**
* Classes and interfaces
*/
class ECE_Toolbox {

	public function __construct() {

		//include_once('classes/class-ece-scritps.php');
		include_once('classes/class-ece-shortcodes.php');

		register_activation_hook( __FILE__, array( $this, 'ece_flush_rewrite_rules' ));
		register_deactivation_hook( __FILE__, array( $this, 'ece_flush_rewrite_rules' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'ece_register_includes' ) );

	}

	public function ece_flush_rewrite_rules() {
		flush_rewrite_rules();
	}

	public function ece_register_includes() {
	    wp_register_style( 'ece_css', plugins_url( ECE_CSS . 'ece.css', __FILE__ ));
	    wp_register_style( 'ece_css_min', plugins_url( ECE_CSS . 'ece.min.css', __FILE__ ));	 
		//wp_enqueue_style( 'ece_css' );
		wp_enqueue_style( 'ece_css_min' );	
	}

}

$ece = new ECE_Toolbox();
//$ece->ece_init();