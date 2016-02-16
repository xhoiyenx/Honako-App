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
    $name = 'foo';
    return template()->show('auth/login');
  }
}