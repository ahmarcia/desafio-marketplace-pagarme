<?php

use \Slim\App;

$settings = require __DIR__ . '/../config/app.php';
$app = new App($settings);

require __DIR__ .  '/../src/dependencies.php';
require __DIR__ .  '/../src/Routes/app.php';

$app->run();
