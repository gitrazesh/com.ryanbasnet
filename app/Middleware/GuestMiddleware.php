<?php 

namespace App\Middleware;


/**
 * Guest Middleware
 */
class GuestMiddleware extends Middleware {


	/**
	 * [__invoke description]
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $next     [description]
	 * @return [type]           [description]
	 */
	public function __invoke($request,$response,$next){

		if($this->container->auth->check()){


			return $response->withRedirect($this->container->router->pathFor('admin.dashboard'));
		}

		$response=$next($request,$response);
		return $response;
	}














}












 ?>