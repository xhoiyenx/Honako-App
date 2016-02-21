<?php
namespace Honako\Foundation;

/**
 * PLAN
 * This is the base controller for invoking business logic of each page
 *
 * - Controller who extends from this class should set default template path
 */
abstract class Controller
{
	protected $_view;
	protected $_theme;
	protected $app;

	public function __construct()
	{
		$this->app = app();

		if ( ! empty($this->_theme))
			$this->app['view']->setPath( $this->_theme );
	}
}