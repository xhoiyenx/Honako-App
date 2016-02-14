<?php
namespace Honako\Helper;
use Exception;

class Filesystem
{
  protected $template = null;

  public function setTemplatePath( $path )
  {
    if ( ! is_dir($path) ) {
      throw new Exception ('Error: Template path not found');
    }
    else {
      $this->template = $path;
    }
  }

  public function show( $filepath, $variables = array() )
  {
    $file = $this->template . $filepath . '.php';
    if ( file_exists($file) ) {
      extract($variables);
      return include $file;
    }
    else {
      throw new Exception ('Error: Template file not found');
    }
  }
}