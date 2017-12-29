<?php
/*
Plugin Name: Cryptocurrency
Description: Cryptocurrency display
Plugin URI: https://statenweb/crytpocurrency
Author: Mat Gargano
Version: 0.0.1
Author URI: https://statenweb.com/
*/

use Cryptocurrency\Actions;
use Cryptocurrency\Settings\Global_Settings;
use Cryptocurrency\Shortcodes\Table;

require __DIR__ . '/vendor/autoload.php';

$global_settings = new Global_Settings();
$global_settings->init();

$table_shortcode = new Table();
$table_shortcode->init();

$actions = new Actions();
$actions->init();

function cryptocurrency_table( $output = true ) {

	return \Cryptocurrency\Output\Table::generate( $output );

}