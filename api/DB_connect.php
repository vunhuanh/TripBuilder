<?php
  //Function to open connection to database 
  function getDB() {
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="TripBuilder";
    $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass); 
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
  }
