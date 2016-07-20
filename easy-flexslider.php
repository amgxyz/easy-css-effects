<?php
/*
* Plugin Name: Easy Flexslider
* Plugin URI: http://andrewgunn.xyz
* Description: Easy Flexslider
* Version: 1.0
* Author: Andrew M. Gunn
* Author URI: http://andrewmgunn.com
* Text Domain: easy-flexslider
* License: GPL2
*
*/
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

/**
* Classes and interfaces
*/
include_once('classes/class-sit-settings.php');
include_once('classes/class-sit-scripts.php');

//define( 'IGTM_PDF_URL', 'http://andrewgunn.xyz/wp-content/uploads/2015/10/Interactive-Geo-Trail-Map.pdf' ); 
/**
* Flushing permalinks for CPTs on DEACTIVATE
*/
//register_deactivation_hook( __FILE__, 'flush_permalinks' );

/**
* Flushing permalinks for CPTs ON ACTIVATE
*/
//register_activation_hook( __FILE__, 'setup_plugin_data' );
//register_activation_hook( __FILE__, 'create_misc_pages' );
//add_action( 'admin_init', 'flush_permalinks' );
/*
* Adding Settings link to plugin page
*/


/**
* Enqueue the plugins JS and CSS files
*/
add_action( 'init', 'register_admin_trail_story_scripts' );

function register_admin_trail_story_scripts() {
    wp_register_script( 'admin_trail_story_js', plugins_url( 'inc/admin-trail-story.js', __FILE__ ), array('jquery'));
    wp_register_style( 'admin_trail_story_css', plugins_url( 'inc/admin-trail-story.css', __FILE__ ));
    wp_enqueue_script( 'admin_trail_story_js' );
    wp_enqueue_style( 'admin_trail_story_css' );
}


add_filter( 'plugin_action_links', 'sit_settings_link', 10, 5 );

function sit_settings_link( $actions, $plugin_file )
{
	static $plugin;

	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);

		if ($plugin == $plugin_file) {

			$settings = array('settings' => '<a href="tools.php?page=seo-image-tags">' . __('Settings', 'General') . '</a>',
				'support' => '<a target="_blank" href="http://andrewgunn.xyz/support/">' . __('Support', 'General') . '</a>');

    			$actions = array_merge($settings, $actions);
		}

		return $actions;
}

/**
* Copy image title and save to Alt text field when image is uploaded. Runs anytime
* an image is uploaded, automatically.
*/
add_filter('add_attachment', 'insert_image_alt_tag', 10, 2);
//add_filter('edit_attachment', 'insert_image_alt_tag', 10, 2);

function insert_image_alt_tag($post_ID) {

	$sit_settings = get_option('sit_settings');

	$attach = wp_get_attachment_url($post_ID);
	$title = sanitize_text_field(get_the_title($post_ID));
	
	if ( ! add_post_meta( $post_ID, '_wp_attachment_image_alt', $title, true ) ) {
	   update_post_meta ( $post_ID, '_wp_attachment_image_alt', $title );
	}

}

function batch_update_image_tags($is_update) {

	$total = 0;
	$created = 0;
	$updated = 0;
	$deleted = 0;

	$args = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => null, // any parent
    );

	//Get all attachment posts
	$attachments = get_posts($args);

	//if there are posts
	if ($attachments) {

		$sit_settings = get_option( 'sit_settings' );

		if ( $sit_settings['enable_pdf'] ) {
			$pdf = true;
			$pdf_mine = 'pdf';
		}

		$image_mime = 'image';

		//Loop thru each attachment
		foreach ($attachments as $post) {

			//get post data ready,set title var to post title
	        setup_postdata($post);
	        $title = sanitize_text_field( get_the_title($post->ID) );
			$type = get_post_mime_type($post->ID);
			$tag = sanitize_text_field( get_post_meta( $post->ID, '_wp_attachment_image_alt', true ));
			$tag_str = strval($tag);
			$tag_len = strlen($tag_str);
			//echo $type;
			if (strpos($type, $image_mime) !== false) {

				if ( $is_update == True ) {
					//if has post meta for alt tag, update it else add it.
					if (! add_post_meta( $post->ID, '_wp_attachment_image_alt', $title, true )) {

						if ((empty($tag) || (($tag_len <= 2 ) && ($tag_str !== $title)))) {

							update_post_meta ( $post->ID, '_wp_attachment_image_alt', $title );
							$updated++;
						}
					} else {
						$created++; //update counter
					}

				} else {

					//if has post meta for alt tag, update it else add it.
					if (! empty($tag) ) {
						delete_post_meta($post->ID, '_wp_attachment_image_alt', $title);
						$deleted++; //update counter
					} //end add_post_meta
				}

				$total++;

			}

	    } //end foreach

	} //end attachments

	$count = array(
		'total' => $total,
		'created' => $created,
		'updated' => $updated,
		'deleted' => $deleted
		);


	//count of files updated
	return $count;
}