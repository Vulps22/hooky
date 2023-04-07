<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
require_once('classes/class.sql.php');

require_once('router.php');
require_once('api/api.shared.php');
require_once('api/api.user.php');

try{

	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST');
		header('Access-Control-Allow-Headers: Content-Type');
		header('Access-Control-Max-Age: 86400');
		exit;
	  }
	  

$router = new Router();

$router->add_route('GET', '/ping', 'UserAPI@ping');

// Register routes for the AppAPI controller
$router->add_route('POST', '/user/register', 'UserAPI@register');
$router->add_route('POST', '/user/login', 'UserAPI@login');

// Handle the incoming request using the router
$router->handle_request();

}catch(Exception $err) {
	var_dump($err->message);
}

?>