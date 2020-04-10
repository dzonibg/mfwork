<?php

class ChainController {

    public $total;

    public function add($value) {
        $this->total = $this->total + $value;
        return $this;
    }

    public function sub($value) {
        $this->total = $this->total - $value;
        return $this;
    }

    public function value() {
        $this->add(1)->add(2);
    }


}