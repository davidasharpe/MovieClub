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
  if (isset($_POST['submit_distributor'])){
      // Initialise variables
      $form_errors = false;
      $success_message = "";
      $error_message = "";
      // Get post values and remove whitespace
      $distributor = trim($_POST["distributor"]);
      // Filter input
      $distributor = mysqli_real_escape_string($connection, $distributor);
      // Validate fields
      validate_text($distributor, 'a distributor');
      // Check to see if producer exists in database
      $query_distributor = "SELECT * FROM distributors WHERE distributors.Name = '{$distributor}'";
      test_query($query_distributor);
      if(record_exits($query_distributor)){
        $_SESSION["error"] = "<p class='bg-danger'>This distributor already exists in the database.</p><br/>";
        $form_errors = true;
      }
      // if there are no errors add to database
      if($form_errors == false){
        $query = "INSERT INTO distributors
                  (Name)
                  VALUES ('{$distributor}')";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $_SESSION["message"] = "<p class='bg-success'>New distributor successfully added to database</p>";
        $first_name = "";
        $last_name = "";
      }
    } else {
      $distributor = "";
      $success_message = "";
      $result = "";
    }
 ?>
 <div class="container">
   <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal">
    <div class="form-group">
      <label for="distributor" class="col-sm-2 control-label">Distributor</label>
      <div class="col-sm-4">
        <input type="texbox" name="distributor" id="distributor" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($distributor); ?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-4">
        <input id="submit" type="submit" name="submit_distributor" value="Submit" class="btn btn-success" />
      </div>
    </div>
  </form>
</div>
