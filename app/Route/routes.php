<?php 

use \App\Middleware\GuestMiddleware;
use \App\Middleware\AuthMiddleware;
use \App\Middleware\AdminMiddleware;

/**
 * Public Page Routes
 */

$app->get('/' ,'PageController:getIndex')
	->setName('home');
$app->post('/processEmail' ,'PageController:sendEmail');
	
?>