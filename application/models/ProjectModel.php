<?php	

class ProjectModel extends CI_Model {

	function __construct(){

		parent::__construct();
	}



	public function getProjectList(){

		$project_list=array();

		$this->db->select("project_name,project_url,project_image_name");
		$query=$this->db->get("project");

		foreach ($query->result() as $row) {
			$project= array(
						"project_name"=>$row->project_name,
						"project_url"=>$row->project_url,
						"project_image_name"=>$row->project_image_name
				);

			array_push($project_list,$project);
		}

		return $project_list;
	}

}

?>