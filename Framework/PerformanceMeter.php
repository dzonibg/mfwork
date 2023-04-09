<?php

namespace Framework;

class PerformanceMeter {
    public $time_start;
    public $time_end;
    public $execution_time;

    public function start() {
        $this->time_start = microtime(true);
    }

    public function end() {
        if ($GLOBALS['debug'] == true) {
            $this->time_end = microtime(true);
        }
    }

    public function measure() {
        if ($GLOBALS['debug'] == true) {
            $this->end();
            $this->execution_time = ($this->time_end - $this->time_start) * 1000;
            echo '<br><span style="border: 1px solid brown">' . $this->execution_time . 'ms seconds exec time.';
            echo '</span>';
        }
    }

}