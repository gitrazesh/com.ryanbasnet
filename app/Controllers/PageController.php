<?php 

namespace App\Controllers;



use Respect\Validation\Validator as v;
use Swift\Swift_MailTransport;
use Swift\Swift_Message;
use App\Services\SendGrid\SendgridEmailService;



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

	/**
	 * [getProject description]
	 * @param  [type] $request [description]
	 * @param  [type] $rules   [description]
	 * @return [JSON]          [return project/error]
	 */
	public function getProject($request,$response,$args){

		$project_id=$args['id'];
		$project = $this->container->project->find($project_id);
		return $response->withJson($project,200);

	}



	/**
	 * [sendEmail send contact form message]
	 * @param  [Request] $request  [description]
	 * @param  [Response] $response [description]
	 * @return [json]   [json response with status code]
	 */
	public function sendEmail($request,$response){
		
		//parse request quesry strign into php array
		
		$input = $request->getBody();
		$data=parse_str($input);
		$data = $request->getParsedBody();
		

		$rules=[

				'name'=>v::notEmpty()->alpha(),
				'email'=>v::notEmpty()->email(),
				'message'=>v::notEmpty()->alnum(),


				];
				
		//request validation
			
		$validator = $this->container->validator->validate($data,$rules);
		
		
		//send error on validation fail
		
		if($validator->failed()){
			
			return $response->withJson($validator->getError(),422);
			
		
		}else{


			$sendgridService 	= new SendGridEmailService();
			$data['from']		= $data['email']; 
			$data['to']			= "rajesh2045@gmail.com"; 
			$data['subject']	= 'Portfolio contact form';
			$data['message']	= $data['message']; 
			$status = $sendgridService->sendEmail($data);


			return $response->withJson($data,200);
			
		}
		

	}

	



}
?>