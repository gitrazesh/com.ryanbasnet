<?php 

namespace App\Controllers;


use PDO;
use App\Validation\Validator;
use Respect\Validation\Validator as v;


/**
 * Category Controller
 * @package App\Controllers
 * @access public
 * @author Ryan Basnet
 * @license sprouttech
 */
class CategoryController extends Controller{


	/**
	 * [getIndex retursns view all caegory page]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response
	 * @return [HTML]  [reurns view all category page]
	 */
	public function getIndex($request,$response){

		$category = $this->container->category->findAll($id=null);

		return $this->container->view->render($response,'admin/partials/category/category.twig',['category'=>$category]);


	}


	/**
	 * [addCategory add bloh cateegory]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response
	 * @return [HTML]  [redirects back with feedback]
	 */
	public function addCategory($request,$response){

		$rules = [

				'category'=>v::notEmpty()->alpha()
				
		];
		

		$validation = $this->container->validator->validate($request,$rules);

		if($validation->failed()){
			
			$category = $this->container->category->findAll($id=null);
			return $this->container
						->view->render($response,'admin/partials/category/category.twig',['category'=>$category,'errors'=>$validation->getError()]);
		}

		$data =array();
		$data['title'] = ucfirst($request->getParam('category'));
		$this->container->category->create($data);
		$this->container->flash->addMessage('success','Category is added.');
		return $response->withRedirect($this->container->router->pathFor('admin.category'));

		


	}

	/**
	 * [getUserForm returns category edit form]
	 * @param  [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML]           [edit va4egory form]
	 */
	public function editCategory($request,$response,$args){

		$category_id = $args['id'];
		$editCategory = $this->container->category->find($category_id);
		$category = $this->container->category->findAll($id=null);
		return $this->container->view->render($response,'admin/partials/category/category.twig',['category'=>$category,'editMode'=>TRUE,'editCategory'=>$editCategory]);


	}

	/**
	 * [updatreCategory update blog category]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML]  [redirect back with feedback]
	 */
	public function updateCategory($request,$response,$args){
				
				$category_id = $args['id'];
				$editCategory = $this->container->category->find($category_id);
				$category = $this->container->category->findAll($id=null);

			$rules = [

				'category'=>v::notEmpty()->alpha()
				
		];
		

		$validation = $this->container->validator->validate($request,$rules);

		if($validation->failed()){
			
			return $this->container->view->render($response,'admin/partials/category/category.twig',['category'=>$category,'editMode'=>TRUE,'editCategory'=>$editCategory,'errors'=>$validation->getError()]);
		}


	
		$data= array();
		$data['title'] = $request->getParam('category');
		$this->container->category->update($category_id,$data);
		$this->container->flash->addMessage('success',"Category updated successfully !");
		return $response->withRedirect($this->container->router->pathFor('admin.category'));

	}

	/**
	 * [destroyCategory delete category]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function destroyCategory($request,$response,$args){

		$user_id = $args['id'];
		$status = $this->container->category->delete($user_id);
		
		if($status){

			$this->container->flash->addMessage('success',"Category deleted successfully !");
		return $response->withRedirect($this->container->router->pathFor('admin.category'));
		}
		$this->container->flash->addMessage('fail',"Sorry, category could not be deleted !");
		return $response->withRedirect($this->container->router->pathFor('admin.category'));


	}





}

















 ?>