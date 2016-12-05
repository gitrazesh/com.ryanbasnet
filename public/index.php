<?php 

/**
 * @Author: Ryan Basnet
 * @Date:   2016-11-07 09:33:39
 * @Last Modified by:   Ryan Basnet
 * @Last Modified time: 2016-11-24 14:58:36
 */

/**
 * A global access point of the application
 * configuration and DIC registration is on bootstrap/app.php 
 * Routes file is in Route/routes.php
 */

require __DIR__ .'/../bootstrap/app.php';

$app->run();


 ?>