<?php session_start();
$data = json_encode($_SESSION['data']);
echo $data;
?>
