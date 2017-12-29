<?php

namespace Cryptocurrency\Cache;

class Transient extends Cache {
	public function set( $value ) {

		set_transient( $this->get_key(), $value, $this->cache_length_in_seconds );

		return $value;

	}

	public function get() {

		return get_transient( $this->get_key() );

	}
}