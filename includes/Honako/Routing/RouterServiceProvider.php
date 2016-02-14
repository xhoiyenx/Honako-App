<?php
namespace Honako\Routing;
use Illuminate\Support\ServiceProvider;

class RouterServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bindShared('router', function() { return new Router; });
  }
}