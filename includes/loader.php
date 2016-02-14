<?php
/**
 * Load composer autoload
 * Priority : 1
 */
require_once 'Libraries/autoload.php';

use Illuminate\Support\Facades\Facade;

/**
 * Load application
 */
$app = new Honako\Foundation\Application;

$app->instance('app', $app);

Facade::clearResolvedInstances();

Facade::setFacadeApplication($app);

/**
 * Load helpers
 */
require_once 'helpers.php';

/**
 * Load router inside app
 */
require_once dirname( __DIR__ ) . '/app/routes.php';