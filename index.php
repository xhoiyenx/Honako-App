<?php
$b = microtime();
require_once 'includes/Libraries/autoload.php';

$router = new AltoRouter();
$router->map( 'GET', '/', function() {
  echo 'hello world';
}, 'index');

$match = $router->match();

call_user_func_array( $match['target'], $match['params'] );

dump( microtime() - $b );
dump( $match );