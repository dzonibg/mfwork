<?php
/*
Load performance meter*/

require_once '../Framework/PerformanceMeter.php';
$performance = new PerformanceMeter();
$performance->start();

/*Load Config File*/
require_once("../config.php");

/*Load Helpers*/

foreach (glob("../Framework/helpers/*") as $filename)
{
    require_once($filename);
}

/*Load Framework*/

foreach (glob("../Framework/*.php") as $filename)
{
    require_once($filename);
}

/*Load Controllers*/

foreach (glob("../Controllers/*.php") as $filename)
{
    require_once($filename);
}

/*Load Models*/

foreach (glob("../Models/*.php") as $filename)
{
    require_once($filename);
}

