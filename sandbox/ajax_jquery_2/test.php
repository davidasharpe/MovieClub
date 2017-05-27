<?php 

  $name = $_GET['name'];

  $result = $name;

  echo json_encode(array('result'=>$result));  

?>
