<?php
$router = $app->make('router');


$router->group(['namespace' => 'App\Controllers\Site'], function($router) {

  $router->get('/', 'Homepage@index');

});