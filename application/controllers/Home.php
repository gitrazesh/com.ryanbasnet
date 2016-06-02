
<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @Author: Rajesh Basnet
 * @Date:   2016-05-20 12:44:36
 * @Last Modified by:   Rajesh Basnet
 * @Last Modified time: 2016-05-29 21:52:23
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


	public function sendEmail(){
		$name;
		$email;
		$message;
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

	public function test(){

		$this->load->model("ProjectModel");
		$project_list=$this->ProjectModel->getProjectList();
		var_dump($project_list);
	}
}