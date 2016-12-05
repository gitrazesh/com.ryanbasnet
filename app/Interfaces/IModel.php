<?php 

namespace App\Interfaces;


interface IModel{

	public function create($array);

	public function findAll($id=null);

	public function find($id);

	public function update($id,$array);

	public function  delete($id);

}


 ?>