<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function() {
    return 'Your application started successfully!';
});

$app->run();