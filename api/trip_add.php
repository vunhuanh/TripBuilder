<?php
  $db = getDB();
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');
  $tripID = $request->getParam('tripID');

  try{ 
    //Check that origin and destination are different airports
    if($src == $dst){
      $result = "same";
      echo json_encode($result);
    }
    else{
      //Find flight with corresponding origin and destination airports
      $flightID = searchFlight($db, $src, $dst);

      //If there are no flights, return
      if($flightID == NULL){
        $result = "noflight";
        echo json_encode($result);
      }
      else{
        //Add new flight to trip
        $next_flight = new Flight($flightID, $src, $dst);
        $trip = build($db, $tripID);
        $trip->addFlight($next_flight, $trip->length()+1);

        //Add to DB
        tripFlightDB($db, $tripID, $next_flight->get_flightID(), $trip->length());

        echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);
      }
    }
  }

  catch(PDOException $e){
    $result = "sqlerror";
    echo json_encode($result);
  }
?>