<?php 

namespace App\Controllers;


use PDO;
use App\Services\Paginator as Paginator;
use App\Validation\Validator;
use Respect\Validation\Validator as v;


/**
 * Authentication Controller
 * @package App\Controllers
 * @access public
 * @author Ryan Basnet
 * @license sprouttech
 */
class CommentController extends Controller{


	/**
	 * [getIndex return view all comment page]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @return [type]           [description]
	 */
	public function getIndex($request,$response){

		$comment = $this->container->comment;
		//page if set
		$page =$request->getParam('page');
      	
      	$paginator =  new Paginator($this->container->connection);
      	$paginator->setQuery("SELECT * FROM comments ORDER BY comment_id DESC");
      	$results = $paginator->paginate(5,$page);
      	
      	$comments = $results->data;

      	$paginationLinks=$paginator->allpaginationLinks("/comments","pagination");

		return $this->container
					->view
					->render($response,'admin/partials/comment/view_all_comment.twig',['comments'=>$comments,'paginationLinks'=>$paginationLinks]);


	}


	/**
	 * [postComment post user comment]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function postComment($request,$response,$args){


		$post_id=$args['id'];
		
		$rules =  [

			'name'=>v::notEmpty()->alpha()->length(3,10),
			'email'=>v::notEmpty()->email(),
			'comment'=>v::notEmpty()
			];


		$validation = $this->container->validator->validate($request,$rules);

		if($validation->failed()){

			$this->container
				 ->flash
				 ->addMessage('fail',"Please enter all required fields.");

			return $response->withRedirect($this->container->router->pathFor('post.getPost',['id'=>$post_id]));
		}

		$data=array();
		$data['comment_author'] = ucfirst($request->getParam('name'));
		$data['comment_post_id'] = $post_id;
		$data['comment_author_email'] = $request->getParam('email');
		$data['comment'] = $request->getParam('comment');
		
		$this->container->comment->create($data);

		$this->container
			 ->flash
			 ->addMessage('success',"Thank you your comment has been submitted.");


		return $response->withRedirect($this->container->router->pathFor('post.getPost',['id'=>$post_id]));

	}



	/**
	 * [approveComment approve public user comment]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function approveComment($request,$response,$args){

		$comment_id =  $args['comment_id'];
		
		$this->container->comment->approveComment($comment_id);
		
		$this->container
			 ->flash
			 ->addMessage('success',"Comment is approved.");

		return $response->withRedirect($this->container->router->pathFor('admin.comments'));
		
	}



	/**
	 * [unapproveComment unapprove public user commment]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function unapproveComment($request,$response,$args){


		$comment_id =  $args['comment_id'];

		$this->container->comment->unapproveComment($comment_id);

		$this->container
			 ->flash
			 ->addMessage('success',"Comment is blocked.");


		return $response->withRedirect($this->container->router->pathFor('admin.comments'));


	}


	/**
	 * [deleteComment delete public user comment]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function deleteComment($request,$response,$args){


		$comment_id =  $args['comment_id'];

		$this->container->comment->delete($comment_id);

		$this->container
			 ->flash
			 ->addMessage('success',"Comment is deleted.");


		return $response->withRedirect($this->container->router->pathFor('admin.comments'));


	}



}



 ?>