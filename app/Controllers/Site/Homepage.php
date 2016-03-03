<?php
namespace App\Controllers\Site;
use App\Controllers\SiteController as Controller;

class Homepage extends Controller
{
  public function index()
  {
    return view()->make('homepage');
  }
}