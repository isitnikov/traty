<?php

define("APP_ROOT_PATH", realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'app');
define("APP_LIB_PATH", realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define("APP_TEMPLATES_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define("APP_MODELS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);
define("APP_HELPERS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR);
define("APP_CONFIGS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR);
define("APP_CONTROLLERS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR);

set_include_path(get_include_path() . PATH_SEPARATOR . APP_MODELS_PATH . PATH_SEPARATOR .
    APP_HELPERS_PATH . PATH_SEPARATOR . APP_CONTROLLERS_PATH . PATH_SEPARATOR . APP_LIB_PATH);

if (!file_exists(APP_CONFIGS_PATH . 'config.php')) {
    echo "Create config file";
    die();
}

require APP_CONFIGS_PATH . 'config.php';
App::setConfig($config);

define("BASE_URL", $config['base_url']);

spl_autoload_register('autoloader');
function autoloader($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;

    //require $className . '.php';
}


class App
{
    static protected $_config;
    static protected $_request;
    static protected $_user;
    static protected $_connection;

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

    /**
     * @return Zend_Db_Adapter_Abstract
     */
    static public function getConnection()
    {
        if (self::$_connection) {
            return self::$_connection;
        }
        $config = self::getConfig();

        $connection = Zend_Db::factory('Pdo_Mysql' ,array(
            'host' => $config['db']['host'],
            'username' => $config['db']['user'],
            'password' => $config['db']['pass'],
            'dbname' => $config['db']['db'],
            'charset' => 'utf8',
        ));
        $connection->setFetchMode(Zend_Db::FETCH_ASSOC);
        self::$_connection = $connection;
        return self::$_connection;
    }

    static public function run()
    {
        $time_start = microtime(true);
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
        $controller->$actionName();
        $time_end = microtime(true);
        $time = $time_end - $time_start;

        return round($time,2);
    }

    static public function getBaseUrl()
    {
        $config = self::getConfig();
        return $config['base_url'];
    }

    static public function getRequest($key = false, $default = false)
    {
        $request = array_merge($_GET, $_POST);
        if ($key === false) {
            return $request;
        }
        if (isset($request[$key])) {
            return $request[$key];
        }
        return $default;
    }

    static public function getUser()
    {
        if (!self::$_user) {
            self::$_user = new User();
        }

        return self::$_user;
    }

    static public function addSuccessAlert($message = '')
    {
        if (!$message) {
            $message = 'Операция выполнена успешно';
        }

        $_SESSION['alerts']['success'] = $message;
    }

    static public function addErrorAlert($message = '')
    {
        if (!$message) {
            $message = 'Операция произошла с ошибкой';
        }
        $_SESSION['alerts']['error'] = $message;
    }

    static public function popAlerts()
    {
        $alerts = array();
        if (isset($_SESSION['alerts'])) {
            $alerts = $_SESSION['alerts'];
        }

        unset($_SESSION['alerts']);

        return $alerts;
    }
}
