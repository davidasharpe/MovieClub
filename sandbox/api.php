<?php

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "admin";
  $pass = "password@2017";

  $databaseName = "movie_club";
  $tableName = "directors";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  
  require_once('../includes/database.php');

  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysql_query("SELECT * FROM $tableName");          //query
  $array = mysql_fetch_row($result);                          //fetch result

  //--------------------------------------------------------------------------
  // 3) echo result as json
  //--------------------------------------------------------------------------
  echo json_encode($array);

?>
