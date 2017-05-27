<?php
  // Include session, database, functions & validation
  require_once('../includes/session.php');
  require_once('../includes/database.php');
  require_once('../includes/functions.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_parent_page = "movies";
  $active_page = "view_movies";
  // Render header
  include('../includes/header.php');
  // Get movie id
  $movie_id = $_GET['id'];
  // Set default for movie image
  $result_directors = "";
  $result_producers = "";
  $result_actors = "";
  $movie_image ="";
  // Get movie data
  list_movie($movie_id);
    $movie = mysqli_fetch_assoc($result_movie);
  // Get movie ratings
  list_movie_ratings($movie_id);
?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <div class="col-md-12 view_movie" style="margin-bottom:20px">
         <?php echo "<h1>" . $movie["Title"] . "</h1>"; ?>
         <div class="col-md-6">
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
                  <?php list_directors($movie_id); ?>
                  <td>
                    <ul class="list">
                      <?php
                      while ($directors = mysqli_fetch_assoc($result_list_directors)){
                        echo "<li>".$directors["FirstName"]." ".$directors["LastName"]."</li>";}
                      ?>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td><b>Producers</b></td>
                    <?php list_producers($movie_id); ?>
                  <td>
                    <ul class="list">
                      <?php while ($producers = mysqli_fetch_assoc($result_list_producers)){
                        echo "<li>".$producers["FirstName"]." ".$producers["LastName"]."</li>";}
                      ?>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <td><b>Actors</b></td>
                    <?php list_actors($movie_id); ?>
                  <td>
                    <ul class="list">
                      <?php while ($actors = mysqli_fetch_assoc($result_list_actors)){
                        echo "<li>".$actors["FirstName"]." ".$actors["LastName"]."</li>";}
                        ?>
                    </ul>
                  </td>
                </tr>
              </table>
              <br/>
              <a type="button" href="movies.php" class="btn btn-default">Back</a>
              <?php if(($logged_in == true) && ($user_type == "admin")){
                echo "<a type='button' href='edit_movie.php?id={$movie_id}' class='btn btn-default'>Edit</a>";
              }
              ?>
            </div>
            <div class="col-md-6">
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
           <div class="column-bg">
             <h2>Movie Ratings</h2>
             <?php if(isset($_SESSION["message"])){echo "<h6 class='bg-success'>".$_SESSION["message"]."</h6>"; $_SESSION["message"] = "";} ?>
             <?php if(isset($_SESSION["error"])){echo "<h6 class='bg-danger'>".$_SESSION["error"]."</h6>"; $_SESSION["error"] = "";} ?>
               <table class="table">
                 <tr>
                  <th>Rating</th>
                  <th>Review</th>
                  <th>Member</th>
                  <th></th>
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
                    <td>
                    <?php if (isset($_SESSION["user_type"])){
                      if ($_SESSION["user_type"] == "admin"){
                      echo "<a href='delete_movie_rating.php?id=".urlencode($row["Movie_RatingID"]).
                        "' onclick='return confirm(\"This record will be permanently deleted. Are you sure you want to do this?\");'".
                        "class='btn btn-danger'>Delete</a>";}
                      }
                    ?>
                    </td>
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
