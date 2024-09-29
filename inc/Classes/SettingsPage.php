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

        //top level menu in admin page
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

        //The function to be called to output the content for Highlighter page.
        public function options_page_html() {
            ?>
            <div class="wrap">
                <form method="post" action="options.php">
                    <?php
                    settings_fields('highlighter-settings-group');
                    do_settings_sections('highlighter');
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        //callback function for add action hook admin init 
        public function register_settings() {
            //register 2 variables:  bgColor and textColor
            register_setting('highlighter-settings-group', 'highlighter_bg_color');
            register_setting('highlighter-settings-group', 'highlighter_text_color');

             // Add settings section
             add_settings_section(
                'highlighter_settings_section',
                'Customize Highlighter Settings',
                null,
                'highlighter'
            );

            // Add background color field
            add_settings_field(
                'highlighter_bg_color',
                'Background Color',
                array($this, 'bg_color_field_html'),
                'highlighter',
                'highlighter_settings_section'
            );

            // Add text color field
            add_settings_field(
                'highlighter_text_color',
                'Text Color',
                array($this, 'text_color_field_html'),
                'highlighter',
                'highlighter_settings_section'
            );
        }

        public function bg_color_field_html() {
            ?>
            <input type="color" name="highlighter_bg_color" placeholder="#FFFFFF" value="<?php echo esc_attr(get_option('highlighter_bg_color')); ?>" />
            <?php
        }

        public function text_color_field_html() {
            ?>
            <input type="color" name="highlighter_text_color" placeholder="#000000" value="<?php echo esc_attr(get_option('highlighter_text_color')); ?>" />
            <?php
        }

        
    }
}