<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );


class ECE_Data {
/**
* Enqueue scripts
*/
    private $ece_settings = '';


    public function __construct() {

        global $poop;

        //add_action('wp_footer', array( $this,'ece_scripts' ),5 );
        //add_action('wp_footer', array( $this,'ece_styles' ),5 );

        var_dump($poop);
    }
    public function ece_scripts() {
    
    }

    public function ece_styles() {

    }
}
$esh = new ECE_Script_Handler();