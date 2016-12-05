<?php 

namespace App\Controllers;

/**
 * Base Controller
 */
class Controller{


	protected $container;

	public function __construct($container){

		$this->container = $container;
	}
}



 ?>