<?php
class Core {
    protected $controllerName   = NULL;
    protected $controller       = NULL;
    protected $actionName       = NULL;
    protected $arguments        = NULL;

    function __construct() {
        $request = Request::getInstance();
        $this->controllerName   = $request->urlController();
        $this->actionName       = $request->urlAction();
        $this->arguments        = $request->urlArguments();

        try {
            $this->controller = new $this->controllerName;
        } catch (Exception_ClassNotFound $e) {
            self::throw404();
        }

        if (method_exists($this->controller, $this->actionName)) {
            $this->controller->preAction();
            self::loadController($this->controller, $this->actionName, $this->arguments);
            $this->controller->postAction();
        } else {
            self::throw404();
        }
    }

    public static function throw404() {
        $errorControllerName = 'Controller_' . Config::get('error_controller');
        $errorController = new $errorControllerName;
        self::loadController(
            $errorController,
            'action_404'
        );
        exit();
    }

    public static function loadController($controller, $action, $arguments = array()) {
        if (is_string($controller)) {
            $controller = 'Controller_' . $controller;
        }
        call_user_func_array(
            array(
                $controller,
                $action
            ),
            $arguments
        );
    }
}
