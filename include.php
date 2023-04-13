<?php

require __DIR__.'/vendor/autoload.php'; // This loads the composer libraries


require_once('router.php');
require_once('environment.php');

/* API */
require_once('api/api.shared.php');
require_once('api/api.user.php');


/* Classes */
require_once("classes/class.sql.php");
require_once("classes/class.user.php");



?>