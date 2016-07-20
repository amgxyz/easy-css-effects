<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );


class EceScriptHandler {
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
	public function ece_scripts() { ?>

		    <script type="text/javascript">
		        
		        //jQuery(document).ready(function($) {
		        jQuery(document).ready(function($){
		        	

				});

			</script>


	<?php }

	public function ece_styles() {  ?>

		    <style type="text/css">
		        
		       

			</style>


	<?php }
}
$esh = new EceScriptHandler();