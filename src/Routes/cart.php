<?php

$app->get('/cart', 'App\Controllers\CartController:index');
$app->post('/cart/add/{id}', 'App\Controllers\CartController:add');
