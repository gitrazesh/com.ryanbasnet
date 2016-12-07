<?php 

namespace App\Models;


use PDO;

class Skill extends Model{


	function __construct($connection){

		parent::__construct($connection);

		
	}


	/**
	 * [findAll list all category]
	 * @return [voiarray['title']
	 */
	public function findAll(){

		$statement = $this->connection->prepare("SELECT * FROM skills");

		$statement->execute();
		$skills = $statement->fetchAll(PDO::FETCH_ASSOC);	
		return $skills;
			
	}

}




 ?>