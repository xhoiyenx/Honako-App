<?php
/**
 * Load composer autoload
 * Priority : 1
 */
require_once 'Libraries/autoload.php';

use Illuminate\Support\Facades\Facade;
use Illuminate\Config\EnvironmentVariables;
use Illuminate\Config\Repository as Config;

# load application
$app = new Honako\Foundation\Application;

# load path
$app->bindInstallPaths(require 'filepath.php');

# set facades
Facade::clearResolvedInstances();
Facade::setFacadeApplication($app);

# set config
$app->instance('config', $config = new Config(
  $app->getConfigLoader(), 'production'
));

# load providers
$app->loadProviders();

/**
 * Load helpers
 */
require_once 'helpers.php';

/**
 * Load router inside app
 */
require_once dirname( __DIR__ ) . '/app/routes.php';