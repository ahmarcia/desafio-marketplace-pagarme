<?php

$app->any('/cart', 'App\Controllers\CartController:index');
$app->post('/cart/add/{id}', 'App\Controllers\CartController:add');
$app->post('/cart/checkout', 'App\Controllers\CartController:checkout');
