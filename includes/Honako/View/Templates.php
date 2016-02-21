<?php
namespace Honako\View;
use Exception;
use Honako\Foundation\Application;

class Templates
{
  const VERSION = '0.0.1';

  protected $template;
  protected $app;
  protected $view;  

  public function __construct( Application $app )
  {
    $this->app  = $app;
    $this->view = $this->app['config']['view.view_path'];
  }

  public function setView( $path )
  {
    $this->view = $path;
  }

  public function setPath( $theme )
  {
    if ( ! $this->app['files']->isDirectory($this->view . '/' . $theme) ) {
      throw new Exception ('Error: Template path not found');
    }
    else {
      $this->template = $this->view . '/' . $theme;
    }
  }

  public function make( $filepath, $variables = array() )
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