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
	public function validate($request,$rules){

		foreach ($rules as $field => $rule) {

			try{

				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			
			}catch(NestedValidationException $e){

				$this->error[$field] = $e->getMessages();
			}
		}
		
		return $this;
	}


	
}


