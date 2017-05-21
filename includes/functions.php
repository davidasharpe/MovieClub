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

// List all movies
function movies_directors_actors(){
  global $connection;
  global $result_movies;
  $query_movies = "SELECT MovieID, Title, Genre, ReleaseDate
                   FROM movies
                   INNER JOIN genres ON movies.GenreID = genres.GenreID
                   ORDER BY Title ASC";
  $result_movies = mysqli_query($connection, $query_movies);
  test_query($result_movies);
  while($row = mysqli_fetch_assoc($result_movies)){
    $movie_id = $row["MovieID"];
    echo "<tr>";
      echo "<td>" . $row["Title"] . "</td>";
      echo "<td>" . directors($movie_id) . "</td>";
      echo "<td>" . actors($movie_id) . "</td>";
      echo "<td>" . $row["Genre"] . "</td>";
      echo "<td>" . "<a href='view_movie.php?id={$movie_id}' class='button'>View</a></td>";
    echo "</tr>";
  }
}

// List directors for movie list
function directors($movie_id){
  global $connection;
  $query_director = "SELECT FirstName, LastName
                     FROM directors
                     INNER JOIN director_movie ON director_movie.DirectorID = directors.DirectorID
                     WHERE MovieID = {$movie_id}";
  $result_directors = mysqli_query($connection, $query_director);
  test_query($result_directors);
  $index = 1;
  $arrlength = count($result_directors);
  while ($directors = mysqli_fetch_assoc($result_directors)){
    echo $directors["FirstName"]." ".$directors["LastName"];
    if($index < $arrlength){
      echo ", ";
      $index += 1;
    }
  }
}

// List actors for movie list
function actors($movie_id){
  global $connection;
  $query_actor = "SELECT FirstName, LastName
                  FROM actors
                  INNER JOIN actor_movie ON actor_movie.ActorID = actors.ActorID
                  WHERE MovieID = {$movie_id}";
  $result_actors = mysqli_query($connection, $query_actor);
  test_query($result_actors);
  $index = 1;
  $arrlength = count($result_actors);
  while ($actors = mysqli_fetch_assoc($result_actors)){
    echo $actors["FirstName"]." ".$actors["LastName"];
    if($index < $arrlength){
      echo ", ";
      $index += 1;
    }
  }
}

// List Movie
function list_movie($movie_id){
  global $connection;
  global $result_movie;
  $query_movie = "SELECT *
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
  global $result_list_directors;
  $query_director = "SELECT *
                     FROM directors
                     INNER JOIN director_movie ON director_movie.DirectorID = directors.DirectorID
                     WHERE MovieID = {$movie_id}";
  $result_list_directors = mysqli_query($connection, $query_director);
  test_query($result_list_directors);
  return $result_list_directors;
}
// List producers
function list_producers($movie_id){
  global $connection;
  global $result_list_producers;
  $query_producer = "SELECT *
                     FROM producers
                     INNER JOIN producer_movie ON producer_movie.ProducerID = producers.ProducerID
                     WHERE MovieID = {$movie_id}";
  $result_list_producers = mysqli_query($connection, $query_producer);
  test_query($result_list_producers);
  return $result_list_producers;
}
// List actors
function list_actors($movie_id){
  global $connection;
  global $result_list_actors;
  $query_actor = "SELECT *
                  FROM actors
                  INNER JOIN actor_movie ON actor_movie.ActorID = actors.ActorID
                  WHERE MovieID = {$movie_id}";
  $result_list_actors = mysqli_query($connection, $query_actor);
  test_query($result_list_actors);
  return $result_list_actors;
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
  global $result_get_directors;
  $query = "SELECT *
            FROM directors
            ORDER BY FirstName";
  $result_get_directors = mysqli_query($connection, $query);
  test_query($result_get_directors);
  return $result_get_directors;
  mysqli_free_result($result_get_directors);
}
// Get producers
function get_producers(){
  global $connection;
  global $result_get_producers;
  $query = "SELECT *
            FROM producers
            ORDER BY FirstName";
  $result_get_producers = mysqli_query($connection, $query);
  test_query($result_get_producers);
  return $result_get_producers;
  mysqli_free_result($result_get_producers);
}
// Get actors
function get_actors(){
  global $connection;
  global $result_get_actors;
  $query = "SELECT *
            FROM actors
            ORDER BY FirstName";
  $result_get_actors = mysqli_query($connection, $query);
  test_query($result_get_actors);
  return $result_get_actors;
  mysqli_free_result($result_get_actors);
}
// Get genres
function get_genres(){
  global $connection;
  global $result_get_genres;
  $query = "SELECT *
            FROM genres
            ORDER BY Genre";
  $result_get_genres = mysqli_query($connection, $query);
  test_query($result_get_genres);
  return $result_get_genres;
}
// Get distributors
function get_distributors(){
  global $connection;
  global $result_get_distributors;
  $query = "SELECT *
            FROM distributors
            ORDER BY Distributor";
  $result_get_distributors = mysqli_query($connection, $query);
  test_query($result_get_distributors);
  return $result_get_distributors;
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
  global $result_ratings;
  $query_ratings = "SELECT Movie_RatingID, Rating, Review, UserName
                    FROM movie_rating
                    INNER JOIN members ON movie_rating.MemberID = members.MemberID
                    WHERE MovieID = {$movie_id}";
  $result_ratings = mysqli_query($connection, $query_ratings);
  test_query($result_ratings);
  return $result_ratings;
}

function get_movie_rating($movie_rating_id){
  global $connection;
  global $result_rating;
  $query_rating = "SELECT *
                   FROM movie_rating
                   WHERE Movie_RatingID = {$movie_rating_id}";
  $result_rating = mysqli_query($connection, $query_rating);
  test_query($result_rating);
  return $result_ratings;
}


?>
