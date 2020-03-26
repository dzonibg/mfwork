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

    public function getParameters() //TODO Split into methods and add more checks!
    {
        $parameters = explode('/', $this->uri);

        if ($parameters[0] == '') $this->controller = $this->findController('index');

        if ($parameters[0] != '') {
            $this->controller = $this->findController($parameters[0]);
            if (!class_exists($this->controller)) {
                $this->controller = "ErrorHandler";
                $this->action = "classNotFound";
            }
        }

        $this->action = 'index';
        if (isset($parameters[1])) {
            if (method_exists($this->controller, $parameters[1])) {
                $this->action = $parameters[1];
            } else {
                $this->controller = "ErrorHandler";
                $this->action = "methodNotFound";
            }
        }

        if (isset($parameters[2])) {
            $this->parameters = $parameters[2];
        } else $this->parameters = '';


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

        $controller =  $this->controller;
        $action = $this->action;
        $controller = new $controller;
        $controller->$action($this->parameters);
    }

}