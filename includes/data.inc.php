<?php session_start();
if(is_array($_SESSION['data'][0])) {
  $data = array_values($_SESSION['data']);
  echo json_encode($data);
} else {
  $data = json_encode($_SESSION['data']);
  echo $data;
}
?>
