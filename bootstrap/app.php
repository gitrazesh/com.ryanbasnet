<?php

/**
 * @Author: Ryan Basnet
 * @Date:   2016-11-07 09:33:39
 * @Last Modified by:   Ryan Basnet
 * @Last Modified time: 2016-12-05 19:26:36
 */


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

// $container['csrf'] = function ($container) {
//     return new \Slim\Csrf\Guard;
// };

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
    // $view->getEnvironment()->addGlobal('flash',$container->flash->getMessages());
    // $view->getEnvironment()->addGlobal('loggedUser',$container->auth->user());
 
	
	return $view;
};


/** Validator  */
$container['validator'] = function ($container){

	return new App\Validation\Validator();
};




/**
 * Controller Registration
 */





$container['PageController'] = function($container){

	return new \App\Controllers\PageController($container);
};




/**
 * Model Registration
 */

/** Projects **/
$container['project'] = function($container){

$connection = $container->connection;
return new \App\Models\Project($connection);
 };

 /** Skill **/
$container['skill'] = function($container){

$connection = $container->connection;
return new \App\Models\Skill($connection);
 };

/**
 * Error Handler
 */

//404
// $container['notFoundHandler'] = function ($container) {
 
//  	return function ($request, $response) use ($container) {

//  		$container->view->render($response,'errors/404error.twig',['errorStatusCode'=>'404','errorStatusMessage'=>'Page Not Found']);
 
//   		return $response->withStatus(404);          
// 		};
// };

// $container['errorHandler'] = function ($container) {
//     return function ($request, $response, $exception) use ($container) {

//         $container->view->render($response,'errors/505error.twig',['errorStatusCode'=>'500','errorStatusMessage'=>'Sorry, something went wrong.']);
 
//   		return $response->withStatus(404); 
//     };
// };



/**
 * Routes
 */

require __DIR__ .'/../app/Route/routes.php';


?>