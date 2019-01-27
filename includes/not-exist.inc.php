<?php session_start();
  if(isset($_SESSION['failed'])) {
    $data = $_SESSION['failed'];
    session_destroy();
    echo $data;
  }
?>
