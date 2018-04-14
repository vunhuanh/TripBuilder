<?php
  $db = getDB();
  //Get post parameters
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');
  session_start();
  $user = $_SESSION['user'];
  $tripID = $_SESSION['tripID'];

  try{ 
    $trip = build($tripID, $db);

    //Add new flight to trip
    $flightID = searchFlight($db, $src, $dst);
    $next_flight = new Flight($flightID, $src, $dst);
    $trip->addFlight($next_flight, $trip->length()+1);

    //Add to DB
    tripFlightDB($db, $_SESSION['tripID'], $next_flight->get_flightID(), $trip->length()+1);

    echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);

  }

  catch(Exception $e){
    echo json_encode($e);
  }
?>