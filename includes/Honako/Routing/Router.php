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
<<<<<<< HEAD
  protected $is_group = false;
=======
>>>>>>> origin/master

  public function __construct()
  {

<<<<<<< HEAD
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
      $uri = trim($this->prefix, '/') . '/' . trim($uri, '/');

    if ( ! empty($this->namespace) )
      $action = trim($this->namespace, '\\') . '\\' . $action;

    if ( $uri != '/')
      $uri = trim($uri, '/');

    $this->routes[] = [$method, $uri, $action, $name];
  }

  public function group( $options = array(), Closure $closure )
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
      throw new \Exception( 'Router group parameter is empty' );
    }

    call_user_func( $closure, $this );

    $this->is_group = false;
  }

  public function routes()
  {
=======
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
>>>>>>> origin/master
    return $this->routes;
  }

  public function run()
  {

  }
}