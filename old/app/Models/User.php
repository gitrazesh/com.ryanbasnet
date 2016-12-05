<?php 

namespace App\Models;

use PDO;
use \App\Interfaces\IModel as IModel;

class User extends Model implements  Imodel{


	function __construct($connection){

		parent::__construct($connection);

		
	}

	/**
	 * [create create a category ]
	 * @return [void] 
	 */
	public function create($array){

		$statement = $this->connection->prepare("INSERT INTO users(first_name,last_name,user_email,password,role_id,created_at) VALUES(:first_name,:last_name,:user_email,:password,:role_id,NOW())");
		$statement->execute(array( "first_name"=>$array['first_name'],
			"last_name"=>$array['last_name'],
			"user_email"=>$array['email'],
			"password"=>$array['password'],
			"role_id"=>$array['role_id'],

			));

	}



	/**
	 * [findAll list all category]
	 * @return [voiarray['title']
	 */
	public function findAll($id=null){

		$statement = $this->connection->prepare("SELECT * FROM users WHERE user_id != :user_id");
		$statement->execute(array('user_id' => $id));
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);	
		return $users;
			
	}


	/**
	 * [find find a category by id]
	 * @param  [int] $id [category id]
	 * @return [array]   [return database result set in associative array]
	 */
	public function find($id){


		$statement = $this->connection->prepare("SELECT * FROM users WHERE user_id=:id");
		$statement->execute(array('id'=>$id));
		$user=$statement->fetch();
		return $user;


	}


	/**
	 * [update category]
	 * @param  [int] $id [category id]
	 * @param  [associative array] $array [properties to be updated ]
	 * @return [void]     
	 */
	public function update($id,$array){

		$first_name = $array['first_name'];
		$last_name = $array['last_name'];
		$user_email = $array['user_email'];
		$role_id = $array['role_id'];
		$stmt = $this->connection->prepare("UPDATE users SET first_name=:first_name,last_name=:last_name,user_email=:user_email,role_id=:role_id WHERE user_id=:id");
		$stmt->execute(array(	'first_name'=>$first_name,
								'last_name'=>$last_name,
								'user_email'=>$user_email,
								'role_id'=>$role_id,
								'id'=>$id));

}
	/**
	 * [delete category]
	 * @param  [int] $id [category id]
	 * @return [void]   
	 */
	public function  delete($id){

		try{

			$statement = $this->connection->prepare("DELETE  FROM users WHERE user_id=:id");
			$statement->execute(array("id"=>$id));
			return true;
		
		} catch (\PDOException $e){

		
       		return false;
		}
	}



public function userExist($email){

	$statement = $this->connection->prepare("SELECT * FROM users WHERE user_email=:email");
		$statement->execute(array('email'=>$email));
		$user=$statement->fetch(PDO::FETCH_ASSOC);
		return $user;
}

public function findRole($id){

	
	$statement = $this->connection->prepare("SELECT * FROM roles WHERE role_id=:id");
		$statement->execute(array('id'=>$id));
		$role=$statement->fetch();
		return $role;
	
}

public function updateProfile($id,$array){

		$first_name = $array['first_name'];
		$last_name = $array['last_name'];
		$user_email = $array['user_email'];
		$image_path = $array['image_path'];
		$stmt = $this->connection->prepare("UPDATE users SET first_name=:first_name,
															last_name=:last_name,
															user_email=:user_email,
															image_path=:image_path,
															updated_at=NOW() WHERE user_id=:id");
		$stmt->execute(array(	'first_name'=>$first_name,
								'last_name'=>$last_name,
								'user_email'=>$user_email,
								'image_path'=>$image_path,
								'id'=>$id));

}


public function updatePassword($id,$password){

		
		$stmt = $this->connection->prepare("UPDATE users SET password=:password WHERE user_id=:id");
		$stmt->execute(array(	
								'password'=>$password,
								'id'=>$id));

}

}

 ?>