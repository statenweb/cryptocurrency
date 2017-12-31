<?php

namespace Cryptocurrency\Settings;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Cryptocurrency\Request\Mapper;

class Global_Settings {


	public function init() {
		$this->attach_hooks();
	}

	public function attach_hooks() {


		add_action( 'carbon_fields_register_fields', array( $this, 'setup_options' ) );
		add_action( 'after_setup_theme', array( $this, 'cf_boot' ) );


	}

	public function cf_boot() {

		Carbon_Fields::boot();

	}

	public function setup_options() {

		$labels = array(
			'plural_name'   => 'Coins',
			'singular_name' => 'Coin',
		);


		Container::make( 'theme_options', __( 'Cryptocurrency', 'cryptocurrency' ) )
		         ->set_page_parent( 'options-general.php' )
		         ->add_fields( array(
			         Field::make( 'complex', 'crypto_items', __( 'Coin Purchases', 'cryptocurrency' ) )
			              ->set_layout( 'tabbed-horizontal' )
                          ->setup_labels( $labels )
			              ->add_fields( array(
				              Field::make( 'select', 'coin_type', __( 'Coin Type', 'cryptocurrency' ) )
				                   ->add_options( self::choices() ),
				              Field::make( 'text', 'quantity', __( 'Quantity Purchased', 'cryptocurrency' ) ),
				              Field::make( 'number', 'purchased_price',
					              __( 'Total Spend (USD)', 'cryptocurrency' ) ),
			              ) )
		         ) );
	}


	private static function choices() {


		$mapper  = new Mapper();
		$choices = [];
		foreach ( $mapper->get() as $key => $value ) {
			$choices[ $key ] = $value['nice_name'];
		}

		return $choices;

	}


}
