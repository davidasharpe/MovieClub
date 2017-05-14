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
  if (isset($_POST['submit'])){
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
      // Validate fileds
      validate_text($first_name, 'a first name');
      validate_text($last_name, 'a last name');
      // Check to see if diector exists in database
      $query_director = "SELECT * FROM directors WHERE directors.FirstName = '{$first_name}' AND directors.LastName = '{$last_name}'";
      test_query($query_director);
      if(record_exits($query_director)){
        $error_message .= "<p class='text-danger'>This director already exists in the database.</p><br/>";
        $form_errors = true;
      }
      // if there are no errors add to database
      if ($form_errors == false){
        $query = "INSERT INTO directors
                  (FirstName, LastName)
                  VALUES ('{$first_name}','{$last_name}')";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $success_message = "<p class='bg-success'>New director successfully added to database</p>";
      }
  } else {
    $first_name = "";
    $last_name = "";
    $success_message = "";
    $result = "";
  }
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Add Director</h1>
       <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal">
        <div class="form-group">
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-5">
              <?php if(isset($success_message)) { echo $success_message; } ?>
              <?php if(isset($error_message)) { echo $error_message; } ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="first_name" class="col-sm-2 control-label">First Name</label>
          <div class="col-sm-5">
            <input type="texbox" name="first_name" id="first_name" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($first_name); ?>">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="last_name" class="col-sm-2 control-label">Last Name</label>
          <div class="col-sm-5">
            <input type="texbox" name="last_name" id="last_name" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($last_name); ?>">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
            <a type="button" href="add_movie.php" class="btn btn-default">Back</a>
          </div>
        </div>
      </form>
     </div>
<?php
  include('../includes/footer.php');
  mysqli_close($connection);
?>
