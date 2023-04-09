<?php

namespace Framework;

/*
 *  Framework Bootstrapper. Loads the entire framework.
 *  Switching to PSR-4.
 */

//use Framework\PerformanceMeter;
require_once '../Framework/PerformanceMeter.php';
$performance = new PerformanceMeter();
$performance->start();

require_once '../vendor/autoload.php';
require_once '../Framework/helpers/helpers.php';
require_once '../config.php';