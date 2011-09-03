<?php
class Core {
    protected $controller = NULL;
    protected $action = NULL;
    protected $arguments = NULL;
    protected $cClassName = NULL;

    function __construct() {
        $this->controller     = isset($_GET['controller']) ? $_GET['controller'] : Config::get('default_controller');
        $this->action         = 'action_' . (isset($_GET['action']) ? $_GET['action'] : Config::get('default_action'));
        $this->arguments      = isset($_GET['arg']) ? $_GET['arg'] : array();
        $this->cClassName     = "Controller_{$this->controller}";

        try {
            $this->controller = new $this->cClassName;
        } catch (ExceptionClassNotFound $e) {
            self::throw404($this->controller, $this->action, $this->arguments);
        }

        if (method_exists($this->controller, $this->action)) {
            $this->controller->preAction();
            self::loadController($this->controller, $this->action, $this->arguments);
            $this->controller->postAction();
        } else {
            self::throw404($this->controller, $this->action, $this->arguments);
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
