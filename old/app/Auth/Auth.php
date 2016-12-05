<?php 

namespace App\Auth;

/**
 * Class responsible for authentication 
 * @package App\Auth
 * @access public
 * @author Ryan Basnet
 * @license sprouttech
 */
class Auth{

	protected $container;

	public function __construct($container){
		
		$this->container=$container;
	}

	/**
	 * [attempt attempts login]
	 * @param  [string] $email    [user email]
	 * @param  [string] $password [user description]
	 * @return [bool]           [returns true on vrification]
	 */
	public function attempt($email,$password){

		$user = $this->container->user->userExist($email);

		if(!$user){

				return false;
		}

		if(password_verify($password,$user['password'])){

			$_SESSION['user'] =$user['user_id'];
			return true;
		}

		return false;
	}


	/**
	 * [logout logs user out]
	 * @return [void] [destroy session data]
	 */
	public function logout(){

		session_unset();
	}


	/**
	 * [user description]
	 * @return [assoc array] [returns logged in user details]
	 */
	public function user(){
		
		if(isset($_SESSION['user'])){

			$user = $this->container->user->find($_SESSION['user']);
			return ['user'=>$user['user_id'],
					'first_name'=>$user['first_name'],
					'last_name'=>$user['last_name'],
					'role_id'=>$user['role_id'],
					'image_path'=>$user['image_path']];
		}
	}

	
	/**
	 * [check if user is loggedin]
	 * @return [bool] [return session value for user]
	 */
	public function check(){

		return isset($_SESSION['user']);
	}


	/**
	 * [role returns logged in user role id]
	 * @return [int] [return role id of logged in user]
	 */
	public function role(){

		$user = $this->container->user->find($_SESSION['user_id']);
	}


}