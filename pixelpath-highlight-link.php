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

//load autolaoder from composer
require_once __DIR__ . '/vendor/autoload.php';

use PixelPath\HighlightLink\Classes\CustomizeLink;
use PixelPath\HighlightLink\Classes\SettingsPage;

//style init
add_action( 'wp_enqueue_scripts','enqueue_styles');

//enque style function
function enqueue_styles() {
    wp_register_style('highlight-links-style', plugins_url('style.css',__FILE__));
    wp_enqueue_style('highlight-links-style');
}

//settings page with options - singleton
SettingsPage::getInstance();

//higlight external links
$customLink = new CustomizeLink();
$customLink->setOptions(
    get_option('highlighter_bg_color', '#fffb00'),
    get_option('highlighter_text_color', '#000000')
);
