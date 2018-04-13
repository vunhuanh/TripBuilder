<?php
  try{
    session_start();
    session_destroy();
  }
  catch(Exception $e){
    echo json_encode($e);
  }
?>