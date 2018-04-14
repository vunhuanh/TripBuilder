<?php
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require 'DB_connect.php';
require 'DB_query.php';
require 'trip_build.php';
require 'classes/flight.php';
require 'classes/trip.php';

$app = new \Slim\App;

$app->post('/newsession', function ($request, $response) {
  require 'newsession.php';
});

$app->get('/getairports', function ($request, $response) {
  require 'getairports.php';
});

$app->get('/trip_display', function ($request, $response) {
  session_start();
  $db = getDB();
  $trip = build($_SESSION['tripID'], $db);
  echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);
});

$app->post('/trip_new', function ($request, $response) {
  require 'trip_new.php';
});

$app->post('/trip_add', function ($request, $response) {
  require 'trip_add.php';
});

$app->post('/trip_remove', function ($request, $response) {
  require 'trip_remove.php';
});

$app->run();
?>