<?php
  require 'DBconnection.php';
  $db = getDB();
  $user = $request->getParam('user');
  $ftype = $request->getParam('ftype');
  $src = $request->getParam('src');
  $dst = $request->getParam('dst');

  try { 
    echo $user;
    echo $dst;

  } 
  catch(Exception $e) {
    echo "Error";
  }
?>