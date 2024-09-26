<?php 

namespace PixelPath\HighlightLink\Classes;

use PixelPath\HighlightLink\Interfaces\HookContent;

//check if HighlightLink class exist
if(!class_exists('CustomizeLink')) {

    //create CustomizeLink class
    class CustomizeLink implements HookContent {

        //variables value set in SettingsPage
        public function __construct(public string $bgColor = "#fffb00", public string $textColor = "#000000")
        {
        
            add_filter('the_content', array($this, "modify_content"), 1);

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
                    return '<a ' . $matches[1] . 'href="' . $link_url . '" class="highlight"' . $matches[3] . '>';
                }

                return $matches[0]; //return original link if is intermal
            }, $content);

            return $content;
        }

    }
}



?>