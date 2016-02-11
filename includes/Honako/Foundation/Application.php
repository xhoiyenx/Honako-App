<?php
namespace Honako\Foundation;

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
  }
}