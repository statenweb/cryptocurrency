<?php

namespace Cryptocurrency\Shortcodes;


class Table extends Shortcode {

	protected $shortcode_slug = 'cryptocurrency_table';

	public function shortcode() {
		\Cryptocurrency\Output\Table::generate( true );

	}


}