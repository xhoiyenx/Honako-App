<?php
namespace App\Controllers\Backend;

use App\Controllers\BackendController as BaseController;

class Auth extends BaseController
{
  public function login()
  {
    dump( $this->app );
  }
}