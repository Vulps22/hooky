<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

foreach ($_ENV as $key => $value) {
    define($key, $value);
}

?>