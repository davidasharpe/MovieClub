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
  $active_parent_page = "movies";
  $active_page = "add_movie";
  // Set default values
  $_SESSION["message"] = "";
  $_SESSION["error"] = "";
  //Check form submit
  if (isset($_POST['submit_genre'])){
      // Initialise variables
      $form_errors = false;
      $success_message = "";
      $error_message = "";
      // Get post values and remove whitespace
      $genre = trim($_POST["genre"]);
      // Filter input
      $genre = mysqli_real_escape_string($connection, $genre);
      // Validate fields
      validate_text($genre, 'a genre');
      // Check to see if producer exists in database
      $query_genre = "SELECT * FROM genres WHERE genres.Name = '{$genre}'";
      test_query($query_genre);
      if(record_exits($query_genre)){
        $error_message .= "<p class='bg-danger'>This genre already exists in the database.</p><br/>";
        $form_errors = true;
      }
      // if there are no errors add to database
      if($form_errors == false){
        $query = "INSERT INTO genres
                  (Name)
                  VALUES ('{$genre}')";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $success_message = "<p class='bg-success'>New genre successfully added to database";
      }
    } else {
      $genre = "";
      $success_message = "";
      $result = "";
    }
 ?>
 <div class="container">
   <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal">
    <div class="form-group">
      <label for="genre" class="col-sm-2 control-label">Genre</label>
      <div class="col-sm-4">
        <input type="texbox" name="genre" id="genre" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($genre); ?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-4">
        <input id="submit" type="submit" name="submit_genre" value="Submit" class="btn btn-success" />
      </div>
    </div>
  </form>
</div>
