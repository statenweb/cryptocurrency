<?php

namespace Cryptocurrency\Request;

class API {


	protected $cache = true;
	protected $cache_length = MINUTE_IN_SECONDS;
	protected $api_endpoint = 'https://api.coinmarketcap.com/v1/ticker/';
	protected $coin_object = null;

	public function get() {


		$coin_object = $this->get_coin_objects();

		return $coin_object;

	}

	protected function get_coin_objects() {


		$request     = wp_remote_get( $this->api_endpoint );
		$body        = wp_remote_retrieve_body( $request );
		$coin_body   = json_decode( $body );
		$coins_keyed = [];
		foreach ( $coin_body as $coin_object ) {
			$coins_keyed[ $coin_object->id ] = $coin_object;
		}

		$coin_data = (object) [
			'data' => $coins_keyed,
			'time' => time()
		];

		return $coin_data;

	}
}


