<?php

namespace Cryptocurrency\Request;


use Cryptocurrency\Processor;

class Mapper {

	public function get() {

		$data_processor = new Processor();
		$data           = $data_processor->process();

		return array_map( function ( $data ) {
			return [

				'nice_name' => $data->name

			];
		}, $data->data );


	}

}