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
