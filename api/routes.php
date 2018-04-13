<?php
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require 'DBconnection.php';
require 'classes/flight.php';
require 'classes/trip.php';

$app = new \Slim\App;

$app->post('/newsession', function ($request, $response) {
  require 'newsession.php';
});

$app->get('/getairports', function ($request, $response) {
  require 'getairports.php';
});

$app->get('/usertrips', function ($request, $response) {
  require 'usertrips.php';
});

$app->post('/newtrip', function ($request, $response) {
  require 'newtrip.php';
});

$app->post('/addflight', function ($request, $response) {
  require 'addflight.php';
});

$app->post('/deleteflight', function ($request, $response) {
  require 'deleteflight.php';
});

$app->run();
?>