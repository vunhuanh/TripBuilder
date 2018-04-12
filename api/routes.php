<?php
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->get('/index', function ($request, $response) {
  require 'index.php';
});

$app->post('/addflight', function ($request, $response) {
  require 'addflight.php';
});

$app->run();
?>