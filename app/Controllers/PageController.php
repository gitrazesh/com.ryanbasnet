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
		$skills = $this->container->skill->findAll();
	
		return $this->container
					->view
					->render($response,'index.twig',['projects'=>$projects,'skills'=>$skills]);


	}

	public function sendEmail($request,$response){
		
		$input = $request->getBody();
		$data=parse_str($input);
 // 
		
		
		$data = $request->getParsedBody();
		$rules=[

				'name'=>v::notEmpty()->alpha(),
				'email'=>v::notEmpty()->email(),
				'message'=>v::notEmpty()->alnum(),


				];
				//dd($data);
		// return $response->withJson($parsedBody,200);
	
		$validator = $this->container->validator->validate($data,$rules);
		
		

		if($validator->failed()){
			return $response->withJson($validator->getError(),422);
			
		
		}else{

		return $response->withJson($data,200);
			
		}
			

		 // $data = ['errors'=>'sorry'];
		 // $data=$request->parseBody();
		 // $newResponse = $oldResponse->withHeader('Content-type', 'application/json');
		 // $newResponse = $oldResponse->withJson($data);

		 // return $newResponse;

	}


}
?>