<?php

namespace Framework;
use Framework\DatabaseConnector;

class Commander {
    public function __construct($arguments) {
        $argumentsCount = count($arguments);
        echo "- MFW commander start -\n";
        echo "- Arguments count: $argumentsCount  -\n";
        foreach ($arguments as $argument) {
            echo "$argument \n";
        }
    }

    public function __destruct()
    {
        echo "- MFW commander out -\n";
    }

    public function test() {
        return "Test complete!";
    }
}