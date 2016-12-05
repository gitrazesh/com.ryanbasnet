<?php 

namespace App\Models;

use \App\Interfaces\IModel as IModel;
use PDO;

class Comment extends Model implements  IModel{


	function __construct($connection){

		parent::__construct($connection);	
	}


	// /**
	//  * [create create a category ]
	//  * @return [void] 
	//  */
	// public function create($array){

	// 		$statement = $this->connection->prepare("INSERT INTO comments(comment_post_id,comment_author,comment_author_email,comment,comment_status,comment_date)
	// 											 VALUES(:comment_post_id,:comment_author,:comment_author_email,:comment,:comment_status,NOW())");
		
	// 	$statement->execute(array("comment_post_id"=>$array['comment_post_id'],
	// 								"comment_author"=> $array['comment_author'],
	// 								"comment_author_email"=>$array['comment_author_email'],
	// 								"comment"=>$array['comment'],
	// 								"comment_status"=>"unapproved"
	// 									 ));

	// }



	// /**
	//  * [findAll list all category]
	//  * @return [void] 
	//  */
	// public function findAll($id=null){
		
	// 	if(!isset($id)){

	// 		$statement = $this->connection->prepare("SELECT * FROM comments ORDER BY comment_id");
	// 		$statement->execute();
	// 		$comments = $statement->fetchAll(PDO::FETCH_ASSOC);	
		
	// 	}else{

	// 		$statement = $this->connection->prepare("SELECT * FROM comments WHERE comment_post_id =:id AND comment_status = 'approved' ORDER BY comment_id");
	// 		$statement->execute(array('id'=>$id));
	// 		$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

	// 	}
		
	// 	return $comments;
			
	// }


	// /**
	//  * [find find a category by id]
	//  * @param  [int] $id [category id]
	//  * @return [array]   [return database result set in associative array]
	//  */
	// public function find($id){


	// 	$statement = $this->connection->prepare("SELECT * FROM comments WHERE comment_id=:id");
	// 	$statement->execute(array('id'=>$id));
	// 	$post=$statement->fetch();
	// 	return $post;

	// }


	// /**
	//  * [update ]
	//  * @param  [int] $id [category id]
	//  * @param  [associative array] $array [properties to be updated ]
	//  * @return [void]     
	//  */
	// public function update($id,$array){}


	// /**
	//  * [delete comment]
	//  * @param  [int] $id [category id]
	//  * @return [void]   
	//  */
	// public function  delete($id){

	// 	$statement = $this->connection->prepare("DELETE  FROM comments WHERE comment_id=:id");
	// 	$statement->execute(array("id"=>$id));

	// 	$statement=$this->connection->prepare("SELECT comment_post_id as post_id from comments WHERE comment_id=:comment_id ");
	// 	$statement->execute(array(':comment_id'=>$comment_id));
		
	// 	$post_id =$statement->fetch(PDO::FETCH_COLUMN);
	// 	$statement = $this->connection->prepare("UPDATE posts SET comments_count=(comments_count-1) WHERE post_id=:post_id");
	// 	$statement->execute(array(':post_id'=>$post_id));
	
	
	// }

	// /**
	//  * [approveComment approve visitors comment]
	//  * @param  [int] $comment_id [commenvoid]
	//  * @return [void]             [description]
	//  */
	// public function approveComment($comment_id){

	// 	$statement = $this->connection->prepare("UPDATE comments SET comment_status='approved' WHERE comment_id=:comment_id");
	// 	$statement->execute(array(':comment_id'=>$comment_id));

	// 	$statement=$this->connection->prepare("SELECT comment_post_id as post_id from comments WHERE comment_id=:comment_id ");
	// 	$statement->execute(array(':comment_id'=>$comment_id));
		
	// 	$post_id =$statement->fetch(PDO::FETCH_COLUMN);
	// 	$statement = $this->connection->prepare("UPDATE posts SET comments_count=(comments_count+1) WHERE post_id=:post_id");
	// 	$statement->execute(array(':post_id'=>$post_id));
	
	// }

	// /**
	//  * [unapproveComment unapprove visitors comment]
	//  * @param  [int] $comment_id [commenvoid]
	//  * @return [void]             [description]
	//  */
	// public function unapproveComment($comment_id){

	// 	$statement = $this->connection->prepare("UPDATE comments SET comment_status='unapproved' WHERE comment_id=:comment_id");
	// 	$statement->execute(array(':comment_id'=>$comment_id));

	// 	$statement=$this->connection->prepare("SELECT comment_post_id as post_id from comments WHERE comment_id=:comment_id ");
	// 	$statement->execute(array(':comment_id'=>$comment_id));
	// 	$post_id =$statement->fetch(PDO::FETCH_COLUMN);
		
	// 	$statement = $this->connection->prepare("UPDATE posts SET comments_count=(comments_count-1) WHERE post_id=:post_id");
	// 	$statement->execute(array(':post_id'=>$post_id));

	// }
}




 ?>