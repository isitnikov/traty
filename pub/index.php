<?php

define("APP_ROOT_PATH", realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'));
define("APP_TEMPLATES_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define("APP_MODELS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);
define("APP_CONFIGS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR);
define("APP_CONTROLLERS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR);

if (!file_exists(APP_CONFIGS_PATH . 'config.php')) {
    echo "Create config file";
    die();
}

require APP_CONFIGS_PATH . 'config.php';
require APP_MODELS_PATH  . 'Operation.php';

define("BASE_URL", $config['base_url']);

class App
{
    static protected $_config;

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
}

App::setConfig($config);
$controllerName = isset($_GET['controller'])? $_GET['controller'] : 'operation';
$controllerName = ucfirst($controllerName) . 'Controller';
$actionName     = isset($_GET['action'])? $_GET['action'] : 'view';
$actionName     = $actionName . 'Action';

require APP_CONTROLLERS_PATH . 'OperationController.php';
$controller = new $controllerName;

if (!method_exists($controller, $actionName)) {
    $actionName = 'notFoundAction';
}
$controller->$actionName();




