<?php

class TripNode{
  private $flight;
  private $next;
  function __construct($flight){
    $this->flight = $flight;
    $this->next = NULL;
  }
}

class Trip{
  private $tripID;
  private $type;
  private $head;

  function __construct($flight){
    $this->tripID = rand();
    $this->type = 'One-way';
    $head = $flight;
  }     

  public function remove($flight){
    $this->head = NULL;
  }

  public function printItinerary(){
    $trip = array();
    $current = $this->head;
    while($current != NULL){
      array_push($trip, $current->get_flightID());
      $current = $current->next;
    }
    foreach($trip as $flight){
        echo $flight."->";
    }
  }

}

class RoundTrip extends Trip{
  function __construct($going_flight){
    $this->tripID = rand();
    $this->type = 'Round-trip';
    $head = $going_flight;
  } 

  public function add($return_flight){
    $this->head->next = $return_flight;
  }
    


}
?>