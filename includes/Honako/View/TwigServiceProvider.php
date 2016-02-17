<?php
namespace Honako\View;
use Illuminate\Support\ServiceProvider;

class TwigServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->singleton('twig', function() { return new Twig($this->app); });
  }
}