<?php
define( 'START_TIME', microtime(true) );
require_once 'includes/loader.php';
$app->run();
dump( microtime(true) - START_TIME );