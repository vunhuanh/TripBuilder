<?php
  $db = getDB();
  $tripID = $request->getParam('tripID');
  $flightID = $request->getParam('flightID');
  session_start();
  $tripID = $_SESSION['tripID'];

  try{ 
    //Make Trip object
    $trip = build($db, $tripID);
    //Remove Flight object from Trip
    $trip->removeFlight($flightID);
    //Delete flight from DB
    deleteFlight($db, $tripID, $flightID);
    //Update FB order
    $trip->updateTripDB($db, $tripID);

  }

  catch(Exception $e){
    echo json_encode($e);
  }
?>