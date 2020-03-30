<?php
session_start();
require_once "../Framework/Autoload.php";

$request = new Router();
$request->direct();

$performance->measure();
