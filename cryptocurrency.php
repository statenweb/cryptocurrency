<?php
/*
Plugin Name: Cryptocurrency
Description: Cryptocurrency display
Plugin URI: https://statenweb/cryptocurrency
Author: Mat Gargano
Version: 0.0.11
Author URI: https://statenweb.com/
Text Domain:       cryptocurrency
Domain Path:       /languages
*/

use Cryptocurrency\Actions;
use Cryptocurrency\Settings\Global_Settings;
use Cryptocurrency\Shortcodes\Table;

require __DIR__ . '/vendor/autoload.php';

$namespace = 'Cryptocurrency';
spl_autoload_register( function ( $class ) use ( $namespace ) {
	$base = explode( '\\', $class );
	if ( $namespace === $base[0] ) {
		$file = __DIR__ . DIRECTORY_SEPARATOR . strtolower( str_replace( [ '\\' ], [ DIRECTORY_SEPARATOR, ],
					$class ) . '.php' );
		if ( file_exists( $file ) ) {
			require $file;
		} else {
			wp_die( sprintf( 'File %s not found', esc_html( $file ) ) );
		}
	}

} );

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

