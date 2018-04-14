<?php
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';
require 'DB_connect.php';
require 'DB_query.php';
require 'trip_build.php';
require 'classes/flight.php';
require 'classes/trip.php';

$app = new \Slim\App;

$app->get('/getairports', function ($request, $response, $args) {
  $db = getDB();
  echo json_encode(getAirports($db), JSON_UNESCAPED_UNICODE);
});

$app->get('/getusers', function ($request, $response, $args) {
  $db = getDB();
  echo json_encode(getUsers($db), JSON_UNESCAPED_UNICODE);
});

$app->post('/trip_new', function ($request, $response, $args) {
  require 'trip_new.php';
});

$app->post('/trip_add', function ($request, $response, $args) {
  require 'trip_add.php';
});

$app->delete('/trip_remove/{tripID}/{flightID}', function ($request, $response, $args) {
  require 'trip_remove.php';
});

$app->delete('/trip_delete/{tripID}', function ($request, $response, $args) {
  $db = getDB();
  $tripID = $args['tripID'];
  deleteTrip($db, $tripID);
});

$app->get('/usertrips/{user}', function ($request, $response, $args) {
  $db = getDB();
  $user = $args['user'];
  $trips = getTrips($db, $user);
  echo json_encode($trips, JSON_UNESCAPED_UNICODE);
});

$app->get('/trip_display/{tripID}', function ($request, $response, $args) {
  $db = getDB();
  $tripID = $args['tripID'];
  $trip = build($db, $tripID);
  echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);
});

$app->run();
?>