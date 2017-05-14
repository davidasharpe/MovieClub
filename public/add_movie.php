<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
    // Check if user is logged in, if not rediect to login page
  if($logged_in == false){
    redirect_to('login.php');
  }
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_page = "add_movie";
  // Render header
  include('../includes/header.php');
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
    // Check if movie exists in database
    $query_movie = "SELECT * FROM movies WHERE movies.Title = '{$title}' AND movies.ReleaseDate = '{$release_date}'";
    test_query($query_movie);
    if(record_exits($query_movie)){
      $error_message .= "<p class='bg-danger'>This movie already exists in the database.</p><br/>";
      $form_errors = true;
    }
    // if there are no errors add to database
    if($form_errors == false){
      $insert_movie = "INSERT INTO movies
                      (Title, ReleaseDate, RunningTime, GenreID, DistributorID)
                      VALUES ('{$title}', '{$release_date}', '{$running_time}', '{$genre}', '{$distributor}')";
      if(mysqli_query($connection, $insert_movie)){
        // Get last movie id
        $movie_id = mysqli_insert_id($connection);
        // Add Director(s) to new movie
        foreach ($directors as $director) {
          $insert_director = "INSERT INTO director_movie
                             (DirectorID, MovieID)
                             VALUES ('{$director}', '{$movie_id}')";
          mysqli_query($connection, $insert_director);
        }
        // Add Producer(s) to new movie
        foreach($producers as $producer){
          $insert_producer = "INSERT INTO producer_movie
                             (ProducerID, MovieID)
                             VALUES ('{$producer}', '{$movie_id}')";
          mysqli_query($connection, $insert_producer);
        }
        // Add Actor(s) to new movie
        foreach($actors as $actor){
          $insert_actor = "INSERT INTO actor_movie
                    (ActorID, MovieID)
                    VALUES ('$actor', '{$movie_id}')";
          mysqli_query($connection, $insert_actor);
        }
        // Success message
        $success_message = "<p class='bg-success'>The movie has beend successfully added to database.</p>";
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
       <h1>Add Movie</h1>
       <form name="add_movie" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
          <div class="col-sm-2">
          </div>
          <div class="col-sm-5">
            <?php if(isset($success_message)) { echo $success_message; } ?>
            <?php if(isset($error_message)) { echo $error_message; } ?>
          </div>
        </div>
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-5">
            <input type="texbox" class="form-control" id="title" name="title" placeholder="title of movie" value="<?php if(isset($title)) { echo htmlspecialchars($title); } ?>" data-validation="required">
          </div>
          <div class=col-sm-5>
          </div>
        </div>
        <div class="form-group">
          <label for="director" class="col-sm-2 control-label">Director</label>
            <div class="col-sm-5">
              <div class="director">
                <select multiple class="form-control" id="directors" name="directors[]" data-validation="required">
                    <?php get_directors(); ?>
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
                <select multiple class="form-control" id="producers" name="producers[]" data-validation="required">
                  <?php get_producers(); ?>
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
            <input type="date" class="form-control" id="release_date" name="release_date" data-validation="required date" data-validation-format="yyyy-mm-dd">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="running_time" class="col-sm-2 control-label">Running Time</label>
          <div class="col-sm-5">
            <input type="texbox" class="form-control" id="running_time" name="running_time" data-validation="required number" data-validation-allowing="range[1;999]" placeholder="minutes" value="<?php if(isset($running_time)){ echo htmlspecialchars($running_time); } ?>" >
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="genre" class="col-sm-2 control-label">Genre</label>
          <div class="col-sm-5">
            <select class="form-control" id="genre" name="genre" data-validation="required">
              <option value="">select</option>
                <?php get_genres(); ?>
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
              <select multiple class="form-control" id="actors" name="actors[]" data-validation="required">
                <?php get_actors(); ?>
              </select>
              <h6>To Select multiple items, PC: Ctrl + click, Mac: Cmd + click</h6>
            </div>
            <a href="add_actor.php" class="link">Add Actor</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="distributor" class="col-sm-2 control-label">Distributor</label>
          <div class="col-sm-5">
            <select class="form-control" id="distributor" name="distributor" data-validation="required">
              <option value="">select</option>
              <?php get_distributors(); ?>
            </select>
            <a href="add_distributor.php" class="link">Add Distributor</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit" value="Submit" class="btn btn-success"/>
            <input type="reset" name="reset" value="Reset" class="btn btn-default" />
          </div>
        </div>
      </form>
     </div>
<?php
  mysqli_close($connection);
  include('../includes/footer.php');
?>
