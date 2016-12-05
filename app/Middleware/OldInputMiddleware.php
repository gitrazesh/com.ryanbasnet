<?php

namespace App\Middleware;

/**
 * Old FOrm Data persiting middleware
 */
class OldInputMiddleware extends Middleware{



public function __invoke($request,$response,$next){

$_SESSION['old']= $request->getParams();
$this->container->view->getEnvironment()->addGlobal('oldInput',$_SESSION['old']);



$response = $next($request,$response);
return $response;



}










}












 ?>