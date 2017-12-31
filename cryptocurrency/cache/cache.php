<?php

namespace Cryptocurrency\Cache;


/**
 * An implementation of a cacher for processing data
 */
abstract class Cache {

	/**
	 * @var string $key - the key for the data to cache
	 */
	protected $key;
	/**
	 * @var int|null $cache_length_in_seconds - the amount of seconds you want to cache the data
	 */
	protected $cache_length_in_seconds;

	/**
	 * Cache constructor.
	 */

	public function __construct() {

		$this->cache_length_in_seconds = 60;
	}

	public function set_key( $key ) {
		$this->key = $key;
	}

	public function get_key() {
		return $this->key;
	}

	public function set_cache_length( $length_in_seconds ) {
		$this->cache_length_in_seconds = $length_in_seconds;
	}


	/**
	 * Setter method, should implement the SET cache method
	 *
	 * @param $value
	 *
	 * @return mixed
	 */
	abstract public function set( $value );


	/**
	 * Getter method, should implement the GET cache method
	 *
	 * @return mixed
	 */
	abstract public function get();

}
