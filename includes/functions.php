<?php
// Redirect function
function redirect_to($new_location) {
  header("Location: " . $new_location);
  exit;
}
// Test Query
function test_query($query_result){
  if(!$query_result){
    die("Database query failed.");
  }
}
// Test Query Result on Insert
function test_insert_query($query_result){
  global $connection;
  if ($query_result) {
    $message = "New record successfully added to the database";
    return $message;
  } else {
    // Failure
    die("Database query failed. " . mysqli_error($connection));
    $message = "Failed to update database";
    return $message;
  }
}
// List all movies
function list_all_movies(){
  global $connection;
  global $result_movies;
  $query_movies = "SELECT MovieID, Title, ReleaseDate, RunningTime, Genre, Distributor
                   FROM movies
                   INNER JOIN genres ON movies.GenreID = genres.GenreID
                   INNER JOIN distributors ON movies.DistributorID = distributors.DistributorID
                   ORDER BY Title ASC";
  $result_movies = mysqli_query($connection, $query_movies);
  test_query($result_movies);

  return $result_movies;
}
// View Movie
function list_movie($movie_id){
  global $connection;
  global $result_movie;
  $query_movie = "SELECT Title, ReleaseDate, RunningTime, Genre, Distributor, Image
                  FROM Movies
                  INNER JOIN genres ON movies.GenreID = genres.GenreID
                  INNER JOIN distributors ON movies.DistributorID = distributors.DistributorID
                  WHERE MovieID = {$movie_id}";
  $result_movie = mysqli_query($connection, $query_movie);
  test_query($result_movie);
  return $result_movie;
}
// List directors
function list_directors($movie_id){
  global $connection;
  $query_director = "SELECT FirstName, LastName
                     FROM directors
                     INNER JOIN director_movie ON director_movie.DirectorID = directors.DirectorID
                     WHERE MovieID = {$movie_id}";
  $result_directors = mysqli_query($connection, $query_director);
  test_query($result_directors);
  while ($directors = mysqli_fetch_assoc($result_directors)){
    echo "<li>".$directors["FirstName"]." ".$directors["LastName"]."</li>";
  }
}
// List producers
function list_producers($movie_id){
  global $connection;
  $query_producer = "SELECT FirstName, LastName
                     FROM producers
                     INNER JOIN producer_movie ON producer_movie.ProducerID = producers.ProducerID
                     WHERE MovieID = {$movie_id}";
  $result_producers = mysqli_query($connection, $query_producer);
  test_query($result_producers);
  while ($producers = mysqli_fetch_assoc($result_producers)){
    echo "<li>".$producers["FirstName"]." ".$producers["LastName"]."</li>";
  }
}
// List actors
function list_actors($movie_id){
  global $connection;
  $query_actor = "SELECT FirstName, LastName
                  FROM actors
                  INNER JOIN actor_movie ON actor_movie.ActorID = actors.ActorID
                  WHERE MovieID = {$movie_id}";
  $result_actors = mysqli_query($connection, $query_actor);
  test_query($result_actors);
  while ($actors = mysqli_fetch_assoc($result_actors)){
    echo "<li>".$actors["FirstName"]." ".$actors["LastName"]."</li>";
  }
}
// Add Movies
function select_all($table, $order){
  global $connection;
  global $query_result;
  $query = "SELECT *
            FROM {$table}
            ORDER BY {$order}";
  $query_result = mysqli_query($connection, $query);
  test_query($query_result);
  return $query_result;
}
// Get directors
function get_directors(){
  global $connection;
  $query = "SELECT *
            FROM directors
            ORDER BY FirstName";
  $result_director = mysqli_query($connection, $query);
  test_query($result_director);
  while ($directors = mysqli_fetch_assoc($result_director)){
        echo "<option value='{$directors["DirectorID"]}'>".$directors["FirstName"]." ".$directors["LastName"]."</option>";
    }
  mysqli_free_result($result_director);
}
// Get producers
function get_producers(){
  global $connection;
  $query = "SELECT *
            FROM producers
            ORDER BY FirstName";
  $result_producer = mysqli_query($connection, $query);
  test_query($result_producer);
  while ($producers = mysqli_fetch_assoc($result_producer)){
    echo "<option value='{$producers["ProducerID"]}'>".$producers["FirstName"]." ".$producers["LastName"]."</option>";
  }
  mysqli_free_result($result_producer);
}
// Get actors
function get_actors(){
  global $connection;
  $query = "SELECT *
            FROM actors
            ORDER BY FirstName";
  $result_actor = mysqli_query($connection, $query);
  test_query($result_actor);
  while ($actors = mysqli_fetch_assoc($result_actor)){
    echo "<option value='{$actors["ActorID"]}'>".$actors["FirstName"]." ".$actors["LastName"]."</option>";
  }
  mysqli_free_result($result_actor);
}
// Get genres
function get_genres(){
  global $connection;
  global $query_result;
  $query = "SELECT *
            FROM genres
            ORDER BY Genre";
  $query_genres = mysqli_query($connection, $query);
  test_query($query_genres);
  while ($genres = mysqli_fetch_assoc($query_genres)){
    echo "<option value='{$genres["GenreID"]}'>".$genres["Genre"]."</option>";
  }
}
// Get distributors
function get_distributors(){
  global $connection;
  global $query_result;
  $query = "SELECT *
            FROM distributors
            ORDER BY Distributor";
  $query_distributors = mysqli_query($connection, $query);
  test_query($query_distributors);
  while ($distributors = mysqli_fetch_assoc($query_distributors)){
    echo "<option value='{$distributors["DistributorID"]}'>".$distributors["Distributor"]."</option>";
  }
}
// Password encryption
function password_encrypt($password) {
  $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
  return $hash;
}
// List all members
function list_all_members(){
  global $connection;
  global $result_members;
  $query_members = "SELECT *
                    FROM members
                    ORDER BY FirstName ASC";
  $result_members = mysqli_query($connection, $query_members);
  test_query($result_members);
  return $result_members;
}
// Get member
function get_member($member_id){
  global $connection;
  global $result_member;
  $query_member = "SELECT *
                   FROM members
                   WHERE MemberID = {$member_id}";
  $result_member = mysqli_query($connection, $query_member);
  test_query($result_member);
  return $result_member;
}
// List movie ratings
function list_movie_ratings($movie_id){
  global $connection;
  global $result;
  $query_ratings = "SELECT MovieID, Rating, Review, MemberID
                    FROM movie_rating
                    WHERE MovieID = {$movie_id}";
  $result_ratings = mysqli_query($connection, $query_ratings);
  test_query($result_ratings);
  return $result_ratings;
}
?>
