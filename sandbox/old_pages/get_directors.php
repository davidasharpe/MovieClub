<?php
  require_once('database.php');
  require_once('functions.php');

  $result_array = array();

  



  $query = select_2col('directors', 'FirstName', 'LastName', 'FirstName');

  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){
      array_push($result_array, $row);
    }
  }

/* send a JSON encded array to client */

  echo json_encode($result_array);

  mysqli_close($connection);

?>
