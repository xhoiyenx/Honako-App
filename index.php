<?php
define( 'START_TIME', microtime() );
require_once 'includes/Libraries/autoload.php';

$app = new Honako\Foundation\Application;

$router = $app['router'];
$router->get( '/', 'function', 'index' );

$match = $router->run();

dump($match);

echo microtime() - START_TIME;