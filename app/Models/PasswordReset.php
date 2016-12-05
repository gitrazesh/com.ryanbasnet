<?php 

namespace App\Models;

use \App\Interfaces\IModel as IModel;
use PDO;

class PasswordReset extends Model{

	function __construct($connection){

		parent::__construct($connection);

		
	}


public function createResetLink($data){

	
				$statement = $this->connection
								  ->prepare("INSERT INTO password_reset(user_email,reset_token,token_expiry,is_valid)
												 		 VALUES(:user_email,:encoded_token,:token_expiry,:is_valid)");
		
				$statement->execute(array("user_email"=>$data['recoveryEmail'],
									"encoded_token"=> $data['passwordResetToken'],
									"token_expiry"=>$data['expiryDate'],
									"is_valid"=>1
									 ));

}


public function isResetLinkValid($passwordResetToken){


		$statement = $this->connection
								  ->prepare("SELECT * FROM password_reset WHERE reset_token=:password_reset_token  AND token_expiry > NOW()");
								  
								   $statement->execute(array("password_reset_token"=>$passwordResetToken));
								   return  $statement->fetch(PDO::FETCH_ASSOC);






}

public function destroyResetLink($id){

	
				$statement = $this->connection
								  ->prepare("DELETE FROM password_reset WHERE password_reset_id=:password_reset_id");
		
				$statement->execute(array("password_reset_id"=>$id));

}















}























 ?>