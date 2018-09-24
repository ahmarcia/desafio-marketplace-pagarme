<?php
// DIC configuration

use App\Helpers\CheckoutHelper;
use App\Helpers\Session;
use App\Helpers\Request;
use App\Model\ProductsModel;
use App\Model\SellersModel;
use Slim\Container;

$container = $app->getContainer();

if ($container['settings']['displayErrorDetails']) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

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
    $apiKey = $container->settings['pagarMe']['api_key'];

    return new \PagarMe\Sdk\PagarMe($apiKey);
};

// session
$container['session'] = function () {
    return new Session();
};

// models
$container['Sellers'] = function (Container $container) {
    $Sellers = new SellersModel();

    $Sellers->setCodesSplit($container->settings['pagarMe']['code_splits']);

    return $Sellers;
};
$container['Products'] = function (Container $container) {
    $Products = new ProductsModel();
    $Products->setSellers($container->Sellers);

    return $Products;
};

// helpers
$container['checkoutHelp'] = function (Container $container) {
    return new CheckoutHelper(
        $container->pagarme,
        $container->logger,
        $container->settings['pagarMe']['recipient']
    );
};
$container['requestHelp'] = function () {
    return new Request();
};
