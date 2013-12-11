<?php
$config['base_url'] = '/';

define("APP_ROOT_PATH", realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'));
define("BASE_URL", $config['base_url']);
define("APP_TEMPLATES_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define("APP_MODELS_PATH", APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);
require APP_TEMPLATES_PATH  . 'index.php';
require APP_MODELS_PATH  . 'operation.php';

if (!empty($_POST)) {
    $operation = new Operation();
    $operation->setName($_POST['name']);
    $operation->setAmount($_POST['amount']);
    $operation->save();
    header('Location: ' . BASE_URL);
}

