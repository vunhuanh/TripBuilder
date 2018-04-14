<?php

class Trip{
  private $tripID;
  private $type;
  protected $flights = array();

  //Constructor, get and set functions
  public function __construct($going_flight){
    $this->tripID = rand(1, 100000000);
    $this->type = "One-way";
    $this->flights["1"] = $going_flight;
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
    array_push($toprint, $this->tripID);
    foreach ($this->flights as $flight) {
      array_push($toprint, $flight->get_details());
    }
    return $toprint;
  }

  //Get number of flights in trip
  public function length(){
    return sizeof($this->flights);
  }

}

class RoundTrip extends Trip{
  public function __construct($going_flight){
    parent::__construct($going_flight);
    $this->type = "Round-trip";
  } 

  public function addReturn($return_flight){
    $this->flights["2"] = $return_flight;
  }
    
}

class MultiCity extends Trip{
  public function __construct($going_flight){
    parent::__construct($going_flight);
    $this->type = "Multi-city";
  } 

  public function addFlight($new_flight, $order){
    $this->flights[$order] = $new_flight;
  }
    
}
?>