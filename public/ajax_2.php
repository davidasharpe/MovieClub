<?php

require_once('../includes/database.php');
require_once('../includes/functions.php');

$id="";
$table="";

$table_name = $_GET['name'];

if($table_name == 'directors'){
  $id = "DirectorID";
  $table = "directors";
} else if($table_name == 'producers'){
  $id = "ProducerID";
  $table = "producers";
} else if($table_name == 'actors'){
  $id = "ActorID";
  $table = "actors";
}

$query = "SELECT {$id}, FirstName, LastName
          FROM {$table}
          ORDER BY FirstName";

$result = mysqli_query($connection, $query);

$output_array = array();

if(mysqli_num_rows($result)>0){
  while ($row = mysqli_fetch_assoc($result)){
    array_push($output_array, $row);
  }
}

echo json_encode($output_array);

?>
