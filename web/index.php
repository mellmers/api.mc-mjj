<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new projectx\api\Application();

/**
 * Global Controllers
 */

$app->get('/', function() {
    return 'Your application runs great! </br> For more information about the micro-framework silex read the <a href="http://silex.sensiolabs.org/doc/usage.html" target="_blank" >documention</a>.';
});

$app->run();