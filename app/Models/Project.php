<?php 

namespace App\Models;

use PDO;


class Project extends Model {


	function __construct($connection){

		parent::__construct($connection);

		
	}


	/**
	 * [findAll list all category]
	 * @return [voiarray['title']
	 */
	public function findAll(){

		$statement = $this->connection->prepare("SELECT * FROM projects");

		$statement->execute();
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);	
		return $users;
			
	}


	public function find($id){

		$statement = $this->connection->prepare("SELECT * FROM projects where project_id=:project_id");

		$statement->execute(array(':project_id'=>$id));
		$project = $statement->fetch(PDO::FETCH_ASSOC);	
		return $project;
			
	}

}

 ?>