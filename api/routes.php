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
  $db = getDB();
  echo json_encode(getAirports($db), JSON_UNESCAPED_UNICODE);
});

$app->get('/getusers', function ($request, $response) {
  $db = getDB();
  echo json_encode(getUsers($db), JSON_UNESCAPED_UNICODE);
});

$app->get('/usertrips', function ($request, $response) {
  $db = getDB();
  session_start();
  $trips = getTrips($db, $_SESSION['user']);
  echo json_encode($trips, JSON_UNESCAPED_UNICODE);
});

$app->get('/flight_display', function ($request, $response) {
  $db = getDB();
  session_start();
  $trip = build($db, $_SESSION['tripID']);
  echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);
});

$app->get('/trip_display', function ($request, $response) {
  $db = getDB();
  session_start();
  $trip = build($db, $_SESSION['tripID']);
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

$app->post('/trip_delete', function ($request, $response) {
  $db = getDB();
  $tripID = $request->getParam('tripID');
  deleteTrip($db, $tripID);
});

$app->run();
?>