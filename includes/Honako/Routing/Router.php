<?php
namespace Honako\Routing;
use \AltoRouter;

class Router
{
  const VERSION = '0.0.1';

  protected  $router;

  public function __construct()
  {
    $this->router = new AltoRouter;
  }

  public function get( $route, $action, $name = null )
  {
    $this->router->map( 'GET', $route, $action, $name );
  }

  public function post( $route, $action, $name = null )
  {
    $this->router->map( 'POST', $route, $action, $name );
  }

  public function run()
  {
    return $this->router->match();
  }
}