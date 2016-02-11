<?php
namespace Honako\Routing;
use \AltoRouter;
use Closure;

class Router
{
  const VERSION = '0.0.1';

  protected $routes;
  protected $prefix;
  protected $namespace;

  public function __construct()
  {

  }

  public function get( $uri, $action, $name = null )
  {
    $this->call( 'GET', $uri, $action, $name );
  }

  public function post( $uri, $action, $name = null )
  {
    $this->call( 'POST', $uri, $action, $name );
  }

  public function call( $method, $uri, $action, $name = null )
  {
    if ( ! empty($this->prefix) )
      $uri = $this->prefix . '/' . trim($uri, '/');

    $this->routes[] = [$method, $uri, $action, $name];
  }

  public function group( $options = array(), Closure $closure )
  {
    if ( ! empty($options) ) {

    }
    else {
      throw new \Exception( 'Router group parameter is empty' );
    }
    call_user_func( $closure, $this );
  }

  public function routes()
  {
    return $this->routes;
  }

  public function run()
  {

  }
}