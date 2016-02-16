<?php
namespace Honako\View;
use Illuminate\Support\ServiceProvider;

class TemplatesServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->singleton('template', function() { return new Templates($this->app); });
  }
}