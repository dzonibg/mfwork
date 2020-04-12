<?php
session_start();
require_once "../Framework/Autoload.php";
bs()->title("MFWork v0.1");

$request = new Router();
$request->direct();

$performance->measure();
