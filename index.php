<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');

require_once('include.php');

try{

	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST');
		header('Access-Control-Allow-Headers: Content-Type');
		header('Access-Control-Max-Age: 86400');
		exit;
	  }
	  

	  // Allow access to the /assets directory
	if(preg_match('/\.(?:png|jpg|jpeg|gif|ico)$/', $_SERVER["REQUEST_URI"])) {
		return false;    // serve the requested resource as-is.
	}


	//Load Environment Variables
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$router = new Router();

	$router->add_route('GET', '/ping', 'UserAPI@ping');

	// Register routes for the UserAPI controller
	$router->add_route('POST', '/user/register', 'UserAPI@register');
	$router->add_route('POST', '/user/login', 'UserAPI@login');
	$router->add_route('POST', '/user/save_profile', 'UserAPI@save_profile');

	// Handle the incoming request using the router
	$router->handle_request();

}catch(Exception $err) {
	var_dump($err->message);
}

?>