<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_Validation extends CI_Form_validation{


	function __construct(){

		parent::__construct();
	}

	public function validation_error_array(){

		return $this->error_array;
	}
	


}