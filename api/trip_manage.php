<?php
  $db = getDB();
  //Get post parameters
  $ftype = $request->getParam('ftype');
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');
  $order = $request->getParam('order');
  session_start();
  $user = $_SESSION['user'];

  try{
    if()

  }
  catch(Exception $e){
    echo json_encode($e);
  }
?>