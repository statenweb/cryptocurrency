<?php

namespace Cryptocurrency;

use Cryptocurrency\Cache\Cache;
use Cryptocurrency\Cache\Transient;
use Cryptocurrency\Datamap\Coinmarketcap;
use Cryptocurrency\Datamap\Mapper;
use Cryptocurrency\Request\API;

class Processor {

	protected $api;
	protected $mapper;
	protected $processed = false;
	protected $processed_data;
	protected $cache;

	public function __construct( $cache = null ) {


		$this->api = new API();

		if ( is_null( $cache ) ) {
			$cache = new Transient();
		}

		if ( $cache ) {
			$this->cache = $cache;
		}

	}

	public function process() {

		return $this->maybe_process();
	}

	protected function maybe_process() {
		if ( ! $this->processed ) {
			$this->do_process();
		}

		return $this->processed_data;
	}

	protected function do_process() {

		$coin_objects = null;
		/**
		 * @var $request API;
		 */
		if ( $this->cache ) {
			$cache_key = md5( serialize( (array) $this->api ) );
			/**
			 * @var $cache Cache;
			 */
			$cache = new $this->cache;
			$cache->set_key( $cache_key );
			$coin_objects = $cache->get();
		}

		if ( ! $coin_objects ) {
			$request      = new $this->api;
			$coin_objects = $request->get();
			if ( $this->cache ) {
				$cache->set( $coin_objects );
			}
		}

		$this->processed_data = $coin_objects;
	}


}