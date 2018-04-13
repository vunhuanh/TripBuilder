<?php
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require 'DBconnection.php';
require 'classes/flight.php';
require 'classes/trip.php';

$app = new \Slim\App;

$app->get('/getairports', function ($request, $response) {
  require 'getairports.php';
});

$app->post('/addflight', function ($request, $response) {
  require 'addflight.php';
});

$app->post('/deleteflight', function ($request, $response) {
  require 'deleteflight.php';
});

$app->run();
?>