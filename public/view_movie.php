<?php
  // Include session, database, functions & validation
  require_once('../includes/session.php');
  require_once('../includes/database.php');
  require_once('../includes/functions.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_page = "movies";
  // Render header
  include('../includes/header.php');
  // Get movie id
  $movie_id = $_GET['id'];
  // Set default for movie image
  $movie_image ="";
  // Get movie data
  $query_ratings = "SELECT Rating, Review, UserName
                    FROM movie_rating
                    INNER JOIN members ON members.MemberID = movie_rating.MemberID
                    WHERE MovieID = {$movie_id}";
  $result_ratings = mysqli_query($connection, $query_ratings);
  test_query($result_ratings);
?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <?php list_movie($movie_id);
         $movie = mysqli_fetch_assoc($result_movie);
         echo "<h1>" . $movie["Title"] . "</h1>";
       ?>
       <div class="row col-sm-12"  style="margin-bottom:20px">
         <div class="col-sm-6">
           <!-- Display movie data -->
            <table class="table">
                <tr>
                  <td><b>Title</b></td>
                  <td><?php echo $movie["Title"]; ?></td>
                </tr>
                <tr>
                  <td><b>Release Date</b></td>
                  <td><?php echo $movie["ReleaseDate"]; ?></td>
                </tr>
                <tr>
                  <td><b>RunningTime</b></td>
                  <td><?php echo $movie["RunningTime"]; ?></td>
                </tr>
                <tr>
                  <td><b>Genre</b></td>
                  <td><?php echo $movie["Genre"]; ?></td>
                </tr>
                <tr>
                  <td><b>Distributor</b></td>
                  <td><?php echo $movie["Distributor"]; ?></td>
                </tr>
                <tr>
                  <td><b>Directors</b></td>
                  <td><ul class="list"><?php list_directors($movie_id) ?></ul></td>
                </tr>
                <tr>
                  <td><b>Producers</b></td>
                  <td><ul class="list"><?php list_producers($movie_id) ?></ul></td>
                </tr>
                <tr>
                  <td><b>Actors</b></td>
                  <td><ul class="list"><?php list_actors($movie_id) ?></ul></td>
                </tr>
              </table>
              <br/>
              <a type="button" href="movies.php" class="btn btn-default">Back</a>
          </div>
          <div class="col-sm-6">
            <?php
              if(isset($movie['Image'])){
                $movie_image = $movie['Image'];
                echo "<img class='movie_image' src ='" . $movie_image . "'/>";
              }
             ?>
          </div>
         </div>
         <!-- Rate Movie -->
         <?php if($logged_in == true) {include('../includes/rate_movie.php');}
         ?>
           <!-- END Rate Movie -->
           <div class="row col-sm-12">
             <h2>Movie Ratings</h2>
             <table class="table">
               <tr>
                <th>Rating</th>
                <th>Review</th>
                <th>Member</th>
              </tr>
               <?php
                // Use returned data (if any)
                while($row = mysqli_fetch_assoc($result_ratings)){
               ?>
                <tr>
                  <td>
                    <?php
                      $num_stars = $row["Rating"];
                      $star = "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
                      for ($i = 1; $i <= $num_stars; $i++) {
                        echo $star;
                      }
                    ?>
                  </td>
                  <td><?php echo $row["Review"] ?></td>
                  <td><?php echo $row["UserName"] ?></td>
                </tr>
               <?php
                }
               ?>
             </table>
           </div>
         </div>
     </div>
   </div>
<?php
  include('../includes/footer.php');
?>
