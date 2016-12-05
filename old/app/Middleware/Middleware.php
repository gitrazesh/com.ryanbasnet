<?php 

namespace App\Middleware;


/**
 * Middlewware Base Class
 */
class Middleware {

	protected $container;


	public function __construct($container){

		$this->container= $container;
	}
}

 ?>