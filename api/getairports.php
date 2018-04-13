<?php
  $db = getDB();

  try{
    $query = "SELECT * FROM airport ORDER BY airport_name;";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $airportnames = $stmt->fetchAll(PDO::FETCH_NUM);
    echo json_encode($airportnames, JSON_UNESCAPED_UNICODE);
  }
  catch(Exception $e){
    echo json_encode($e);
  }

?>