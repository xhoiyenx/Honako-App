<?php
namespace Honako\Foundation;

use Exception;
use Illuminate\Container\Container;
use Honako\Routing\Router;

class Application extends Container
{
  const VERSION = '0.0.1';

  public function __construct()
  {
    $this->bindShared('router', function(){
      return new Router;
    });

    $this->instance('Illuminate\Container\Container', $this);
  }

  public function run()
  {
  	# make sure router is bound
  	if ( ! $this->bound('router') ) {
  		throw new Exception( 'Router not bound' );
  	}
  	else {
  		$router 	= $this['router'];

  		try{
  			$response = $router->run();
  		}
  		catch ( Exception $e ) {
  			$response = $e;
  		}
  		
  		# handling response here
  		if ( is_string($response) ) {
  			echo $response;
  		}
  	}

  }

}