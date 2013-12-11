<?php

define("APP_ROOT_PATH", realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'));
define("APP_TEMPLATES_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define("APP_MODELS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);
define("APP_CONFIGS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR);

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
        return $connection = new PDO('mysql:host=' . self::getConfig()['db']['host'] .
            ';dbname=' . self::getConfig()['db']['db'], self::getConfig()['db']['user'], self::getCOnfig()['db']['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
}

App::setConfig($config);

if (!empty($_POST)) {
    $operation = new Operation();
    $operation->setName($_POST['name']);
    $operation->setAmount($_POST['amount']);
    $operation->save();
    header('Location: ' . BASE_URL);
}

$operationCollection = new OperationCollection();

$todayAmount = $operationCollection->getTodayAmount();

require APP_TEMPLATES_PATH  . 'index.php';
