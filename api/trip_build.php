<?php

  function build($tripID, $db){
    $query = "SELECT * FROM tripFlights t JOIN flight f ON t.flightID = f.flightID WHERE t.tripID = ?;";
    $stmt = $db->prepare($query);
    $stmt->execute([$tripID]);
    $flightdata = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $flightarray = array();
    foreach($flightdata as $flight){
      $existing_flight = new Flight($flight['flightID'], $flight['orig_airport'], $flight['dest_airport']);
      array_push($flightarray, $existing_flight);
    }
    
    $trip = new MultiCity(array_shift($flightarray));
    $order = 2;
    foreach($flightarray as $flight){
      $trip->addFlight($flight, $order);
      $order++;
    }

    return $trip;
  }

?>