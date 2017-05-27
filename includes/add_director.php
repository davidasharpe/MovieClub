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
  $first_name = "";
  $last_name = "";
  $_SESSION["message"] = "";
  $_SESSION["error"] = "";
  //Check form submit
  if (isset($_POST['submit_director'])){
      // Initialise variables
      $form_errors = false;
      $success_message = "";
      $error_message = "";
      // Get post values and remove whitespace
      $first_name = trim($_POST["first_name"]);
      $last_name = trim($_POST["last_name"]);
      // Filter input
      $first_name = mysqli_real_escape_string($connection, $first_name);
      $last_name = mysqli_real_escape_string($connection, $last_name);
      // Validate fields
      validate_text($first_name, 'a first name');
      validate_text($last_name, 'a last name');
      // Check to see if diector exists in database
      $query_director = "SELECT * FROM directors WHERE directors.FirstName = '{$first_name}' AND directors.LastName = '{$last_name}'";
      test_query($query_director);
      if(record_exits($query_director)){
        $_SESSION["error"] = "<p class='bg-danger'>This director already exists in the database.</p><br/>";
        $form_errors = true;
      }
      // if there are no errors add to database
      if ($form_errors == false){
        $query = "INSERT INTO directors
                  (FirstName, LastName)
                  VALUES ('{$first_name}','{$last_name}')";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $_SESSION["message"] = "<p class='bg-success'>The director has been successfully added to database.</p>";
        $first_name = "";
        $last_name = "";
      }
  } else {
    $first_name = "";
    $last_name = "";
    $success_message = "";
    $result = "";
  }
 ?>
 <div class="container">
       <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal">
        <div class="form-group">
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="first_name" class="col-sm-2 control-label">First Name</label>
          <div class="col-sm-4">
            <input type="texbox" name="first_name" id="first_name" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($first_name); ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="last_name" class="col-sm-2 control-label">Last Name</label>
          <div class="col-sm-4">
            <input type="texbox" name="last_name" id="last_name" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($last_name); ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-4">
            <input id="submit" type="submit" name="submit_director" value="Submit" class="btn btn-success" />
          </div>
        </div>
      </form>
     </div>
<?php
  mysqli_close($connection);
?>
