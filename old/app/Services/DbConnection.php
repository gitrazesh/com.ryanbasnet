<?php 
namespace App\Services;
use PDO;


class DbConnection{


	
public static function getConnection(){



	try {
		
		$connection = new PDO('mysql:host=localhost;dbname='. getenv('db_name'), getenv('db_user'), getenv('db_pass'));
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		} catch (PDOException $e) {

			echo "Error !: " , $e->getMessage() , "<br/>";
			die();
		}

	return $connection;
}















}













 ?>