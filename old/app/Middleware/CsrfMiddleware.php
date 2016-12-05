<?php 

namespace App\Middleware;




/**
 * 
 * @package App\Middleware
 * @access public
 * @author Ryan Basnet
 * @license sprouttech
 */
class CsrfMiddleware extends Middleware{


	public function __invoke($request,$response,$next){
		$csrf = array();
		//generate csrf raw html input fiels for post request
		$csrf['field'] = '<input type="hidden" name="'.$this->container->csrf->getTokenNameKey().'" 
						  value = "'.$this->container->csrf->getTokenName() .'">

						  <input type="hidden" name="'.$this->container->csrf->getTokenValueKey().'" 
						  value = "'.$this->container->csrf->getTokenValue() .'">';
	
		$this->container->view->getEnvironment()->addGlobal('csrf',$csrf);

		$response =$next($request,$response);
		
		return $response;
	}








}














 ?>