<?php
// DIC configuration

use App\Helpers\CheckoutHelper;
use App\Model\OrdersModel;
use App\Model\UsersModel;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];

    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

// pagar.me
$container['pagarme'] = function ($c) {
    $apiKey = $c['settings']['api_key'];

    return new \PagarMe\Sdk\PagarMe($apiKey);
};

// models
$container['Users'] = function () {
    return new UsersModel();
};

//helpers
$container['checkoutHelp'] = function ($c) {
    return new CheckoutHelper($c->pagarme);
};