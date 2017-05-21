<?php
// Include session & functions
require_once('../includes/session.php');
require_once('../includes/functions.php');
// Include database & validation
require_once('../includes/database.php');
require_once('../includes/validation.php');
// Check if user is logged in
// Check if user is logged in, if not rediect to login page
if(($logged_in == false) || ($user_type != "admin")){
  redirect_to('login.php');
}

$movie_id = $_GET["id"];

list_movie($movie_id);

$query = "DELETE FROM movies WHERE id = {$movie_id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
  // Success
  $_SESSION["message"] = "Movie deleted.";
  redirect_to("movies.php");
} else {
  // Failure
  $_SESSION["error"] = "Movie deletion failed.";
  redirect_to("edit_movie.php?id={$movie_id}");
}

?>
