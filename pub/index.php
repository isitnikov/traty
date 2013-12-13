<?php

define("APP_ROOT_PATH", realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'app');
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

require APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'App.php';
App::setConfig($config);
App::run();

