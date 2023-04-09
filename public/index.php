<?php

use Framework\Router;

session_start();
//require_once "../Framework/Autoload.php";
require_once "../Framework/FrameworkAutoload.php";

$request = new Router();
$request->direct();

$performance->measure();
