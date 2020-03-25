<?php

class Router {

    public $request;
    public $uri;
    public $controller;
    public $action;
    public $parameters;
    private $method;

    public function route() {
        $this->request = new Request();
        $this->uri = $this->trim($this->request->uri);
        $this->method = $this->request->method;
        $this->getParameters();
    }

    public function trim($uri) {

        return trim($uri, '/');
    }

    public function getParameters()
    {
        $parameters = explode('/', $this->uri);

        if ($parameters[0] != '') {
            $this->controller = $parameters[0];
        } else $this->controller = 'index';

        if (isset($parameters[1])) {
            $this->action = $parameters[1];
        } else $this->action = 'index';

        if (isset($parameters[2])) {
            $this->parameters = $parameters[2];
        } else $this->parameters = '';
//        var_dump($parameters);


    }

    public function findController($string) {
        $string = ucfirst($string);
        $controller = $string . 'Controller';
        $this->controller = $controller;
        return $this->controller;
    }

    public function direct() {
        $this->route();

        if ($GLOBALS['debug']) {
            echo 'Controller: ' . $this->controller;
            echo ' Action: ' . $this->action;
            echo ' Parameters: ' . $this->parameters;
            echo '<br>';
        }

        $controller =  $this->findController($this->controller);
        $action = $this->action;
        $controller = new $controller;
        $controller->$action($this->parameters);
    }

}