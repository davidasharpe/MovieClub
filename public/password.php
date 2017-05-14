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
  $active_page = "account";

  include('../includes/header.php');
  //Check form submit
  if (isset($_POST['submit'])){
      // Initialise variables
      $form_errors = false;
      $success_message = "";
      $error_message = "";
      // Get post values and remove whitespace
      $old_password = trim($_POST["old_password"]);
      $new_password = trim($_POST["new_password"]);
      $confirm_password = trim($_POST["confirm_password"]);
      // Validate fileds
      validate_text($old_password, 'the current password');
      validate_text($new_password, 'a new password');
      validate_text($confirm_password, 'same password');
      // Check if password fields match
      match_passwords($new_password, $confirm_password);
      // Set member id in session
      $member_id = $_SESSION["member_id"];
      // Check to see if old password matches new password
      $query_member = "SELECT Password FROM members WHERE members.MemberID= '{$member_id}'";
      $query_result = mysqli_query($connection, $query_member);
      test_query($query_result);
      $member = mysqli_fetch_assoc($query_result);
      $stored_password = $member["Password"];
      $verification = password_verify($old_password, $stored_password);
      // Check if passwords match
      if($verification != 1){
        $error_message .= "<p class='text-danger'>Old password does not match.</p><br/>";
        $form_errors = true;
      }
      // if there are no errors update password
      if ($form_errors == false){
        // Encrypt passwords
        $hashed_password = password_encrypt($new_password);
        // Update password
        $query = "UPDATE members
                  SET Password = '{$hashed_password}'
                  WHERE MemberID = '{$member_id}'";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $success_message = "<p class='bg-success'>Password has been successfully updated</p>";
      }
  } else {
    $old_password = "";
    $new_password = "";
    $success_message = "";
    $error_message = "";
    $result = "";
  }
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Change Password</h1>
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
          <label for="password" class="col-sm-2 control-label">Old Password</label>
          <div class="col-sm-5">
            <input type="password" name="old_password" id="old_password" class="form-control" data-validation="required">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">New Password</label>
          <div class="col-sm-5">
            <input type="password" name="new_password" id="new_password" class="form-control" data-validation="required">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm_password" class="col-sm-2 control-label">Re-enter Password</label>
          <div class="col-sm-5">
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" data-validation="required">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit" value="Edit" class="btn btn-success" />
            <a type="button" href="<?php echo 'account.php?id=' . $member_id; ?>" class="btn btn-default">Back</a>
          </div>
        </div>
      </form>
     </div>
   </div>
<?php
  include('../includes/footer.php');
?>
