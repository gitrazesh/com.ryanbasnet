<?php

namespace App\Middleware;

/**
 * Admin middleware
 */
class AdminMiddleware extends Middleware {

	public function __construct($container){

		parent::__construct($container);
	}

	/**
	 * [__invoke description]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $next     [description]
	 * @return [type]           [description]
	 */
	public function __invoke($request,$response,$next){

		if(!$this->container->auth->check()){

			$this->container->flash->addMessage('fail','Please login to proceed.');
			return $response->withRedirect($this->container->router->pathFor('admin.signin'));
		}
		
		$role_id = $this->container->auth->user()['role_id'];
		if($role_id !=1){

			$this->container->flash->addMessage('fail','Not authorize to perform action !');
			return $response->withRedirect($this->container->router->pathFor('admin.dashboard'));
		}

		$response=$next($request,$response);
		return $response;
	}
}