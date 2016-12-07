<?php

namespace App\Validation;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 * 
 */
class Validator{
	
	protected $error;


	public function __construct(){}
	

	/**
	 * [validate description]
	 * @param  [type] $request [description]
	 * @param  [type] $rules   [description]
	 * @return [type]          [description]
	 */
	public function validate($data,$rules){

		
		foreach ($rules as $field => $rule) {

			try{

				$rule->setName(ucfirst($field))->assert($data[$field]);
			
			}catch(NestedValidationException $e){

				$this->error[$field] = $e->getMessages();
			}
		}
		
		return $this;
	}

	/**
	 * [failed description]
	 * @return [type] [description]
	 */
	public function failed(){
		
		return !empty($this->error);
	}

/**
	 * [getError description]
	 * @return [type] [description]
	 */
	public function getError(){
		return $this->error;
	}
	
}


