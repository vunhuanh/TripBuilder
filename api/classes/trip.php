<?php

class Trip{
  private $tripID;
  private $type;
  protected $flights = array();

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
  public function printItinerary(){
    $toprint = "";
    foreach ($this->flights as $flight) {
      $toprint .= $flight->get_flightID() . "->";
    }
    return $toprint;
  }

  public function add($new_flight){
    return "Cannot add more flights to a one-way trip.\n";
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
?>