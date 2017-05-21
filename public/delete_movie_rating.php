<?php
// Include session & functions
require_once('../includes/session.php');
require_once('../includes/functions.php');
// Include database & validation
require_once('../includes/database.php');
require_once('../includes/validation.php');
// Check if user is logged in, if not rediect to login page
if(($logged_in == false) || ($user_type != "admin")){
  redirect_to('login.php');
}

$movie_rating_id = $_GET["id"];

get_movie_rating($movie_rating_id);

$movie_rating = mysqli_fetch_assoc($result_rating);

$movie_id = $movie_rating["MovieID"];

$query = "DELETE FROM movie_rating WHERE Movie_RatingID = {$movie_rating_id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
  // Success
  $_SESSION["message"] = "Rating deleted.";
  redirect_to("view_movie.php?id={$movie_id}");
} else {
  // Failure
  $_SESSION["error"] = "Rating deletion failed.";
  redirect_to("view_movie.php?id={$movie_id}");
}

?>
