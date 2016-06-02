<?php 



class SkillModel extends CI_Model{
	

	function __construct(){

		parent::__construct();
	}


	//Return skill lists
	public function getSkillList(){

		$skill_list= array();
		
		$this->db->select('skill_id,skill_name,skill_level,skill_color_code');
		$query=$this->db->get('skill');

		foreach ($query->result() as $row) {
			$skill=array ("skill_id"=>$row->skill_id,
					 "skill_name"=>$row->skill_name,
					  "skill_level"=>$row->skill_level,
					  "skill_color_code"=>$row->skill_color_code);

			array_push($skill_list, $skill);
		
		}

		return $skill_list;

	}
}

?>