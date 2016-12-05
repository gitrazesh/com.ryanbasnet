<?php 

namespace App\Auth;

/**
 * Class checks ownership of resources
 * @package App\Auth
 * @access public
 * @author Ryan Basnet
 * @license sprouttech
 */
class CheckOwnership{

	protected $connection;

	public function __construct($container){

		$this->container=$container;
	}

	/**
	 * [post check ownership of blog post]
	 * @param  [int] $user_id [request issuing user]
	 * @param  [accoc array] $post    [post properties]
	 * @return [boolean]          [returns true  if user is owner of resource/admin or false]
	 */
	public function post($user_id,$post){

		//return true if user is admin
		if($this->container->auth->user()['role_id']==1){

			return true;
		}

		//check if user owns resource
		if($user_id==$post['author']){

			return true;
		}
	
		return false;
}




}































 ?>