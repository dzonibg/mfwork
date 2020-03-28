<?php
session_start();
$time_start = microtime(true);
require_once "../Framework/Autoload.php";
$request = new Router();
$request->direct();

if ($GLOBALS['debug'] == true) {
    $time_end = microtime(true);
    $execution_time = ($time_end - $time_start)*1000;
    echo '<br>' . $execution_time . 'ms seconds exec time.' ;
}