<?php
namespace Honako\Foundation;

use Exception;
use Illuminate\Container\Container;
use Honako\Routing\Router;

class Application extends Container
{
  const VERSION = '0.0.1';

  protected $booted = false;

  protected $loadedProviders = array();

  protected $serviceProviders = array();

  public function __construct()
  {
    $this->bindShared('router', function(){
      return new Router;
    });

    $this->instance('Illuminate\Container\Container', $this);

    $this->register( new \Illuminate\Events\EventServiceProvider($this) );
  }

  public function register($provider, $options = array(), $force = false)
  {
    if ($registered = $this->getRegistered($provider) && ! $force) {
      return $registered;
    }
                                     
    // If the given "provider" is a string, we will resolve it, passing in the
    // application instance automatically for the developer. This is simply
    // a more convenient way of specifying your service provider classes.
    if (is_string($provider))
    {
      $provider = $this->resolveProviderClass($provider);
    }
    $provider->register();

    // Once we have registered the service we will iterate through the options
    // and set each of them on the application so they will be available on
    // the actual loading of the service objects and for developer usage.
    foreach ($options as $key => $value)
    {
      $this[$key] = $value;
    }

    $this->markAsRegistered($provider);

    // If the application has already booted, we will call this boot method on
    // the provider class so it has an opportunity to do its boot logic and
    // will be ready for any usage by the developer's application logics.
    if ($this->booted) $provider->boot();

    return $provider;
  }

  public function getRegistered($provider)
  {
    $name = is_string($provider) ? $provider : get_class($provider);
    if (array_key_exists($name, $this->loadedProviders))
    {
      return array_first($this->serviceProviders, function($key, $value) use ($name)
      {
        return get_class($value) == $name;
      });
    }
  }

  protected function markAsRegistered($provider)
  {
    $this['events']->fire($class = get_class($provider), array($provider));
    $this->serviceProviders[] = $provider;
    $this->loadedProviders[$class] = true;
  }

  public function resolveProviderClass($provider)
  {
    return new $provider($this);
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