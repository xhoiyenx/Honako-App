<?php
namespace Honako\Routing;

use Exception;
use \AltoRouter;
use Closure;
use Honako\Foundation\Application;

class Router
{
  const VERSION = '1.0.0';

  protected $routes;
  protected $prefix;
  protected $namespace;
  protected $is_group = false;
  protected $app;

  public function __construct( Application $app )
  {
    $this->app = $app;
  }

  public function get( $uri, $action, $name = null )
  {
    $this->call( 'GET', $uri, $action, $name );
  }

  public function post( $uri, $action, $name = null )
  {
    $this->call( 'POST', $uri, $action, $name );
  }

  public function match( $method = array(), $uri, $action, $name = null )
  {
    if ( count($method) > 1 ) {
      $method = implode('|', $method);
    }
    $this->call( $method, $uri, $action, $name );
  }

  public function call( $method, $uri, $action, $name = null )
  {
    if ( ! empty($this->prefix) )
      $uri = '/' . trim($this->prefix, '/') . '/' . trim($uri, '/');

    if ( ! empty($this->namespace) )
      $action = trim($this->namespace, '\\') . '\\' . $action;

    if ( $uri != '/')
      $uri = rtrim($uri, '/');

    $this->routes[] = [$method, $uri, $action, $name];
  }

  public function group( $options = array(), $function )
  {
    if ( ! empty($options) ) {

      if ( $this->is_group ) {
        if ( ! empty($options['prefix']) ) {
          $this->prefix .= $options['prefix'] . '/';
        }

        if ( ! empty($options['namespace'])) {
          $this->namespace .= $options['namespace'] . '\\';
        }
      }
      else {
        if ( ! empty($options['prefix']) ) {
          $this->prefix = $options['prefix'] . '/';
        }
        else {
          $this->prefix = null;
        }        

        if ( ! empty($options['namespace'])) {
          $this->namespace = $options['namespace'] . '\\';
        }
        else {
          $this->namespace = null;
        }
      }

      $this->is_group = true;
    }
    else {
      throw new Exception( 'Router group parameter is empty' );
    }

    call_user_func( $function, $this );

    $this->is_group = false;
  }

  public function routes()
  {
    return $this->routes;
  }

  public function process( $match )
  {
    if ( ! $match ) {
      # url not found
      # what will you do with this information
      throw new Exception('Error: Url not found', 404);
    }
    else {
      # run given action
      if ( isset( $match['target'] ) ) {
        return $this->processAction( $match['target'], $match['params'] );
      }
      else {
        throw new Exception('Error: Route target is not defined', 404);
      }
    }
  }

  public function processAction( $action, $param )
  {
    # action will be formatted like 
    # class@function
    if ( ! empty( $action ) ) {
      $do = explode('@', $action);
    }

    $class    = $do[0];
    $function = $do[1];

    if( ! class_exists($class) ) {
      throw new Exception('Error: Route target not found', 404);
    }
    elseif ( ! in_array( $function, get_class_methods($class) ) ) {
      throw new Exception('Error: Route method not found', 404);
    }
    else {
      return call_user_func_array(array( new $class, $function ), $param);
    }
  }

  public function run()
  {
    $router = new AltoRouter( $this->routes );
    $match  = $router->match();
    return $this->process($match);
  }

  public function baseUrl()
  {
    $request = $this->app['request'];
    return rtrim( $request->getSchemeAndHttpHost().$request->getBaseUrl(), '/' );
  }
}