<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
  // Check if user is logged in, if so direct to home page
  if($logged_in == true){
    redirect_to('index.php');
  }
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_page = "login";
  // Render page header
  include('../includes/header.php');
  //Check form submit
  if (isset($_POST['submit'])){
      // Initialise variables
      $form_errors = false;
      $success_message = "";
      $error_message = "";
      // Get post values and remove whitespace
      $user_name = trim($_POST["user_name"]);
      $password = trim($_POST["password"]);
      // Filter input
      $user_name = mysqli_real_escape_string($connection, $user_name);
      $password = mysqli_real_escape_string($connection, $password);
      // Validate fileds
      validate_text($user_name, 'a user name');
      validate_text($password, 'a password');
      // Query member in database
      $query = "SELECT * FROM members WHERE members.UserName = '{$user_name}'";
      // If user name exists process form
      if(record_exits($query)){
        // Load query result
        $query_result = mysqli_query($connection, $query);
        $member = mysqli_fetch_assoc($query_result);
        $registered_user = $member["UserName"];
        $stored_password = $member["Password"];
        $user_type = $member["UserType"];
        $member_id = $member["MemberID"];
        // Verify password
        $verification = password_verify($password, $stored_password);
        // Check that user name & password is verified
          if($verification == 1){
            // Set session values
            $_SESSION["logged_in"] = true;
            $_SESSION["user_name"] = $user_name;
            $_SESSION["user_type"] = $user_type;
            $_SESSION["member_id"] = $member_id;
            // Redirect user
            redirect_to("index.php");
          } else {
            // Print error message
            $error_message = "<p class='text-danger'>The user name and/or password is incorrect</p><br/>";
            $error_message .= "<p class='text-danger'>Please try again</p><br/>";
          }
        }
  } else {
    $user_name = "";
    $password = "";
    $success_message = "";
    $result = "";
  }
?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Login</h1>
       <div class="row">
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
               <label for="user_name" class="col-sm-2 control-label">User Name</label>
               <div class="col-sm-5">
                 <input type="texbox" name="user_name" id="user_name" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($user_name); ?>">
               </div>
               <div class="col-sm-5">
               </div>
             </div>
             <div class="form-group">
               <label for="password" class="col-sm-2 control-label">Password</label>
               <div class="col-sm-5">
                 <input type="password" name="password" id="password" class="form-control" data-validation="required">
               </div>
               <div class="col-sm-5">
               </div>
             </div>
             <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                 <input type="submit" name="submit" value="Submit" class="btn btn-success" />
               </div>
             </div>
          </form>
       </div>
     </div>
   </div>
 </div>
<?php
  include('../includes/footer.php');
?>
