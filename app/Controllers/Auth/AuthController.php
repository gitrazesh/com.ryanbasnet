<?php 

namespace App\Controllers\Auth;

use PDO;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


/**
 * Authentication Controller
 * @package App\Controllers\Auth
 * @access public
 * @author Ryan Basnet
 * @license sprouttech
 */
class AuthController extends Controller{


	/**
	 * [getIndex description]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response
	 * @return [HTML]           [lreturn login form]
	 */
	public function getIndex($request,$response){

		$totalPost = count($this->container->post->findAll());
		$totalComment =count($this->container->comment->findAll()); 
		return $this->container
					->view
					->render($response,'admin/index_admin.twig',['totalPost'=>$totalPost,'totalComment'=>$totalComment]);
	}


	/**
	 * [getSignIn returns login view]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML] [return login form]
	 */
	public function getSignin($request,$response){
		
		return $this->container->view->render($response,'admin/partials/auth/login.twig');


	}


	/**
	 * [postSignin returns dashboard/redirect login view]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML] [return dashboard or redirect to login view]
	 */
	public function postSignin($request,$response){

		//sanitizing input data
		$email 		= filter_var($request->getParam('email'),FILTER_SANITIZE_EMAIL);
		$password 	= filter_var($request->getParam('password'),FILTER_SANITIZE_STRING);
		

		// rules for respect validation
		$rules = [

				'email'		=>v::notEmpty()->email(),
				'password'	=>v::notEmpty(),
				
		];

		// @see Validation\Validator
		$validation = $this->container
						   ->validator
						   ->validate($request,$rules);

		if($validation->failed()){
			
			$errors= $validation->getError();
			
			return $this->container
						->view
						->render($response,'admin/partials/auth/login.twig',['errors'=>$errors]);
			
		}

	
		$auth = $this->container
					->auth
					->attempt($email,$password);
				
		if(!$auth){

			$this->container
				 ->flash
				 ->addMessage('fail',"Oops,couldn't sign you in with those details.");

			return $response->withRedirect($this->container->router->pathFor('admin.signin'));
		}

		$user_name = $this->container
						  ->auth
						  ->user()['first_name'];
		
		$this->container
			 ->flash
			 ->addMessage('success',"Hello, $user_name");
		
		return $response->withRedirect($this->container->router->pathFor('admin.dashboard'));
	}


	/**
	 * [getSignout logs user out and redirect to  login view]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML] [ redirect to login view]
	 */
	public function getSignout($request,$response){

		// @see Auth\Auth
		$this->container->auth->logout();
		return $response->withRedirect($this->container->router->pathFor('admin.signin'));
	}

}







 ?>