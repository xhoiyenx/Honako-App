<?php
namespace App\Controllers\Backend;

use App\Models\User;

class Auth extends BaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    $user = new User;

    $name = 'foo';
    return $this->app['view']->show('auth/login');
  }
}