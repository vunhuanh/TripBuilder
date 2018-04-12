<?php
  require 'DBconnection.php';
  require 'classes/flight.php';
  require 'classes/trip.php';

  $db = getDB();
  $user = $request->getParam('user');
  $ftype = $request->getParam('ftype');
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');

  try { 
    $query = "SELECT flight WHERE orig_airport=?, dest_airport=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$src, $dst]);
    $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
    $flightID = $flightdata['flightID'];

    $flight = new Flight($flightID, $src, $dst);

    $trip;
    if($ftype == 'One-way'){
      $trip = new Trip($flight);

      $trip->printItinerary;
    }
    else if($ftype == 'Round-trip'){
      $trip = new RoundTrip($flight);
      $query = "SELECT flight WHERE orig_airport=?, dest_airport=?";
      $stmt = $db->prepare($query);
      $stmt->execute([$dst, $src]);
      $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
      $flightID = $flightdata['flightID'];

      $return_flight = new Flight($flightID, $dst, $src);

      $trip->add($return_flight);

      $trip->printItinerary;
    }
    // else if($ftype == 'Multi-city'){

    // }


  } 
  catch(Exception $e) {
    echo "Error";
  }
?>