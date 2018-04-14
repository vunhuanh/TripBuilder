<?php

  function build($db, $tripID){
    $flightdata = getItinerary($db, $tripID);

    $flightarray = array();
    foreach($flightdata as $flight){
      $existing_flight = new Flight($flight['flightID'], $flight['orig_airport'], $flight['dest_airport']);
      array_push($flightarray, $existing_flight);
    }
    
    $trip = new MultiCity($tripID, array_shift($flightarray));
    $order = 2;
    foreach($flightarray as $flight){
      $trip->addFlight($flight, $order);
      $order++;
    }

    return $trip;
  }

?>