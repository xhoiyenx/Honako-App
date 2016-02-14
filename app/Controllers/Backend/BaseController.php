<?php
namespace App\Controllers\Backend;

use Honako\Helper\Filesystem;
class BaseController
{
  protected $app;
  public function __construct()
  {
    $this->app = app();
    $this->registerView();
  }

  private function registerView()
  {
    $this->app['view']->setTemplatePath( __DIR__ . '/templates/' );
  }
}