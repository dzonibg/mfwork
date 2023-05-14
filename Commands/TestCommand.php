<?php
/*
 *  A test command used to print out the arguments. Nothing fancy.
 */

namespace Commands;

class TestCommand extends Command {

    public function __construct($arguments)
    {
        parent::__construct($arguments);
        echo "Hello. I'm a test command. I'll just spill out the arguments you've sent me.\n";
        foreach ($arguments as $argument) {
            echo "$argument\n";
        }
    }

}