<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

interface I_ECE_Settings {

}
/**
* PLUGIN SETTINGS PAGE
*/
class ECE_Settings {
    /**
     * Holds the values to be used in the fields callbacks
     */
    public $ece_settings;
    /**
     * Start up
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_ece_menu_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }
    /**
     * Add options page
     */
    public function add_ece_menu_page() {
      
       add_submenu_page(
            'tools.php',
            'CSS Effects',
            'CSS Effects',
            'manage_options',
            ECE_MENU,
            array( $this, 'create_ece_menu_page' )//,
        );
    }

    public function create_ece_menu_page() {
        // Set class property
        $this->ece_settings = get_option( 'ece_settings' );
        ?>
        <div class="ece-wrap wrap">
            <div>
            <h1></h1>
            <form method="post" action="options.php">
            <?php

                // Create an nonce for a link.
                // We pass it as a GET parameter.
                // The target page will perform some action based on the 'do_something' parameter.

                settings_fields( 'ece_settings_group' );
                do_settings_sections( 'ece-options-admin' );
                //submit_button('Save All Options');
            ?>
            </form>
        </div>
            <?php //echo gtm_get_sidebar(); ?>
        </div>
        <?php
    }


    /**
     * Register and add settings
     */
    public function page_init() {
        //global $geo_mashup_options;
        register_setting(
            'ece_settings_group', // Option group
            'ece_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'ece_settings_section', // ID
            '', // Title
            array( $this, 'ece_info' ), // Callback
            'ece-options-admin' // Page
        );

        add_settings_section(
            'ece_option', // ID
            '', // Title
            array( $this, 'ece_option_callback' ), // Callback
            'ece-options-admin', // Page
            'ece_settings_section' // Section
        );
    
    }
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();
        if( isset( $input['ece_settings'] ) )
            $new_input['ece_settings'] = absint( $input['ece_settings'] );
        
        return $input;
    }


    public function ece_info() {

        if ($this->ece_settings['update']) {
          
            $count = array();
            $count = batch_update_image_tags(true);

            echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"><p>';

            foreach( $count as $key => $value ) { 
               echo '<strong>'.$key.':</strong>&nbsp;'.$value.'<br>';
            }
            update_option($ece_settings['update'], '');
            echo '</p></div>';

        } elseif ($this->ece_settings['delete']) {
            $count = array();
            $count = batch_update_image_tags(false);
             echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"><p>';

            foreach( $count as $key => $value ) { 
               echo '<strong>'.$key.':</strong>&nbsp;'.$value.'<br>';
            }
            update_option($ece_settings['delete'], '');

            echo '</p></div>';

        }
    
    }
    /**
     * Print the Section text
     */

    /**
     * Get the settings option array and print one of its values
     */
    public function ece_option_callback() {
        //Get plugin options
        
        global $ece_settings;
        wp_enqueue_media();
        
        // Get trail story options
        $ece_settings = (array) get_option( 'ece_settings' ); ?>
        
            <div id="ece-settings" class="ece-settings plugin-info header">
    

                <table class="form-table">
                    <tbody>
                        <tr>
                        <th scope="row">
                            Database
                        </th>
                        <td>
                        <fieldset><?php $key = 'update'; ?>
                                
                            <input class="button button-primary" id='ece_settings[<?php echo $key; ?>]' name="ece_settings[<?php echo $key; ?>]" type="submit" value="Update Tags"  />
                        

                            <?php $key = 'delete'; ?>
                            &nbsp;
                            <input class="button-secondary delete" id='ece_settings[<?php echo $key; ?>]' name="ece_settings[<?php echo $key; ?>]" type="submit" value="Delete Tags"  />
                        
                                </fieldset>
                            </td>
                    
                        </tr>
                       
                         <tr>
                            <th scope="row">
                                Link Targetting
                            </th>
                            <td>
                                <fieldset><?php $key = 'enable_seo_links'; ?>
                                    <label for="ece_settings[<?php echo $key; ?>]">
                                        <input id='ece_settings[<?php echo $key; ?>]' name="ece_settings[<?php echo $key; ?>]" type="checkbox" value="1" <?php checked(1, $ece_settings[$key], true ); ?> />
                                        Open external links in new tab.
                                    </label>
                                </fieldset>
                                <fieldset><?php $key = 'enable_pdf_ext'; ?>
                                    
                                    <label for="ece_settings[<?php echo $key; ?>]">
                                        <input id='ece_settings[<?php echo $key; ?>]' name="ece_settings[<?php echo $key; ?>]" type="checkbox" value="1" <?php checked(1, $ece_settings[$key], true ); ?> />
                                        Open internal PDFs in a new tab.
                                    </label>

                                </fieldset>
                            

                               
                            </td>
                        </tr>
                        
                           <tr>
                            <th scope="row">
                                Plugin Scripts
                            </th>
                            <td>
                                <fieldset><?php $key = 'disable_clientside_script'; ?>
                                    
                                    <label for="ece_settings[<?php echo $key; ?>]">
                                        <input id='ece_settings[<?php echo $key; ?>]' name="ece_settings[<?php echo $key; ?>]" type="checkbox" value="1" <?php checked(1, $ece_settings[$key], true ); ?> />
                                        Disable all clientside plugin scripts.
                                    </label>

                                </fieldset>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                Form Autofilling
                            </th>
                            <td>
                                <fieldset><?php $key = 'dab_af'; ?>
                                    <label for="ece_settings[<?php echo $key; ?>]">
                                        <input id='ece_settings[<?php echo $key; ?>]' name="ece_settings[<?php echo $key; ?>]" type="checkbox" value="1" <?php checked(1, $ece_settings[$key], true ); ?> />
                                        Disable all forms and inputs autofilling/autocomplete ability.
                                    </label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <th> <?php submit_button('Save Settings'); ?></th>

                        </tr>

                    </tbody>
                </table>
                
                <hr>
                <br><br>

        
            </div>
<?php }
}

if( is_admin() )
    $sit = new ECE_Settings();


