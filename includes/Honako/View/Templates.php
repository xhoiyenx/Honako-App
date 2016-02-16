<?php
namespace Honako\View;
use Exception;
use Honako\Foundation\Application;

class Templates
{
  protected $template;
  protected $app;

  public function __construct( Application $app )
  {
    $this->app = $app;
  }

  public function setTemplatePath( $path )
  {
    if ( ! $this->app['files']->isDirectory($path) ) {
      throw new Exception ('Error: Template path not found');
    }
    else {
      $this->template = $path;
    }
  }

  public function show( $filepath, $variables = array() )
  {
    $file = $this->template . $filepath . '.php';
    if ( $this->app['files']->exists($file) ) {
      extract($variables);
      return require $file;
    }
    else {
      throw new Exception ('Error: Template file not found');
    }
  }
}