<?php
  $db = getDB();
  //$user = $request->getParam('user');
  $ftype = $request->getParam('ftype');
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');
  $addnew = $request->getParam('addnew');
  session_start();
  $user = $_SESSION['user'];

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
      $_SESSION['tripID'] = $trip->get_tripID();
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
      $trip->add($return_flight);
    }
    else if($ftype == 'Multi-city'){ 
      //If this is the first leg of a multi-city trip, make a new trip
      if($addnew == 0){
        $trip = new MultiCity($going_flight);
        $_SESSION['tripID'] = $trip->get_tripID();
      }
      //Add more flights to trip if user requested it
      else{
        $query = "SELECT flightID FROM flight WHERE orig_airport=? AND dest_airport=?;";
        $stmt = $db->prepare($query);
        $stmt->execute([$src, $dst]);
        $flightdata = $stmt->fetch(PDO::FETCH_ASSOC);
        $flightID = $flightdata['flightID'];

        $next_flight = new Flight($flightID, $src, $dst);
        $trip->add($next_flight);
      }
      
    }
    echo json_encode($trip->printItinerary(), JSON_UNESCAPED_UNICODE);

  }
   
  catch(Exception $e){
    echo "Error";
  }
?>