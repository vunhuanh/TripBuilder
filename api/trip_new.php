<?php
  $db = getDB();
  //Get post parameters
  $ftype = $request->getParam('ftype');
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');
  session_start();
  $user = $_SESSION['user'];

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
        //If the flight is available, make new flight and trip
        $going_flight = new Flight($flightID, $src, $dst);
        $trip;
        $tripID = rand(1, 100000000);

        if($ftype == 'One-way'){
          $trip = new Trip($tripID, $going_flight);
          $_SESSION['tripID'] = $trip->get_tripID();

          //Add to DB
          tripDB($db, $_SESSION['tripID'], $user, $ftype);
          tripFlightDB($db, $_SESSION['tripID'], $going_flight->get_flightID(), 1);
        }
        else if($ftype == 'Round-trip'){
          $trip = new RoundTrip($tripID, $going_flight);
          $_SESSION['tripID'] = $trip->get_tripID();

          $flightID = searchFlight($db, $dst, $src);
          $return_flight = new Flight($flightID, $dst, $src);
          $trip->addReturn($return_flight);

          //Add to DB
          tripDB($db, $_SESSION['tripID'], $user, $ftype);
          tripFlightDB($db, $_SESSION['tripID'], $going_flight->get_flightID(), 1);
          tripFlightDB($db, $_SESSION['tripID'], $return_flight->get_flightID(), 2);
        }

        else if($ftype == 'Multi-city'){ 
          $trip = new MultiCity($tripID, $going_flight);
          $_SESSION['tripID'] = $trip->get_tripID();

          //Add to DB
          tripDB($db, $_SESSION['tripID'], $user, $ftype);
          tripFlightDB($db, $_SESSION['tripID'], $going_flight->get_flightID(), 1);
          
        }
        //Return new trip
        echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);
      }
    }
  }

  catch(Exception $e){
    echo json_encode($e);
  }
?>