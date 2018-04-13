<?php
  $db = getDB();
  $user = $request->getParam('user');
  $ftype = $request->getParam('ftype');
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');

  try{ 
    $query = "SELECT flightID FROM flight WHERE orig_airport=? AND dest_airport=?;";
    $stmt = $db->prepare($query);
    $stmt->execute([$src, $dst]);
    $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
    $flightID = $flightdata['flightID'];

    $going_flight = new Flight($flightID, $src, $dst);
    
    $trip;
    if($ftype == 'One-way'){
      $trip = new Trip($going_flight);
      echo "Added one-way trip: ".$trip->printItinerary()."\n";
    }
    else if($ftype == 'Round-trip'){
      $trip = new RoundTrip($going_flight);

      $query = "SELECT flightID FROM flight WHERE orig_airport=? AND dest_airport=?";
      $stmt = $db->prepare($query);
      $stmt->execute([$dst, $src]);
      $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
      $flightID = $flightdata['flightID'];

      $return_flight = new Flight($flightID, $dst, $src);
      $trip->add($return_flight);

      echo "Added round-trip: ".$trip->printItinerary()."\n";
    }
    // // else if($ftype == 'Multi-city'){

    // // }


  } 
  catch(Exception $e){
    echo "Error";
  }
?>