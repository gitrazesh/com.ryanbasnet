<?php 

namespace App\Models;

use \App\Interfaces\IModel as IModel;
use PDO;



class Category extends Model implements  Imodel{


	function __construct($connection){

		parent::__construct($connection);
	}


	/**
	 * [create create a category ]
	 * @return [void] 
	 */
	public function create($array){

		$statement = $this->connection->prepare("INSERT INTO categories(cat_title) VALUES(:title)");
		$statement->execute(array( "title"=>$array['title']));

	}



	/**
	 * [findAll list all category]
	 * @return [voiarray['title']
	 */
	public function findAll($id=null){

		try{
		$statement = $this->connection->prepare("SELECT * FROM categories");
		$statement->execute();
		$categories = $statement->fetchAll(PDO::FETCH_ASSOC);	
		
		return $categories;

		} catch (PDOException $e){

		
       		throw new PDOException($e);
		}

			
	}


	/**
	 * [find find a category by id]
	 * @param  [int] $id [category id]
	 * @return [array]   [return database result set in associative array]
	 */
	public function find($id){

		try{

		$statement = $this->connection->prepare("SELECT * FROM categories WHERE cat_id=:id");
		$statement->execute(array('id'=>$id));
		$post=$statement->fetch();
		
		return $post;
		} catch (PDOException $e){

		
       		throw new PDOException($e);
		}

	}


	/**
	 * [update category]
	 * @param  [int] $id [category id]
	 * @param  [associative array] $array [properties to be updated ]
	 * @return [void]     
	 */
	public function update($id,$array){

		$title = $array['title'];
		$stmt = $this->connection->prepare("UPDATE categories SET cat_title=:title WHERE cat_id=:id");
		$stmt->execute(array(':title'=>$title,':id'=>$id));
	}


	/**
	 * [delete category]
	 * @param  [int] $id [category id]
	 * @return [void]   
	 */
	public function  delete($id){

		try{

			$statement = $this->connection->prepare("DELETE  FROM categories WHERE LOWER(cat_id)=:id");
			$statement->execute(array("id"=>$id));
			return true;

		} catch (PDOException $e){

		
       		return false;
		}
	}


	public function findByTitle($title){

		$statement = $this->connection->prepare("SELECT * FROM categories WHERE cat_title=:title");
		$statement->execute(array('title'=>$title));
		$category=$statement->fetch();
			
		return $category;
	}

}
 



?>