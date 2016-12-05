<?php 

namespace App\Models;

use PDO;
use \App\Interfaces\IModel as IModel;

class Post extends Model implements  IModel{


	function __construct($connection){

		parent::__construct($connection);

		
	}

	/**
	 * [create create a post ]
	 * @return [void] 
	 */
	public function create($array){


		try {
		

			$statement = $this->connection->prepare("INSERT INTO posts(title,content,image_path,tags,author,status,cat_id) 
													VALUES(:title,:content,:image_path,:tags,:author,:status,:cat_id)");
			
			$status = $statement->execute(array(	":title"=>$array['title'],
										":content"=> $array['content'],
										":image_path"=>$array['image_path'],
										":tags"=>$array['tags'],
										":author"=>$array['author'],
										":status"=>$array['status'],	
										":cat_id"=>$array['cat_id'] ));


		} catch (\PDOException $e) {

			throw new Exception("Sorry some thing went wrong");
		
		}

	}



	/**
	 * [findAll list all post]
	 * @return [void] 
	 */
	public function findAll($id=null){

		$statement = $this->connection->prepare("SELECT * FROM posts ORDER BY post_id");
		$statement->execute();
		$posts = $statement->fetchAll(PDO::FETCH_ASSOC);	
		return $posts;
			
	}


	/**
	 * [find find a post by id]
	 * @param  [int] $id [post id]
	 * @return [array]   [return database result set in associative array]
	 */
	public function find($id){

		try {

		$statement = $this->connection->prepare("SELECT * FROM posts WHERE post_id=:id");
		$statement->execute(array('id'=>$id));
		$post=$statement->fetch();
		return $post;

		} catch (\PDOException $e) {

			throw new Exception("Sorry some thing went wrong");
		
		}


	}


	public function findByCategory($category_id){


			$statement = $this->connection->prepare("SELECT * FROM posts WHERE cat_id=:cat_id AND status='published' ORDER BY post_id DESC LIMIT 3");
			$statement->execute(array('cat_id'=>$category_id));
			$post=$statement->fetchAll();
			return $post;


		}

	/**
	 * [update post]
	 * @param  [int] $id [post id]
	 * @param  [associative array] $array [properties to be updated ]
	 * @return [void]     
	 */
	public function update($id,$array){

	
		$statement = $this->connection->prepare(" UPDATE posts SET title=:title,content=:content,tags=:tags,status=:status,cat_id=:cat_id WHERE post_id=:post_id ");
		$statement->execute(array(	"title"=>$array['title'],
								"content"=> $array['content'],
								"tags"=>$array['tags'],
								"status"=>$array['status'],
								"cat_id"=>$array['cat_id'],
								"post_id"=>$id));



	}


	/**
	 * [delete post]
	 * @param  [int] $id [post id]
	 * @return [void]   
	 */
	public function  delete($id){

		try{
		
			$statement = $this->connection->prepare("DELETE  FROM posts WHERE post_id=:id");
			$statement->execute(array("id"=>$id));
			
				return true;
	
		} catch (\PDOException $e){
	
		
       		return false;
		}
	}



	public function findRecent(){

		$statement = $this->connection->query("SELECT * FROM posts WHERE status='published' ORDER BY post_id DESC LIMIT 3");
		$statement->execute();
		$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
				
		return $posts;
	}


	public function findFeatured(){

		$statement = $this->connection->query("SELECT * FROM posts WHERE status='published' ORDER BY post_id DESC LIMIT 10");
		$statement->execute();
		$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
				
		return $posts;
	}



	/**
	 * [find find a post by id]
	 * @param  [int] $id [post id]
	 * @return [array]   [return database result set in associative array]
	 */
	public function where($key,$value){


		$statement = $this->connection->prepare("SELECT * FROM posts WHERE $key=:value");
		$statement->execute(array('value'=>$value));
		$post=$statement->fetchAll(PDO::FETCH_ASSOC);
		return $post;


	}


}
 ?>