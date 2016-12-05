<?php  

namespace App\Controllers\Auth;

use PDO;
use DateTime;
use DateInterval;
use App\Controllers\Controller;
use App\Services\SendGrid\SendgridEmailService;
use Respect\Validation\Validator as v;



/**
 * Password Controller
 * @package App\Controller\Auth
 * @access public
 * @author Ryan Basnet
 * @license sprouttech
 */
class PasswordController extends Controller{




	/**
	 * [getChangePassword return password change form]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML] [return form for password change]
	 */
	public function getChangePassword($request,$response){

		return $this->container
					->view
					->render($response,'admin/partials/auth/change_password.twig');
	}


	/**
	 * [changePassword post password change form]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML] [redirects to login/change password form]
	 */
	public function changePassword($request,$response){

		$user_id 			= 	$this->container->auth->user()['user'];
		$user 				= 	$this->container->user->find($user_id);
		$old_password 		= 	$request->getParam('old-password');
		$new_password		=	$request->getParam('new-password');
		$confirm_password 	= 	$request->getParam('confirm-password');

		// respect validation rules
		$rules = [

				'old-password'		=>v::notEmpty()->length(5,10),
				'new-password'		=>v::notEmpty()->length(5,10),
				'confirm-password'	=>v::notEmpty()->length(5,10)
				
		];


		$validation = $this->container
						   ->validator
						   ->validate($request,$rules);

		if($validation->failed()){

			return $this->container
						->view
						->render($response,'admin/partials/auth/change_password.twig',['errors'=>$validation->getError()]);
		}

		if(!v::equals($new_password)->validate($confirm_password)){

			$errors['password'] = ["New Password and confirm password must match"];
			
			return $this->container
						->view
						->render($response,'admin/partials/auth/change_password.twig',['errors'=>$errors]);

		}


		if(!password_verify($old_password,$user['password'])){

					$error['password'] = ["Old password is incorrect."];
					
					return $this->container
								->view
								->render($response,'admin/partials/auth/change_password.twig',['errors'=>$error]);
				}
		
		//update password
		$this->container
			 ->user
			 ->updatePassword($user_id,password_hash($request->getParam('new-password'),PASSWORD_DEFAULT));
		
		//set flash message
		$this->container
			 ->flash
			 ->addMessage('success',"Successfully update password!");

		//log out
		$this->container
			 ->auth
			 ->logout();

		//redirect for login
		return $response->withRedirect($this->container->router->pathFor('admin.signin'));


	}


	/**
	 * [getPasswordForgot return password reset request form]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML] [return form for password forgot]
	 */
	public function getForgotPassword($request,$response){

		return $this->container
					->view
					->render($response,'admin/partials/auth/forgot_password.twig');
	}

	/**
	 * [getPasswordForgot post password forgot request]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML] [redirects to forgot-password form]
	 */
	public function postForgotPassword($request,$response){

		// respect validation rules
		$rules = [

				'recovery-email'	=>v::notEmpty()->email()
				
		];


		$validation = $this->container
						   ->validator
						   ->validate($request,$rules);

		if($validation->failed()){

			return $this->container
						->view
						->render($response,'admin/partials/auth/forgot_password.twig',['errors'=>$validation->getError()]);
		}

		//email
		$recoveryEmail = $request->getParam('recovery-email');
	
		if($this->container->user->userExist($recoveryEmail)){

			//password reset attributes
			$passwordResetToken	= strtoupper(base64_encode(md5(uniqid('',true))));
			$date 				= new DateTime('NOW');
			$currentDate 		= $date->format('Y-m-d H:i:s');
			$expiryDate 		= $date->add(new DateInterval('PT5H'))->format('Y-m-d H:i:s');


			$passwordResetUrl 	= "com.cms.local/account/reset-password/{$passwordResetToken}";
			$sendgridService 	= new SendGridEmailService();

			//password rest template ---TEMPORARY [USE SENDGRID LATER]
			
			$html = "<p>Please visit <a href='$passwordResetUrl'>password reset link</a> to reset password</p>";
			$data['from']		= 'support@ozmandu.com'; 
			$data['to']			= $recoveryEmail; 
			$data['subject']	= 'Ozmandu Account Password Reset';
			$data['message']	= $html; 

			$status = $sendgridService->passwordReset($data);
			
			if($status===202){

				$data['recoveryEmail'] = $recoveryEmail;
				$data['passwordResetToken'] =$passwordResetToken ;
				$data['expiryDate'] = $expiryDate;

					//check reset link is valid/not expired
					$this->container->passwordReset->createResetLink($data);
				
					$this->container
				 		 ->flash
				 		->addMessage('success', 'Please check your email for password reset.');
			
					return $response->withRedirect($this->container->router->pathFor('admin.forgotPassword'));
			}
		}else{

			$this->container
			 		 ->flash
			 		->addMessage('fail', 'Account doesnot exist with email provided.');

			return $response->withRedirect($this->container->router->pathFor('admin.forgotPassword'));

		
		}
	}


	/**
	 * [getResetPassword return password reset form]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML]  [return form for password reset/forgot password form for invalidresetToken]
	 */
	public function getResetPassword($request,$response,$args){

		$passwordResetToken =  $args['passwordResetUrl'];


		//check reset link is valid/not expired
		$status = $this->container->passwordReset->isResetLinkValid($passwordResetToken);

			if($status){

				return $this->container
							->view
							->render($response,'admin/partials/auth/reset_password.twig',['resetToken'=>$passwordResetToken]);
			}else{

				$this->container
			 		 ->flash
			 		->addMessage('fail', 'Please reset link is invalid, please request a new reset email.');

				return $response->withRedirect($this->container->router->pathFor('admin.forgotPassword'));

			}
	}

	/**
	 * [resetPassword reset user password]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @param  [array] $args     [request url parameter]
	 * @return [HTML]           [returns login on success or redirect back]
	 */
	public function resetPassword($request,$response,$args){


		$passwordResetToken =  $args['passwordResetUrl'];
		$new_password		=	$request->getParam('new-password');
		$confirm_password 	= 	$request->getParam('confirm-password');

		//check reset link is valid/not expired
		$status = $this->container->passwordReset->isResetLinkValid($passwordResetToken);


		if(!$status){

			$this->container
			 	 ->flash
			 	->addMessage('fail', 'Please reset link is invalid, please request a new reset email.');

			return $response->withRedirect($this->container->router->pathFor('admin.forgotPassword'));

		}



		// respect validation rules
		$rules = [

			
				'new-password'		=>v::notEmpty()->length(5,10),
				'confirm-password'	=>v::notEmpty()->length(5,10)
				
		];

		$validation = $this->container
						   ->validator
						   ->validate($request,$rules);

		if($validation->failed()){

			return $this->container
						->view
						->render($response,'admin/partials/auth/reset_password.twig',['errors'=>$validation->getError(),'resetToken'=>$passwordResetToken]);
		}

		//check password/confirm-password match 
		if(!v::equals($new_password)->validate($confirm_password)){

			$errors['password'] = ["New Password and confirm password must match"];
			
			return $this->container
						->view
						->render($response,'admin/partials/auth/reset_password.twig',['errors'=>$errors,'resetToken'=>$passwordResetToken]);

		}


		//update password
		
		$user_id = $this->container->user->userExist($status['user_email'])['user_id'];
		
		//update password
		$this->container
			 ->user
			 ->updatePassword($user_id,password_hash($request->getParam('new-password'),PASSWORD_DEFAULT));

		//delete password rest link
		$this->container->passwordReset->destroyResetLink($status['password_reset_id']);

		$this->container
			 	 ->flash
			 	->addMessage('success', 'Password reset is successful.');

		return $response->withRedirect($this->container->router->pathFor('admin.signin'));
	}

}


?>