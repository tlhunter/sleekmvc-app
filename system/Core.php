<?php
class Core {
    protected $controllerName   = NULL;
    protected $controller       = NULL;
    protected $actionName       = NULL;
    protected $arguments        = NULL;

    function __construct() {
        $this->controllerName   = 'Controller_' . (isset($_GET['controller']) ? $_GET['controller'] : Config::get('default_controller'));
        $this->actionName       = 'action_' . (isset($_GET['action']) ? $_GET['action'] : Config::get('default_action'));
        $this->arguments        = isset($_GET['arg']) ? $_GET['arg'] : array();

        try {
            $this->controller = new $this->controllerName;
        } catch (ExceptionClassNotFound $e) {
            self::throw404($controllerName, $this->actionName, $this->arguments);
        }

        if (method_exists($this->controller, $this->actionName)) {
            $this->controller->preAction();
            self::loadController($this->controller, $this->actionName, $this->arguments);
            $this->controller->postAction();
        } else {
            self::throw404($controllerName, $this->actionName, $this->arguments);
        }
    }

    public static function throw404($controller, $action, $arguments) {
        self::loadController(
            Config::get('error_controller'),
            'action_404',
            array(
                $controller,
                $action,
                $arguments
            )
        );
        exit();
    }

    public static function loadController($controller, $action, $arguments) {
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
