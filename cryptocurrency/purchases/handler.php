<?php

namespace Cryptocurrency\Purchases;

use Cryptocurrency\Currencies;
use Cryptocurrency\Processor;
use Cryptocurrency\Request\Mapper;

class Handler {

	protected $purchases;
	protected $calculated;
	protected $data;
	protected $prices = [];

	public function __construct( $purchases ) {
		$this->purchases = $purchases;
	}

	public function get() {

		return $this->calculate();

	}

	protected function calculate() {
		if ( $this->calculated ) {
			return $this->data;
		}

		$this->data = (object) [];


		$total_spent = $total_worth = 0;
		$mapper      = new Mapper();
		$mapper_data = $mapper->get();

		$price_object   = new Processor();
		$price_all_data = $price_object->process();

		$this->data->time = $price_all_data->time;


		foreach ( $this->purchases as $purchase ) {


			$nice_name     = $mapper_data[ $purchase['coin_type'] ]['nice_name'];
			$current_price = (float) $price_all_data->data[ $purchase['coin_type'] ]->price_usd;

			$previous_quantity = 0;
			$previous_spend    = 0;


			if ( isset( $this->data->calculations[ $purchase['coin_type'] ] ) ) {
				$previous_quantity = $this->data->calculations[ $purchase['coin_type'] ]['quantity'];
				$previous_spend    = $this->data->calculations[ $purchase['coin_type'] ]['purchased_price'];

			}

			$total_spent += $purchase['purchased_price'];
			$total_worth += $purchase['quantity'] * $current_price;

			$quantity = $previous_quantity + $purchase['quantity'];
			$spend    = $previous_spend + $purchase['purchased_price'];


			$current_worth = $quantity * $current_price;
			$net           = $current_worth - $spend;

			$percentage = ( $current_worth - $spend ) / $spend;

			$this->data->calculations[ $purchase['coin_type'] ] = [
				'current_worth'   => $current_worth,
				'percentage'      => $percentage,
				'net'             => (float) $net,
				'name'            => $nice_name,
				'current_price'   => $current_price,
				'purchased_price' => $spend,
				'quantity'        => $quantity,
			];


		}

		$total_net        = $total_worth - $total_spent;
		$total_percentage = $total_net / $total_spent;

		$this->data->calculations['total'] = [
			'purchased_price' => $total_spent,
			'current_worth'   => $total_worth,
			'percentage'      => $total_percentage,
			'net'             => $total_net,
			'name'            => 'Total',

		];

		$this->calculated = true;

		return $this->data;


	}


}