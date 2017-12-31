<?php

namespace Cryptocurrency;

class Actions extends Thing {


	public function attach_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	public function enqueue() {
		wp_enqueue_style( 'cryptocurrency-table', dirname( plugin_dir_url( __FILE__ ) ) . '/css/style.css' );
	}

}