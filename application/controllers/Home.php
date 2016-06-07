
<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @Author: Rajesh Basnet
 * @Date:   2016-05-20 12:44:36
 * @Last Modified by:   Rajesh Basnet
 * @Last Modified time: 2016-06-05 12:49:25
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

		$this->load->library('form_validation');

		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$message=$this->input->post('message');
		

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
				
			$data=array(

				"error"=>false,
				"message"=>"Thank you ".$name." for getting in touch.I will get back to you ASAP"
				);


		}

		else {
			

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

	public function getProjectList(){

		$this->load->model("ProjectModel");
		
		$project_list=$this->ProjectModel->getProjectList();
		
		return $project_list;
	}



public function testPage(){

		$this->load->view('test');

}	
	
}