<?php
$router = $app->make('router');

$router->group(['namespace' => 'App\Controllers\Backend', 'prefix' => 'backend'], function($router) {
  $router->get('/', 'Auth@login');
});

$router->group(['namespace' => 'App\Controllers\Site'], function($router) {
  $router->get('/', 'Pages@homepage');
});