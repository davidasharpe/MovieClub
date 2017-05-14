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
      $distributor = trim($_POST["distributor"]);
      // Filter input
      $distributor = mysqli_real_escape_string($connection, $distributor);
      // Validate fileds
      validate_text($distributor, 'a distributor');
      // Check to see if producer exists in database
      $query_distributor = "SELECT * FROM distributors WHERE distributors.Distributor = '{$distributor}'";
      test_query($query_distributor);
      if(record_exits($query_distributor)){
        $error_message .= "<p class='bg-danger'>This distributor already exists in the database.</p><br/>";
        $form_errors = true;
      }
      // if there are no errors add to database
      if($form_errors == false){
        $query = "INSERT INTO distributors
                  (Distributor)
                  VALUES ('{$distributor}')";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $success_message = "<p class='bg-success'>New distributor successfully added to database</p>";
      }
    } else {
      $distributor = "";
      $success_message = "";
      $result = "";
    }
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Add Distributor</h1>
       <form action="add_distributor.php" method="post" class="form-horizontal">
        <div class="form-group">
         <div class="col-sm-2">
          </div>
          <div class="col-sm-5">
            <?php if(isset($success_message)) { echo $success_message; } ?>
            <?php if(isset($error_message)) { echo $error_message; } ?>
          </div>
         </div>
        <div class="form-group">
          <label for="distributor" class="col-sm-2 control-label">Distributor</label>
          <div class="col-sm-5">
            <input type="texbox" name="distributor" id="distributor" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($distributor); ?>">
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
