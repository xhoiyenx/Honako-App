<?php
/**
 * Load composer autoload
 * Priority : 1
 */
require_once 'Libraries/autoload.php';

/**
 * Load application
 */
$app = new Honako\Foundation\Application;

/**
 * Load helpers
 */
require_once 'helpers.php';

/**
 * Load router inside app
 */
require_once dirname( __DIR__ ) . '/app/routes.php';