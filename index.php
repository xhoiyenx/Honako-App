<?php
define( 'START_TIME', microtime(true) );
require_once 'includes/Libraries/autoload.php';
$app = new Honako\Foundation\Application;
$app->run();

dump( microtime(true) - START_TIME );