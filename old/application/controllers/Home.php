
<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @Author: Rajesh Basnet
 * @Date:   2016-05-20 12:44:36
 * @Last Modified by:   Rajesh Basnet
 * @Last Modified time: 2016-07-30 10:31:11
 */



class Home extends CI_Controller{

	function __construct(){
		parent :: __construct();

	}


	public function index(){

		
		$data['skill_list']=$this->getSkillList();
		$data['project_list']=$this->getProjectList();
		$this->load->view('home',$data);
	}


	public function processEmail(){
		
		if (!$_SERVER['HTTP_REFERER']) {
			redirect('/home/test_page');
		}

		//load library
		$this->load->library('form_validation');  
                $this->load->library('email');
                $this->load->library('session');
	

		//get form value
		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$form_message=$this->input->post('message');
		
		//validation rules
		$config = array(

				//name
			array(

				'field'=>'name',
				'label'=>'name',
				'rules'=>'required|trim|min_length[5]|max_length[10]'
				),

			//email
			array(

				'field'=>'email',
				'label'=>'email',
				'rules'=>'required|trim|valid_email'

				),
			//message

			array(

				'field'=>'message',
				'label'=>'message',
				'rules'=>'required|trim|min_length[10]|max_length[200]'
				)



			);


		$this->form_validation->set_rules($config);


		if($this->form_validation->run()){
		
                $to="basnetrahzes@hotmail.com";
                $subject="ryanbasnet.xyz";
	     		$headers = "From: $email\r\n";
                $headers.="Reply-to: $email";
                $message=$form_message;
                $sent = mail($to, $subject, $message, $headers);
      			
      		if($sent){
     			
	     			$alert ='<div class="alert alert-success" id="alert">
	                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                                 <strong>Thank you '.$name.' </strong> for getting in touch.I will get back to you ASAP';

					$data=array(
						"error"=>false,
						"message"=>$alert
					);


			}else{
			       $alert ='<div class="alert alert-danger" id="alert">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Sorry</strong>, email not sent.Something went wrong, try again.';

					$data=array(
						"error"=>false,
						"message"=>$alert
						);
			} 
		}else {
			
			$errors=$this->form_validation->error_array();
			$data=array(
				"error"=>true,
				"errors"=>$errors
				);
		}

		
		echo json_encode($data);
		exit;
		
		
	}

	private function getSkillList(){

		$this->load->model('SkillModel');
		return $this->SkillModel->getSkillList();


	}

	private function getProjectList(){

		$this->load->model("ProjectModel");
		
		$project_list=$this->ProjectModel->getProjectList();
		
		return $project_list;
	}




}
