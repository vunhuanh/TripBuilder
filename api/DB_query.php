<?php
  //Get users
  function getUsers($db){
    $query = "SELECT username FROM user;";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_NUM);
    return $users;
  }

  function getAirports($db){
    $query = "SELECT * FROM airport ORDER BY airport_name;";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $airportnames = $stmt->fetchAll(PDO::FETCH_NUM);
    return $airportnames;
  }

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

  //Update flight order
  function tripUpdate($db, $tripID, $flightID, $order){
    $query = "UPDATE tripFlights SET orderNB=? WHERE tripid=? AND flightid=?;";
    $stmt = $db->prepare($query);
    $stmt->execute([$order, $tripID, $flightID]);
  }

  //Get user's trips
  function getTrips($db, $user){
    $query = "SELECT tripID, type FROM trip WHERE username=? ORDER BY tripID;";
    $stmt = $db->prepare($query);
    $stmt->execute([$user]);
    $usertrips = $stmt->fetchAll(PDO::FETCH_NUM);
    return $usertrips;
  }

  //Get trip itinerary
  function getItinerary($db, $tripID){
    $query = "SELECT * FROM tripFlights t JOIN flight f ON t.flightID = f.flightID WHERE t.tripID = ? ORDER BY f.flightID;";
    $stmt = $db->prepare($query);
    $stmt->execute([$tripID]);
    $flightdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $flightdata;
  }

  //Delete flight
  function deleteFlight($db, $tripID, $flightID){
    $query = "DELETE FROM tripFlights WHERE tripID=? AND flightID=?;";
    $stmt = $db->prepare($query);
    $stmt->execute([$tripID, $flightID]);
  }

  //Delete trip
  function deleteTrip($db, $tripID){
    $query = "DELETE FROM tripFlights WHERE tripID=?;";
    $stmt = $db->prepare($query);
    $stmt->execute([$tripID]);

    $query = "DELETE FROM trip WHERE tripID=?;";
    $stmt = $db->prepare($query);
    $stmt->execute([$tripID]);
  }

?>