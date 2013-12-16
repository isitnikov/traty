<?php

spl_autoload_register('autoloader');
function autoloader($class)
{
    require $class . '.php';
}


class App
{
    static protected $_config;
    static protected $_request;
    static protected $_user;

    /**
     * @param mixed $config
     */
    public static function setConfig($config)
    {
        self::$_config = $config;
    }

    /**
     * @return mixed
     */
    public static function getConfig()
    {
        return self::$_config;
    }
    static public function getConnection()
    {
        $connection = new PDO('mysql:host=' . self::getConfig()['db']['host'] .
            ';dbname=' . self::getConfig()['db']['db'], self::getConfig()['db']['user'], self::getCOnfig()['db']['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connection;
    }

    static public function run()
    {
        session_start();
        $controllerName = isset($_GET['controller'])? $_GET['controller'] : 'operation';
        $controllerName = ucfirst($controllerName) . 'Controller';
        $actionName     = isset($_GET['action'])? $_GET['action'] : 'view';
        $actionName     = $actionName . 'Action';

        $controllerPath = APP_CONTROLLERS_PATH . $controllerName . '.php';
        if (!file_exists($controllerPath)) {
            $controllerPath = APP_CONTROLLERS_PATH . 'OperationController.php';
        }

        require $controllerPath;
        $controller = new $controllerName;
        $controller->init();

        if (!method_exists($controller, $actionName)) {
            $actionName = 'notFoundAction';
        }
        return $controller->$actionName();
    }

    static public function getBaseUrl()
    {
        $config = self::getConfig();
        return $config['base_url'];
    }

    static public function getRequest($key = false)
    {
        $request = array_merge($_GET, $_POST);
        if ($key === false) {
            return $request;
        }
        if (isset($request[$key])) {
            return $request[$key];
        }
        return false;
    }

    static public function getUser()
    {
        if (!self::$_user) {
            self::$_user = new User();
        }

        return self::$_user;
    }
}
