<?php

class Flight{
  private $flightID;
  private $origin;
  private $destination;
  private $next;

  public function get_flightID(){
      return $this->flightID;
  }
  public function get_origin(){
      return $this->origin;
  }
  public function get_destination(){
      return $this->destination;
  }
  
  function __construct($flightID, $origin, $destination){
    $this->flightID = $flightID;
    $this->origin = $origin;
    $this->destination = $destination;
    $this->next = NULL;
  }
}


?>