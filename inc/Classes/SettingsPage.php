<?php

namespace PixelPath\HighlightLink\Classes;

//check if SettingsPage class exist
if(!class_exists('SettingsPage')) {

    //create SettingsPage class
    class SettingsPage {

        private static $instance = null;

        public function __construct()
        {
            //top level menu page
            add_action( 'admin_menu', array($this, 'toplevel_options_page'));
            //add options page to admin Settings page
            add_action('admin_menu', array($this, 'create_settings_page'));
            //register inputs to set values
            add_action('admin_init', array($this, 'register_settings'));

        }

        //Singleton method to ensure only one instance
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        function toplevel_options_page() {
            add_menu_page(
                'Highlighter',
                'Highlighter Options',
                'manage_options',
                'highlighter',
                array($this, 'options_page_html'),
                'dashicons-art',
                60
            );
        }

        public function options_page_html() {

        }
        

        //callback function for add action hook admin menu 
        public function create_settings_page() {
            //add option page in Settings
            add_options_page(
                'Highlighter Settings', 
                'Highlighter', 
                'manage_options', 
                'highlighter-settings', 
                array($this, 'settings_page_html')
            );
        }

        //callback function for add action hook admin init 
        public function register_settings() {
            //register 2 variables:  bgColor and textColor
            register_setting('highlighter-settings-group', 'highlighter_bg_color');
            register_setting('highlighter-settings-group', 'highlighter_text_color');
        }


        //options visible on admin panel
        public function settings_page_html() {
            ?>
            <div class="wrap">
                <h1>Highlighter Settings</h1>
                <form method="post" action="options.php">
                    <?php settings_fields('highlighter-settings-group'); ?>
                    <?php do_settings_sections('highlighter-settings-group'); ?>
                    <table class="form-table">
                        <!-- bg color -->
                        <tr valign="top">
                            <th scope="row">Background Color</th>
                            <td><input type="color" name="highlighter_bg_color" placeholder="#FFFFFF" value="<?php echo esc_attr(get_option('highlighter_bg_color')); ?>" /></td>
                        </tr>
                        <!-- text color -->
                        <tr valign="top">
                            <th scope="row">Text Color</th>
                            <td><input type="color" name="highlighter_text_color" placeholder="#000000" value="<?php echo esc_attr(get_option('highlighter_text_color')); ?>" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
            <?php
        }
        
    }
}