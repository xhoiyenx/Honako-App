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
    template()->setTemplatePath( __DIR__ . '/templates/' );
  }
}