<?php
  $db = getDB();
  //Get post parameters
  $ftype = $request->getParam('ftype');
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');
  $order = $request->getParam('order');
  session_start();
  $user = $_SESSION['user'];

  try{ 
    //Find flight with corresponding origin and destination airports
    $query = "SELECT flightID FROM flight WHERE orig_airport=? AND dest_airport=?;";
    $stmt = $db->prepare($query);
    $stmt->execute([$src, $dst]);
    $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
    $flightID = $flightdata['flightID'];

    //If the flight is available, make new flight and trip
    $going_flight = new Flight($flightID, $src, $dst);
    $trip;

    if($ftype == 'One-way'){
      $trip = new Trip($going_flight);
      $_SESSION['tripID'] = $trip->get_tripID();

      //Add to DB
      $query = "INSERT INTO trip (tripID, username, type) VALUES (?, ?, ?);";
      $stmt = $db->prepare($query);
      $stmt->execute([$_SESSION['tripID'], $user, $ftype]);

      $query = "INSERT INTO tripFlights (tripID, flightID, orderNB) VALUES (?, ?, ?);";
      $stmt = $db->prepare($query);
      $stmt->execute([$_SESSION['tripID'], $going_flight->get_flightID(), 1]);
    }

    else if($ftype == 'Round-trip'){
      $trip = new RoundTrip($going_flight);
      $_SESSION['tripID'] = $trip->get_tripID();

      $query = "SELECT flightID FROM flight WHERE orig_airport=? AND dest_airport=?";
      $stmt = $db->prepare($query);
      $stmt->execute([$dst, $src]);
      $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
      $flightID = $flightdata['flightID'];

      $return_flight = new Flight($flightID, $dst, $src);
      $trip->addReturn($return_flight);

      //Add to DB
      $query = "INSERT INTO trip (tripID, username, type) VALUES (?, ?, ?);";
      $stmt = $db->prepare($query);
      $stmt->execute([$_SESSION['tripID'], $user, $ftype]);

      $query = "INSERT INTO tripFlights (tripID, flightID, orderNB) VALUES (?, ?, ?);";
      $stmt = $db->prepare($query);
      $stmt->execute([$_SESSION['tripID'], $going_flight->get_flightID(), 1]);
      $query = "INSERT INTO tripFlights (tripID, flightID, orderNB) VALUES (?, ?, ?);";
      $stmt = $db->prepare($query);
      $stmt->execute([$_SESSION['tripID'], $return_flight->get_flightID(), 2]);
    }

    else if($ftype == 'Multi-city'){ 
      $trip = new MultiCity($going_flight);
      $_SESSION['tripID'] = $trip->get_tripID();

      //Add to DB
      $query = "INSERT INTO trip (tripID, username, type) VALUES (?, ?, ?);";
      $stmt = $db->prepare($query);
      $stmt->execute([$_SESSION['tripID'], $user, $ftype]);

      $query = "INSERT INTO tripFlights (tripID, flightID, orderNB) VALUES (?, ?, ?);";
      $stmt = $db->prepare($query);
      $stmt->execute([$_SESSION['tripID'], $going_flight->get_flightID(), 1]);
      
    }
    echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);

  }

  catch(Exception $e){
    echo json_encode($e);
  }
?>