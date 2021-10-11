<?php
/*
Plugin Name: _ANDYP - Page Builder - Epic Slider
Plugin URI: http://londonparkour.com
Description: <em>Page Builder - Epic Slider - Uses Flickity and built to look like slider on https://www.epicgames.com/store/en-US/</em>
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

define( 'ANDYP_EPICSLIDER_PATH', __DIR__ );
define( 'ANDYP_EPICSLIDER_URL', plugins_url( '/', __FILE__ ) );
    
//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                        	   Initialise    		                     │
// └─────────────────────────────────────────────────────────────────────────┘
new andyp\pagebuilder\epicslider\initialise;
