<?php

require_once __DIR__ . '/../vendor/autoload.php';

use controllers\UserController;

$app = new \Timetable\Api\Application();

$app['debug'] = true;

/**
 * Global Controllers
 */

$app->get('/', function() {
    return 'Your application runs great! </br> For more information about the micro-framework silex read the <a href="http://silex.sensiolabs.org/doc/usage.html" target="_blank" >documention</a>.';
});

/**
 * mount grouped/organized Controllers
 */

$app->mount('/user', new UserController());

$app->run();