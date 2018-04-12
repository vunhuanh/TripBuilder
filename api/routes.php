<?php
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->get('/index', function ($request, $response) {
  require 'index.php';
});

$app->post('/checkusername', function ($request, $response) {
  require 'checkusername.php';
});

$app->run();
?>