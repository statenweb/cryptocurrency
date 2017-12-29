<?php

namespace Cryptocurrency\Shortcodes;


class Table extends Shortcode {

	protected $shortcode_slug = 'crypto_table';

	public function shortcode() {
		\Cryptocurrency\Output\Table::generate( true );

	}


}