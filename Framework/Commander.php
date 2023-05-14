<?php

namespace Framework;
use Framework\DatabaseConnector;

/*
 *  First argument will be the command name. Rest are the parameters.
 */

class Commander {
    public function __construct($arguments) {
        $argumentsCount = count($arguments);
        echo "- MFW commander start -\n";
        echo "- Arguments count: $argumentsCount  -\n";
        foreach ($arguments as $argument) {
            echo "$argument \n";
        }

        //var_dump("Commands/".ucfirst($arguments[1])."::class");
        //return a new Command.

    }

    public function __destruct()
    {
        echo "- MFW commander out -\n";
    }

    public function test() {
        return "Test complete!";
    }
}