<?php

namespace Cryptocurrency\Shortcodes;

use Cryptocurrency\Thing;

abstract class Shortcode extends Thing {

	protected $shortcode_slug = null;

	public function attach_hooks() {
		add_shortcode( $this->shortcode_slug, array( $this, 'shortcode' ) );
	}

}