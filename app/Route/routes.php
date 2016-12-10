<?php 

use \App\Middleware\GuestMiddleware;
use \App\Middleware\AuthMiddleware;
use \App\Middleware\AdminMiddleware;

/**
 * Public Page Routes
 */


//home
$app->get('/' ,'PageController:getIndex')
	->setName('home');

	//process contact form
$app->get('/project/{id}' ,'PageController:getProject');

//process contact form
$app->post('/processEmail' ,'PageController:sendEmail');

?>