<?php

class Router
{
	private $routes;

	public function __construct()
    {
        $routesPath = ROOT_PATH . '/config/routes.php';

        $this->routes = include($routesPath);
    }

	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
	}

	public function run()
    {
        $uri = $this->getURI();

        foreach($this->routes as $pattern => $path) {
            if (preg_match("~$pattern~", $uri)) {

                $internalRoute = preg_replace("~$pattern~", $path, $uri);

                $segment = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($segment)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segment));

                $controllerFile = ROOT_PATH . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                } else {
                    break;
                }

                $controllerObject = new $controllerName;

                if (is_callable(array($controllerObject, $actionName))) {
                    $result = call_user_func_array(array($controllerObject, $actionName), $segment);
                    break;
                }
            }
        }
    }

    public function invalidRoute()
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        include(ROOT_PATH . '/views/404/index.php');
    }
}