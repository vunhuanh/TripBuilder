<?php
  //Look for corresponding flight in DB
  function searchFlight($db, $src, $dst){
    $query = "SELECT flightID FROM flight WHERE orig_airport=? AND dest_airport=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$src, $dst]);
    $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
    $flightID = $flightdata['flightID'];
    return  $flightID;
  }

  //Add trip to DB
  function tripDB($db, $tripID, $user, $type){
    $query = "INSERT INTO trip (tripID, username, type) VALUES (?, ?, ?);";
    $stmt = $db->prepare($query);
    $stmt->execute([$tripID, $user, $type]);
  }

  //Add flight to DB
  function tripFlightDB($db, $tripID, $flightID, $order){
    $query = "INSERT INTO tripFlights (tripID, flightID, orderNB) VALUES (?, ?, ?);";
    $stmt = $db->prepare($query);
    $stmt->execute([$tripID, $flightID, $order]);
  }

  //Get user's trips
  function getTrips($db, $user){
    $query = "SELECT (tripID, type) FROM trip WHERE username=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user]);
    $usertrips = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $usertrips;
  }

?>