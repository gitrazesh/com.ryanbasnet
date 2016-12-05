<?php

/**
 * @Author: Ryan Basnet
 * @Date:   2016-11-07 09:33:39
 * @Last Modified by:   Ryan Basnet
 * @Last Modified time: 2016-12-05 19:26:36
 */

session_start();
date_default_timezone_set('Australia/Sydney');

require __DIR__ . '/../vendor/autoload.php';


/** Test */
$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();


/**
 * Configuration
 */

$config['settings']['displayErrorDetails'] = true;



/**
 * Slim app instantiation
 * 
 */
$app = new \Slim\App($config);



/**
 * Dependency Injection Container
 */

$container = $app->getContainer();


/**
 * Database Conection Setup
 */

$container['connection'] = function($container){

return \App\Services\DbConnection::getConnection();

};


/**
 * Service Provider Registration
 */

/** csrf middleware **/

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};

/** Flash Message */
$container['flash'] = function ($container){

	return new \Slim\Flash\Messages();
};

/** view  **/
$container['view'] = function ($container){


	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views',[

		'cache' => false,
		'debug'=>true,

		]);

	// Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    
    $view->addExtension(new Twig_Extension_Debug());

    //set global variable in view
    $view->getEnvironment()->addGlobal('flash',$container->flash->getMessages());
    $view->getEnvironment()->addGlobal('loggedUser',$container->auth->user());
    $view->getEnvironment()->addGlobal('isLoggedIn',$container->auth->check());
	
	return $view;
};


/** Validator  */
$container['validator'] = function ($container){

	return new App\Validation\Validator();
};


/** Auth Middleware */

$container['auth'] = function($container){

	return new \App\Auth\Auth($container);
};

/** class to check resource ownership **/
$container['owner'] = function($container){

	return new \App\Auth\CheckOwnership($container);
};



/**
 * Controller Registration
 */



$container['AuthController'] = function($container){

	return new \App\Controllers\Auth\AuthController($container);
};
$container['PasswordController'] = function($container){

	return new \App\Controllers\Auth\PasswordController($container);
};



$container['PageController'] = function($container){

	return new \App\Controllers\PageController($container);
};


$container['UserController'] = function($container){

	return new \App\Controllers\UserController($container);
};


$container['CategoryController'] = function($container){

	return new \App\Controllers\CategoryController($container);
};

$container['PostController'] = function($container){

	return new \App\Controllers\PostController($container);
};

$container['CommentController'] = function($container){

	return new \App\Controllers\CommentController($container);
};



/**
 * Model Registration
 */

/** User **/
$container['user'] = function($container){

	$connection = $container->connection;
	return new \App\Models\User($connection);
};


/** Category **/
$container['category'] = function($container){

	$connection = $container->connection;
	return new \App\Models\Category($connection);
};


/** Post  **/
$container['post'] = function($container){

	$connection = $container->connection;
	return new \App\Models\Post($connection);
};


/** Comment */
$container['comment'] = function($container){

	$connection = $container->connection;
	return new \App\Models\Comment($connection);
};


/** Password reset */
$container['passwordReset'] = function($container){

	$connection = $container->connection;
	return new \App\Models\PasswordReset($connection);
};


$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfMiddleware($container));

$app->add($container->get('csrf'));



/**
 * Error Handler
 */

//404
$container['notFoundHandler'] = function ($container) {
 
 	return function ($request, $response) use ($container) {

 		$container->view->render($response,'errors/404error.twig',['errorStatusCode'=>'404','errorStatusMessage'=>'Page Not Found']);
 
  		return $response->withStatus(404);          
		};
};

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {

        $container->view->render($response,'errors/505error.twig',['errorStatusCode'=>'500','errorStatusMessage'=>'Sorry, something went wrong.']);
 
  		return $response->withStatus(404); 
    };
};



/**
 * Routes
 */

require __DIR__ .'/../app/Route/routes.php';


?>