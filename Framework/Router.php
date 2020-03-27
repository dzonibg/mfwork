<?php

class Router {

    public $request;
    public $uri;
    public $controller;
    public $action;
    public $parameters;
    private $method;
    public $params;
    public $error = 0;

    /* Router for the framework.
     * First a new Router instance is created for a request, then:
     * direct -> route -> getParameters | when finished, direct method uses the parameters and calls the ctrl+mthd.
     */

    public function route() {
        /*
        Calls the directing of traffic.
        */
        $this->request = new Request();
        $this->uri = $this->trim($this->request->uri);
        $this->method = $this->request->method;
        $this->getParameters();
    }

    public function trim($uri) {

        return trim($uri, '/');
    }

    public function getRoute() {
        $this->parameters = explode('/', $this->uri);
        $this->controller = $this->getController();
        $this->action = $this->getAction();
        $this->params = $this->getParams();
    }

    public function getController() {
        if (class_exists($this->findController($this->parameters[0]))) {
            $this->controller = $this->findController($this->parameters[0]);
        } else if (!class_exists($this->findController($this->parameters[0]))) {
            $this->controller = "ErrorHandler";
            $this->action = "classNotFound";
            $this->error = 1;
        } else if ($this->parameters[0] == '') {
            $this->controller = 'IndexController';
        }
    }

    public function getAction() {
        if ($this->error != 1) {
            if (method_exists($this->controller, $this->parameters[1])) {
                $this->action = $this->parameters[1];
            } else if (!method_exists($this->controller, $this->parameters[1])) {
                $this->error = 1;
                $this->action = "methodNotFound";
            }
        } else if ($this->parameters[1] == '') {
            $this->action = 'index';
        }
    }

    public function getParams() {
        if ($this->parameters[2] != '') {
            $this->params = $this->parameters[2];
        }
    }

    public function getParameters() //TODO Split into methods and add more checks!
    {
        $parameters = explode('/', $this->uri); //obtained the needed params, 0 is ctrl, 1 is action/method,
        // 2 are the parameters.

        $this->parameters = $parameters;

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
            $this->params = $parameters[2];
        } else $this->params = '';


    }

    public function findController($string) {
        /*
        Method used to get a controller based on the URI.
        */
        $string = ucfirst($string);
        $controller = $string . 'Controller';
        return $controller;
    }

    public function direct() {
        /*
        Main method used to direct traffic.
        */

        $this->route();

        if ($GLOBALS['debug']) {
            echo 'Controller: ' . $this->controller;
            echo ' Action: ' . $this->action;
            echo ' Parameters: ' . $this->params;
            echo '<br>';
        }

        $controller =  $this->controller;
        $action = $this->action;
        $controller = new $controller;
        $controller->$action($this->params);
    }

}