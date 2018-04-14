<?php
  $db = getDB();
  $tripID = $request->getParam('tripID');
  $flightID = $request->getParam('flightID');
  session_start();
  $tripID = $_SESSION['tripID'];

  try{ 
    $trip = build($db, $tripID);
    $trip->removeFlight($flightID);
    deleteFlight($db, $tripID, $flightID);
    $trip->updateTripDB($db, $tripID);

  }

  catch(Exception $e){
    echo json_encode($e);
  }
?>