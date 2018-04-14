<?php
  //Re-create the flight and trip objects by querying into DB
  function build($db, $tripID){
    //Get list of flights in the trip
    $flightdata = getItinerary($db, $tripID);

    //Make Flight object
    $flightarray = array();
    foreach($flightdata as $flight){
      $existing_flight = new Flight($flight['flightID'], $flight['orig_airport'], $flight['dest_airport']);
      array_push($flightarray, $existing_flight);
    }
    
    //Make Trip object
    $trip = new MultiCity($tripID, array_shift($flightarray));
    $order = 2;
    foreach($flightarray as $flight){
      $trip->addFlight($flight, $order);
      $order++;
    }

    return $trip;
  }

?>