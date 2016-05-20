
<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @Author: Rajesh Basnet
 * @Date:   2016-05-20 12:44:36
 * @Last Modified by:   Rajesh Basnet
 * @Last Modified time: 2016-05-20 12:55:53
 */



class Home extends CI_Controller{

	function __construct(){
		
		parent :: __construct();
	}


	public function index(){

		$this->load->view('home');
	}
}