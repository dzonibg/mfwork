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

    /* Router for the framework. V2.0
     * First a new Router instance is created for a request, then:
     * direct -> route -> getParameters | when finished, direct method uses the parameters and calls the ctrl+mthd.
     *  direct calls route to get the method and parameters;
     * route calls getParameters to get the name of controller, method and parameters
     * after all of that, direct finishes it's job by calling the needed method and passes the arguments.
     */

    public function route() {
        /*
        Calls the directing of traffic.
        */
        $this->request = new Request();
        $this->uri = $this->trim($this->request->uri);
        $this->method = $this->request->method;
        $this->getRoute();
    }

    public function trim($uri) {

        return trim($uri, '/');
    }

    public function getRoute() {
        $this->parameters = explode('/', $this->uri);
        $this->getController();
        $this->getAction();
        $this->getParams();
    }

    public function getController()
    {
        if (class_exists($this->findController($this->parameters[0]))) {
            $this->controller = $this->findController($this->parameters[0]);
        } else if ($this->parameters[0] == '') {
            $this->controller = 'IndexController';
        }

         if (!class_exists($this->controller)) {
            $this->controller = "ErrorHandler";
            $this->action = "classNotFound";
            $this->error = 1;
        }
    }


    public function getAction() {
        if ($this->error != 1) {
            if (isset($this->parameters[1])) {
                if (method_exists($this->controller, $this->parameters[1])) {
                    $this->action = $this->parameters[1];
                } else if (!method_exists($this->controller, $this->parameters[1])) {
                    $this->error = 1;
                    $this->controller = "ErrorHandler";
                    $this->action = "methodNotFound";
                }
            } else {
                if (method_exists($this->controller, 'index')) {
                    $this->action = 'index';
                } else {
                    $this->controller = "ErrorHandler";
                    $this->action = "methodNotFound";
                }
            }
        }
    }

    public function getParams() {
        if (isset($this->parameters[2])) {
            if ($this->parameters[2] != '') {
                $this->params = $this->parameters[2];
            }
        }
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

        $action = $this->action;
        $controller = $this->controller;
        $controller = new $controller;
        $controller->$action($this->params);
    }

}