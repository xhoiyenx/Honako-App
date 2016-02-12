<?php
define( 'START_TIME', microtime() );
require_once 'includes/Libraries/autoload.php';

$app = new Honako\Foundation\Application;

$router = $app['router'];
$router->get( '/', 'function', 'index' );

$router->group( ['prefix' => 'administrator'], function($router){

	$router->get( '/', 'dashboard', 'adm.dashboard' );

});

$router->group( ['prefix' => 'www'], function($router){

	$router->group( ['prefix' => 'inside'], function($router){
		$router->get( '/', 'dashboard', 'www.dashboard' );
	});
	
});

$router->group( null, function(){
	
} );

dump($router->routes());

echo microtime() - START_TIME;