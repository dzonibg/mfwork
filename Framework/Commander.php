<?php

namespace Framework;
use Framework\DatabaseConnector;

class Commander {
    public function __construct() {
        echo "- MFW commander start -\n";
    }

    public function __destruct()
    {
        echo "- MFW commander out -\n";
    }

    public function test() {
        return "Test complete!";
    }
}