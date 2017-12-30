<?php
/*
Plugin Name: Cryptocurrency
Description: Cryptocurrency display
Plugin URI: https://statenweb/crytpocurrency
Author: Mat Gargano
Version: 0.0.1
Author URI: https://statenweb.com/
Text Domain:       cryptocurrency
Domain Path:       /languages
*/

use Cryptocurrency\Actions;
use Cryptocurrency\Settings\Global_Settings;
use Cryptocurrency\Shortcodes\Table;

require __DIR__ . '/vendor/autoload.php';

add_action( 'plugins_loaded', 'cryptocurrency_load_plugin_textdomain' );

$global_settings = new Global_Settings();
$global_settings->init();

$table_shortcode = new Table();
$table_shortcode->init();

$actions = new Actions();
$actions->init();

function cryptocurrency_table( $output = true ) {

	return \Cryptocurrency\Output\Table::generate( $output );

}

function cryptocurrency_load_plugin_textdomain() {
	load_plugin_textdomain( 'cryptocurrency', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}

