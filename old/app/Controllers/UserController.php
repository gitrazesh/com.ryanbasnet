<?php 

namespace App\Controllers;
use PDO;
use App\Validation\Validator;
use Respect\Validation\Validator as v;
use App\Services\Aws\AmazonService;
use App\Aws\Exceptions\S3Exception;


class UserController extends Controller{


	/**
	 * [getIndex return all users]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [HTML]           [return all users]
	 */
	public function getIndex($request,$response){

		$user = $this->container->user;
		$admin_id = $this->container->auth->user()['user'];
		
		$users = $user->findAll($admin_id);
		
		return $this->container->view->render($response,'admin/partials/user/view_all_user.twig',['users'=>$users]);


	}

	/**
	 * [getUserForm description]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function getUserForm($request,$response){

		$statement=$this->container->connection->prepare("SELECT * from user_role");
    	$statement->execute();
    	$roles =$statement->fetchAll(PDO::FETCH_ASSOC);
		return $this->container->view->render($response,'admin/partials/user/add_user.twig',['roles'=>$roles]);


	}

	/**
	 * [postUser description]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function postUser($request,$response){

		// respect validation rules
		$rules = [

				'first_name'=>v::notEmpty()->alpha()->length(5,10),
				'last_name'=>v::notEmpty()->alpha()->length(5,10),
				'email'=>v::notEmpty()->email(),
				'password'=>v::noWhiteSpace()->notEmpty()->length(5,10),
				


		];
		
		// @see App\Validation\Validator
		$validation = $this->container->validator->validate($request,$rules);
		if($validation->failed()){

			return $this->container->view->render($response,'admin/partials/user/add_user.twig',['errors'=>$validation->getError()]);
			
		}

		$data =array();
		$data['first_name']= $request->getParam('first_name');
		$data['last_name']= $request->getParam('last_name');
		$data['email']= $request->getParam('email');
		$data['password']= password_hash($request->getParam('password'),PASSWORD_DEFAULT);
		$data['role_id']= $request->getParam('role');

		$this->container->user->create($data);
		$this->container->flash->addMessage('success',"User added successfully !");
		return $response->withRedirect($this->container->router->pathFor('admin.addUser'));

	}

	/**
	 * [getUserForm description]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function editUser($request,$response,$args){

		$user_id = $args['id'];
		$user = $this->container->user->find($user_id);
		return $this->container->view->render($response,'admin/partials/user/edit_user.twig',['user'=>$user]);


	}

	/**
	 * [getUserForm description]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function updateUser($request,$response,$args){

		$user_id = $args['id'];


		// respect validation rules
		$rules = [

				'first_name'=>v::notEmpty()->alpha()->length(5,10),
				'last_name'=>v::notEmpty()->alpha()->length(5,10),
				'email'=>v::notEmpty()->email(),
				
		];

		// @see App\Validation\Validator
		$validation = $this->container->validator->validate($request,$rules);
		if($validation->failed()){

			$this->container->view->getEnvironment()->addGlobal('errors',$validation->getError());
			$this->container->flash->addMessage('fail',"Please enter required fields !");
			$user = $this->container->user->find($user_id);
			// return $this->container->view->render($response,'admin/partials/user/edit_user.twig',['user'=>$user]);
			return $response->withRedirect($this->container->router->pathFor('admin.editUser',['id'=>$user_id,'errors'=>$validation->getError()]));
		}



		$data =array();
		$data['first_name']= $request->getParam('first_name');
		$data['last_name']= $request->getParam('last_name');
		$data['user_email']= $request->getParam('email');
		$data['password']= password_hash($request->getParam('password'),PASSWORD_DEFAULT);
		$data['role_id']= $request->getParam('role');

		$user = $this->container->user->update($user_id,$data);
		$this->container->flash->addMessage('success',"User updated successfully !");
		return $response->withRedirect($this->container->router->pathFor('admin.users'));


	}




	/**
	 * [getUserForm description]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function destroyUser($request,$response,$args){

		$user_id = $args['id'];
		$status = $this->container->user->delete($user_id);
		if($status){

			$this->container->flash->addMessage('success',"User Deleted successfully !");
		return $response->withRedirect($this->container->router->pathFor('admin.users'));
		}
		$this->container->flash->addMessage('fail',"Sorry user could not be deleted !");
		return $response->withRedirect($this->container->router->pathFor('admin.users'));


	}



	/**
	 * [getUserForm description]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function getProfile($request,$response){

		$user_id = $this->container->auth->user()['user'];
		$user=$this->container->user->find($user_id);
		return $this->container->view->render($response,'admin/partials/user/profile.twig',['user'=>$user]);


	}


	/**
	 * [getUserForm description]
	 * [HTTP request object] $request 
	 * @param  [HTTP response object] $response 
	 * @return [type]           [description]
	 */
	public function updateProfile($request,$response){

		//user id
		$user_id = $this->container->auth->user()['user'];
		$currentUser = $this->container->user->find($user_id);
			// respect validation rules
		$rules = [

				'first_name'=>v::notEmpty()->alpha()->length(5,10),
				'last_name'=>v::notEmpty()->alpha()->length(5,10),
				'email'=>v::notEmpty()->email(),
				
		];

		$validation = $this->container->validator->validate($request,$rules);

		$fileType= ['png','jpeg','jpg',];
    	$file['image'] = $_FILES['profile_image']['name'];
   		$file['size'] = $_FILES['profile_image']['size'];

    	$imageRules = [ 

       
        'fileType'=>$fileType,
        'fileSize'=>'10000000'


          ];
     
     if(is_uploaded_file($_FILES['profile_image']['tmp_name'])){
     	$validation->validateImage($request,$file,$imageRules);

     }

     if($validation->failed()){
			$this->container->view->getEnvironment()->addGlobal('errors',$validation->getError());
			$this->container->flash->addMessage('fail',"Please enter all fields!");
			return $response->withRedirect($this->container->router->pathFor('user.profile'));
		}
  

  if(is_uploaded_file($_FILES['profile_image']['tmp_name']) && empty($validation->failed()) ){
     	
     	//upload-image
	$name = $request->getParam('first_name')."_".$request->getParam('last_name');
    $fileExt = strtolower(end(explode(".",$file['image'])));
    $imageName = md5(uniqid())."_".date("d-m-y")."_".$name.".".$fileExt;
    $image_temp = $_FILES['profile_image']['tmp_name'];
    $tempLocation=__DIR__."/../../resources/tmp_image/$imageName";
    $objectKey ="user_profile_images/{$imageName}";
    $oldObjectKey = "user_profile_images/".$currentUser['image_path']."";
    
    move_uploaded_file($image_temp,$tempLocation);
    $awsClient = new AmazonService();
 
      $awsClient->uploadObject($objectKey,$tempLocation);
      $awsClient->deleteObject($oldObjectKey);
     
     }


	

//upload image
		$data =array();
		$data['first_name']= $request->getParam('first_name');
		$data['last_name']= $request->getParam('last_name');
		$data['user_email']= $request->getParam('email');
		
		$old_image_path = $this->container->user->find($user_id)['image_path'];
		$data['image_path']= (!empty($imageName))? $imageName : $old_image_path;
		$user = $this->container->user->updateProfile($user_id,$data);
		$this->container->flash->addMessage('success',"Successfully update profile!");
		return $response->withRedirect($this->container->router->pathFor('user.profile'));


	}


}

















 ?>