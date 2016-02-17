<?php
namespace App\Controllers\Backend;
abstract class BaseController
{
  protected $app;
  public function __construct()
  {
    $this->app = app();
    $this->registerView();
  }

  private function registerView()
  {
    $config = $this->app['config'];
    twig()->setPath( $config['app.theme.backend'] );
    #template()->setTemplatePath( __DIR__ . '/templates/' );
  }
}