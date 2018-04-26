<?php
/*
Plugin Name: Cryptocurrency Portfolio Tracker
Description: Enter your cryptocurrency purchases and track their pricing in real time
Plugin URI: https://statenweb/cryptocurrency
Author: Mat Gargano
Version: 0.0.15
Author URI: https://statenweb.com/
Text Domain:       cryptocurrency
Domain Path:       /languages
*/

use Cryptocurrency\Actions;
use Cryptocurrency\Settings\Global_Settings;
use Cryptocurrency\Shortcodes\Table;

function cry_fs() {
    global $cry_fs;

    if ( ! isset( $cry_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $cry_fs = fs_dynamic_init( array(
            'id'                  => '2025',
            'slug'                => 'cryptocurrency',
            'type'                => 'plugin',
            'public_key'          => 'pk_ad331077d943d10dd7ea8fd50b295',
            'is_premium'          => false,
            'has_addons'          => false,
            'has_paid_plans'      => false,
            'menu'                => array(
                'slug'           => 'crb_carbon_fields_container_cryptocurrency.php',
                'parent'         => array(
                    'slug' => 'options-general.php',
                ),
            ),
        ) );
    }

    return $cry_fs;
}

// Init Freemius.
cry_fs();
// Signal that SDK was initiated.
do_action( 'cry_fs_loaded' );

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

