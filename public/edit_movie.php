<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
    // Check if user is logged in, if not rediect to login page
    if(($logged_in == false) || ($user_type != "admin")){
      redirect_to('login.php');
    }
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Get movie id
  $movie_id = $_GET['id'];
  // Set active page for navigation
  $active_parent_page = "movies";
  $active_page = "add_movie";
  // Render header
  include('../includes/header.php');
  list_movie($movie_id);
  $movie = mysqli_fetch_assoc($result_movie);
  //Check form submit
  if(isset($_POST['submit'])){
    // Initialise variables
    $form_errors = false;
    $success_message = "";
    $error_message = "";
    // Get post values and remove whitespace
    $title = trim($_POST['title']);
    $release_date = trim($_POST['release_date']);
    $running_time = trim($_POST['running_time']);
    $genre = trim($_POST['genre']);
    $distributor = trim($_POST['distributor']);
    $image = trim($_POST['image']);
    // Filter input
    $title = mysqli_real_escape_string($connection, $title);
    $release_date = filter_var($release_date, FILTER_SANITIZE_NUMBER_INT);
    $running_time = intval($running_time);
    // Validate fileds
    validate_text($title, 'the movie title');
    validate_date($release_date);
    validate_time($running_time);
    validate_select_field($genre);
    validate_select_field($distributor);
    // Validate directors
    if(isset($_POST['directors'])) {
      $directors = $_POST['directors'];
      validate_select_field($directors);
    }
    // Validate producers
    if(isset($_POST['producers'])) {
      $producers = $_POST['producers'];
      validate_select_field($producers);
    }
    // Validate actors
    if(isset($_POST['actors'])) {
      $actors = $_POST['actors'];
      validate_select_field($actors);
    }
    // Debug

    echo $title."<br/>";
    echo $release_date."<br/>";
    echo $running_time."<br/>";
    echo $genre."<br/>";
    echo $distributor."<br/>";
    echo $image."<br/>";
    foreach ($directors as $director) {
      echo $director."<br/>";
    }
    foreach ($producers as $producer) {
      echo $producer."<br/>";
    }
    foreach ($directors as $actor) {
      echo $actor."<br/>";
    }

    // if there are no errors Update database
    if($form_errors == false){
      $update_movie = "UPDATE movies
                       SET Title = '{$title}', ReleaseDate = '{$release_date}', RunningTime = '{{$running_time}}',
                           GenreID = '{$genre}', DistributorID = '{$distributor}', Image = {$image}
                       WHERE MovieID = '{$movie_id}'";
      if(mysqli_query($connection, $update_movie)){
        // Update Director(s) to movie
        foreach ($directors as $director) {
          $update_director = "UPDATE director_movie
                              SET DirectorID = '{$director}', MovieID = '{$movie_id}'
                              WHERE MovieID = '{$movie_id}'";
          mysqli_query($connection, $update_director);
        }
        // Add Producer(s) to new movie
        foreach($producers as $producer){
          $update_producer = "UPDATE producer_movie
                              SET ProducerID = '{{$producer}}', MovieID = '{$movie_id}'
                              WHERE MovieID = '{$movie_id}'";
          mysqli_query($connection, $update_producer);
        }
        // Add Actor(s) to new movie
        foreach($actors as $actor){
          $update_actor = "UPDATE actor_movie
                           SET ActorID = '{$actor}', MovieID = '{$movie_id}'
                           WHERE MovieID = '{$movie_id}'";
          mysqli_query($connection, $update_actor);
        }
        // Success message
        $success_message = "<p class='bg-success'>The movie has been successfully updated on the database.</p>";
      } else {
        // Error message
        $error_message .= "<p class='bg-danger'>There was an error. Please try again.</p>";
      }
    }
  }
?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Edit Movie</h1>
       <div class="column-bg">
         <form name="add_movie" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-5">
              <?php if(isset($success_message)) { echo $success_message; } ?>
              <?php if(isset($error_message)) { echo $error_message; } ?>
              <?php if(isset($_SESSION["error"])){echo "<h6 class='bg-danger'>".$_SESSION["error"]."</h6>"; $_SESSION["error"] = "";} ?>
            </div>
          </div>
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-5">
              <input type="texbox" class="form-control" id="title" name="title" placeholder="title of movie" value="<?php echo $movie["Title"]; ?>" data-validation="required">
            </div>
            <div class=col-sm-5>
            </div>
          </div>
          <div class="form-group">
            <label for="director" class="col-sm-2 control-label">Director</label>
              <div class="col-sm-5">
                <div class="director">
                  <?php get_directors(); list_directors($movie_id);
                  $number_rows = mysqli_num_rows($result_list_directors);
                  $count = 1;
                  echo "<p>";
                  while ($directors = mysqli_fetch_assoc($result_list_directors)){
                    echo $directors["FirstName"]." ".$directors["LastName"]; if($count < $number_rows){echo", ";}
                    $count++;
                  }
                  echo "</p>";
                  ?>
                  <select multiple class="form-control" id="directors" name="directors[]" data-validation="required">
                    <?php
                    while ($directors = mysqli_fetch_assoc($result_get_directors)){
                          echo "<option value='{$directors["DirectorID"]}'";
                          list_directors($movie_id);
                            while ($select_directors = mysqli_fetch_assoc($result_list_directors)){
                              if($select_directors["DirectorID"] == $directors["DirectorID"]){
                                echo " selected";}
                            }
                          echo ">".$directors["FirstName"]." ".$directors["LastName"]."</option>";
                    }
                    ?>
                  </select>
                  <h6>To Select multiple items, PC: Ctrl + click, Mac: Cmd + click</h6>
                </div>
                <a href="add_director.php" class="link">Add Director(s)</a>
              </div>
              <div class="col-sm-5">
              </div>
          </div>
          <div class="form-group">
            <label for="producer" class="col-sm-2 control-label">Producer</label>
            <div class="col-sm-5">
              <div class="producer">
                <?php get_producers(); list_producers($movie_id);
                $number_rows = mysqli_num_rows($result_list_producers);
                $count = 1;
                echo "<p>";
                while ($select_producers = mysqli_fetch_assoc($result_list_producers)){
                  echo $select_producers["FirstName"]." ".$select_producers["LastName"]; if($count < $number_rows){echo", ";}
                  $count++;
                }
                echo "</p>";
                ?>
                <select multiple class="form-control" id="producers" name="producers[]" data-validation="required">
                  <?php
                  while ($producers = mysqli_fetch_assoc($result_get_producers)){
                    echo "<option value='{$producers["ProducerID"]}'";
                      list_producers($movie_id);
                      while ($select_producers = mysqli_fetch_assoc($result_list_producers)){
                        if($select_producers["ProducerID"] == $producers["ProducerID"]){
                          echo " selected";}
                      }
                    echo ">".$producers["FirstName"]." ".$producers["LastName"]."</option>";
                  }
                  ?>
                </select>
                  <h6>To Select multiple items, PC: Ctrl + click, Mac: Cmd + click</h6>
              </div>
              <a href="add_producer.php" class="link">Add Producer(s)</a>
            </div>
            <div class="col-sm-5">
            </div>
          </div>
          <div class="form-group">
            <label for="release_date" class="col-sm-2 control-label">Release Date</label>
            <div class="col-sm-5">
              <input type="date" class="form-control" id="release_date" name="release_date" data-validation="required date" data-validation-format="yyyy-mm-dd" value="<?php echo $movie["ReleaseDate"]; ?>">
            </div>
            <div class="col-sm-5">
            </div>
          </div>
          <div class="form-group">
            <label for="running_time" class="col-sm-2 control-label">Running Time</label>
            <div class="col-sm-5">
              <input type="texbox" class="form-control" id="running_time" name="running_time" data-validation="required number" data-validation-allowing="range[1;999]" placeholder="minutes" value="<?php echo $movie["RunningTime"]; ?>" >
            </div>
            <div class="col-sm-5">
            </div>
          </div>
          <div class="form-group">
            <label for="genre" class="col-sm-2 control-label">Genre</label>
            <div class="col-sm-5">
              <?php echo "<p>".$movie["Genre"]."</p>" ?>
              <?php get_genres(); ?>
              <select class="form-control" id="genre" name="genre" data-validation="required">
                <option value="">select</option>
                  <?php
                  while ($genres = mysqli_fetch_assoc($result_get_genres)){
                    echo "<option value='{$genres["GenreID"]}'";
                    list_movie($movie_id);
                    while ($movie = mysqli_fetch_assoc($result_movie)){
                      if($movie["GenreID"] == $genres["GenreID"]){
                        echo " selected";}
                    }
                    echo ">".$genres["Genre"]."</option>";
                  }
                  ?>
              </select>
              <a href="add_genre.php" class="link">Add Genre</a>
            </div>
            <div class="col-sm-5">
            </div>
          </div>
          <div class="form-group">
            <label for="actor" class="col-sm-2 control-label">Actor(s)</label>
            <div class="col-sm-5">
              <div class="actor">
                <?php get_actors(); list_actors($movie_id);
                $number_rows = mysqli_num_rows($result_list_actors);
                $count = 1;
                echo "<p>";
                while ($actors = mysqli_fetch_assoc($result_list_actors)){
                  echo $actors["FirstName"]." ".$actors["LastName"]; if($count < $number_rows){echo", ";}
                  $count++;
                }
                echo "</p>";
                ?>
                <select multiple class="form-control" id="actors" name="actors[]" data-validation="required">
                  <?php
                  while ($actors = mysqli_fetch_assoc($result_get_actors)){
                    echo "<option value='{$actors["ActorID"]}'";
                      list_actors($movie_id);
                      while ($select_actors = mysqli_fetch_assoc($result_list_actors)){
                        if($select_actors["ActorID"] == $actors["ActorID"]){
                          echo " selected";}
                      }
                    echo ">".$actors["FirstName"]." ".$actors["LastName"]."</option>";
                  }
                  ?>
                </select>
                <h6>To Select multiple items, PC: Ctrl + click, Mac: Cmd + click</h6>
              </div>
              <a href="add_actor.php" class="link">Add Actor</a>
            </div>
            <div class="col-sm-5">
            </div>
          </div>
          <div class="form-group">
            <?php
            list_movie($movie_id);
            $movie = mysqli_fetch_assoc($result_movie);
            ?>
            <label for="distributor" class="col-sm-2 control-label">Distributor</label>
            <div class="col-sm-5">
              <?php echo "<p>".$movie["Distributor"]."</p>"; ?>
              <?php get_distributors();?>
              <select class="form-control" id="distributor" name="distributor" data-validation="required">
                <option value="">select</option>
                <?php
                while ($distributors = mysqli_fetch_assoc($result_get_distributors)){
                  echo "<option value='{$distributors["DistributorID"]}'";
                  list_movie($movie_id);
                  while ($movie = mysqli_fetch_assoc($result_movie)){
                    if($movie["DistributorID"] == $distributors["DistributorID"]){
                      echo " selected";}
                  }
                  echo ">".$distributors["Distributor"]."</option>";
                }
                ?>
              </select>
              <a href="add_distributor.php" class="link">Add Distributor</a>
            </div>
            <div class="col-sm-5">
            </div>
          </div>
          <div class="form-group">
            <?php
            list_movie($movie_id);
            $movie = mysqli_fetch_assoc($result_movie);
            ?>
            <label for="release_date" class="col-sm-2 control-label">Image Url</label>
            <div class="col-sm-5">
              <input type="texbox" class="form-control" id="image" name="image" value="<?php echo $movie["Image"]; ?>">
            </div>
            <div class="col-sm-5">
            </div>
          </div>
          <div class="form-group">
            <?php
            list_movie($movie_id);
            $movie = mysqli_fetch_assoc($result_movie);
            ?>
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="submit" value="Submit" class="btn btn-success"/>
              <a type="button" href="movies.php" class="btn btn-default">Back</a>
              <a href="delete_movie.php?id=<?php echo urlencode($movie["MovieID"]); ?>"
                onclick="return confirm('This record will be permanently deleted. Are you sure you want to do this?');" class="btn btn-danger">Delete</a>
            </div>
          </div>
         </form>
      </div>
     </div>
<?php
  mysqli_close($connection);
  include('../includes/footer.php');
?>
