<?php

class Trip{
  private $tripID;
  private $type;
  protected $flights = array();

  //Constructor, get and set functions
  public function __construct($going_flight){
    $this->tripID = rand();
    $this->type = "One-way";
    array_push($this->flights, $going_flight);
  }     
  public function get_tripID(){
      return $this->tripID;
  }
  public function get_type(){
      return $this->type;
  }

  //Print trip itinerary
  public function printItinerary(){
    $toprint = array();
    foreach ($this->flights as $flight) {
      array_push($toprint, $flight->get_details());
    }
    return $toprint;
  }

  //Add new flight to trip
  public function add($new_flight){
    return "Cannot add more flights to a one-way trip.\n";
  }

  //Add trip info to database tables
  public function tripToDB($user){
    $query = "INSERT VALUES (?, ?, ?) INTO trip;";
    $stmt = $db->prepare($query);
    $stmt->execute([$this->tripID, $user, $this->type]);
  }
  public function flightToDB($flight){
    $query = "INSERT VALUES (?, ?) INTO tripFlights;";
    $stmt = $db->prepare($query);
    $stmt->execute([$this->tripID, $flight->get_flightID()]);
  }

}

class RoundTrip extends Trip{
  public function __construct($going_flight){
    parent::__construct($going_flight);
    $this->type = "Round-trip";
  } 

  public function add($return_flight){
    array_push($this->flights, $return_flight);
  }
    
}

class MultiCity extends Trip{
  public function __construct($going_flight){
    parent::__construct($going_flight);
    $this->type = "Multi-city";
  } 

  public function add($new_flight){
    array_push($this->flights, $new_flight);
  }
    
}
?>