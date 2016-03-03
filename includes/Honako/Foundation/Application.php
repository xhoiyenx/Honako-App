<?php
namespace Honako\Foundation;

use Exception;
use Illuminate\Config\FileLoader;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;


class Application extends Container
{
  const VERSION = '0.0.1';

  protected $booted = false;

  protected $loadedProviders = array();

  protected $serviceProviders = array();

  public function __construct()
  {
    $this->baseBindings();
  }

  protected function baseBindings()
  {
    $request = SymfonyRequest::createFromGlobals();
    $this->instance('request', $request);
    $this->register('Illuminate\Events\EventServiceProvider');
    $this->register('Honako\Routing\RouterServiceProvider');
  }

  public function loadProviders()
  {
    $providers = $this['config']['app.providers'];
    if ( count($providers) > 0 ) {
      foreach ( $providers as $provider ) {
        $this->register($provider);
      }
    }
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
    $class = get_class($provider);
    $this['events']->fire($class = get_class($provider), array($provider));
    $this->serviceProviders[] = $provider;
    $this->loadedProviders[$class] = true;
  }

  public function resolveProviderClass($provider)
  {
    return new $provider($this);
  }

  public function bindInstallPaths(array $paths)
  {
    $this->instance('path', realpath($paths['app']));

    // Here we will bind the install paths into the container as strings that can be
    // accessed from any point in the system. Each path key is prefixed with path
    // so that they have the consistent naming convention inside the container.
    foreach (array_except($paths, array('app')) as $key => $value)
    {
      $this->instance("path.{$key}", realpath($value));
    }
  }

  public function getConfigLoader()
  {
    return new FileLoader(new Filesystem, $this['path'].'/config');
  }

  public function getProviderRepository()
  {
    $manifest = $this['config']['app.manifest'];

    return new ProviderRepository(new Filesystem, $manifest);
  }

  public function booted()
  {
    return $this->booted;
  }

  public function boot()
  {
    if ($this->booted) return;

    array_walk($this->serviceProviders, function($p) { $p->boot(); });

    $this->booted = true;
  }  

  public function run()
  {
  	# make sure router is bound
  	if ( ! $this->bound('router') ) {
  		throw new Exception( 'Router not bound' );
  	}
  	else {
      $this->boot();

  		$router 	= $this['router'];

  		try{
  			$response = $router->run();
  		}
  		catch ( Exception $e ) {
  			$response = $e->getMessage();
  		}

  		# handling response here
  		if ( is_string($response) ) {
  			echo $response;
  		}
  	}

  }

}