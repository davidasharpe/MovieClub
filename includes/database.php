<?php
  // Database default connection values
  $host = "localhost";
  $user = "admin";
  $password = "password@2017";
  $name = "movie_club";
  $connection = mysqli_connect($host, $user, $password, $name);
  // Test database connection
  if (mysqli_connect_errno()){
    die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
    echo "<p class='message error'>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
  }
?>
