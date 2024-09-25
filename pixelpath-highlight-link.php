<?php
/**
 * Plugin Name:       Highlight Links
 * Description:       A simple WordPress plugin that highlight exterior links
 * Version:           0.1.0
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Author:            MN
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       msg-oop
 */


//style init
add_action( 'wp_enqueue_scripts','enqueue_styles');

//enque style function
function enqueue_styles() {
    wp_register_style('highlight-links-style', plugins_url('style.css',__FILE__));
    wp_enqueue_style('highlight-links-style');
}


add_filter('the_content', "highlight_ext_links", 1);

function highlight_ext_links($content) {

    // get page URL
    $home_url = home_url();

    // pregmatch
    $pattern = '/<a (.*?)href=["\'](.*?)["\'](.*?)>/i';

    //highlight external links
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

// TO DO - Settings page - to change color of link background and font color
