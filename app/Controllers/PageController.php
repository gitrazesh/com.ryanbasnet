<?php 

namespace App\Controllers;



use Respect\Validation\Validator as v;


class PageController extends Controller{



	/**
	 * [getIndex return homepage
	 * ]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @return [type]           [description]
	 */
	public function getIndex($request,$response){
		$projects = $this->container->project->findAll();
	
		return $this->container
					->view
					->render($response,'index.twig',['projects'=>$projects]);


	}


}
?>