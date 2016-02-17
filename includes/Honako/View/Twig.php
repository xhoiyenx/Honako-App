<?php
namespace Honako\View;
use Exception;
use Honako\Foundation\Application;
use Twig_Loader_Filesystem;
use Twig_Environment;

class Twig
{
	protected $app;
	protected $view;
	protected $view_cache;
	protected $loader;
	protected $twig;
	protected $namespace;

	public function __construct( Application $app )
	{
		$this->app = $app;
		$this->loadTwig();
	}

	protected function loadTwig()
	{
		$this->view = $this->app['config']['app.view_path'];
		$this->view_cache = $this->app['config']['app.view_cache'];
		$this->loader = new Twig_Loader_Filesystem;
	}

	public function setPath( $theme = '' )
	{
		if ( empty($theme) ) {
			throw new Exception('Error: Please insert theme name');
		}
		else {
			$this->namespace = $theme;
			$this->loader->setPaths( $this->view . '/' . $theme, $this->namespace );
			$this->twig = new Twig_Environment( $this->loader, array(
				'cache' => $this->view_cache,
				'auto_reload' => true
			));
		}
	}

	public function make( $file, $variables = array() )
	{
		if ( ! empty( $this->namespace ) )
			$file = '@' . $this->namespace . '/' . $file;

		return $this->twig->render( $file, $variables );
	}
}