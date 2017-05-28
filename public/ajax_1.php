<?php

require_once('../includes/database.php');
require_once('../includes/functions.php');

$id="";
$table="";

$table_name = $_GET['name'];

if($table_name == 'genres'){
  $id = "GenreID";
  $table = "genres";
} else if($table_name == 'distributors'){
  $id = "DistributorID";
  $table = "distributors";
}

$query = "SELECT {$id}, Name
          FROM {$table}
          ORDER BY Name";

$result = mysqli_query($connection, $query);

$output_array = array();

if(mysqli_num_rows($result)>0){
  while ($row = mysqli_fetch_assoc($result)){
    array_push($output_array, $row);
  }
}

echo json_encode($output_array);

?>
