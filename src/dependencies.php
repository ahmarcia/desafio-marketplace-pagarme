<?php
// DIC configuration

use App\Helpers\CheckoutHelper;
use App\Helpers\Session;
use App\Helpers\Request;
use App\Model\ProductsModel;
use Slim\Container;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function (Container $container) {
    $settings = $container->get('settings')['renderer'];

    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function (Container $container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

// pagar.me
$container['pagarme'] = function (Container $container) {
    $apiKey = $container->settings['api_key'];

    return new \PagarMe\Sdk\PagarMe($apiKey);
};

// session
$container['session'] = function () {
    return new Session();
};

// models
$container['Products'] = function () {
    return new ProductsModel();
};

// helpers
$container['checkoutHelp'] = function (Container $container) {
    return new CheckoutHelper($container->pagarme);
};

// request
$container['requestHelp'] = function () {
    return new Request();
};
