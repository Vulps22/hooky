<?php
require_once('include.php');

$user = new User(5);
echo "User:\n";
var_dump($user->getUser());
echo "Profile:\n";
var_dump($user->getUserProfile());

?>