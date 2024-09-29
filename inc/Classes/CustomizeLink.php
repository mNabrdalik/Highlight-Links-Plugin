<?php 

namespace PixelPath\HighlightLink\Classes;

use PixelPath\HighlightLink\Interfaces\HookContent;

//check if HighlightLink class exist
if(!class_exists('CustomizeLink')) {

    //create CustomizeLink class
    class CustomizeLink implements HookContent {


        private $bgColor;
        private $textColor;

        public function __construct()
        {
            add_filter('the_content', array($this, "modify_content"), 1);
        }

        //variables custom value set in SettingsPage
        public function setOptions(string $bgColor, string $textColor) {
            $this->bgColor = $bgColor;
            $this->textColor = $textColor;
        }    

        //callback function for add action hook wp_head - render text div
        public function modify_content($content) {

            //change values in higlight class

            // get page URL
            $home_url = home_url();

            // regular expression
            $pattern = '/<a (.*?)href=["\'](.*?)["\'](.*?)>/i';

            //highlight external links - preg_replace_callback($pattern, $callback [anonymous function, thats why add use with variable]) - php function
            $content = preg_replace_callback($pattern, function ($matches) use ($home_url) {
                $link_url = $matches[2]; // second elements is link url
                // check if url is external
                if (strpos($link_url, $home_url) === false) {
                    // add class .highlight
                    return '<a ' . esc_attr($matches[1]) . 'href="' . esc_url($link_url) . '" class="highlight" style="background-color: ' . esc_attr($this->bgColor) . '; color: ' . esc_attr($this->textColor) . ';"' . esc_attr($matches[3]) . '>';
                }
                return $matches[0]; //return original link if is intermal
            }, $content);

            return $content;
        }

    }
}



?>