<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
  // Check if user is logged in as admin, if not rediect to login page
  if(($logged_in == false) || ($user_type != "admin")){
    redirect_to('login.php');
  }
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_page = "admin";
  // Render header
  include('../includes/header.php');
  //Check form submit
  if (isset($_POST['submit'])){
      // Initialise variables
      $form_errors = false;
      $success_message = "";
      $error_message = "";
      // Get post values and remove whitespace
      $user_type = $_POST["user_type"];
      $first_name = trim($_POST["first_name"]);
      $last_name = trim($_POST["last_name"]);
      $email = trim($_POST["email"]);
      $phone = trim($_POST["phone"]);
      $user_name = trim($_POST["user_name"]);
      $password = trim($_POST["password"]);
      $confirm_password = trim($_POST["confirm_password"]);
      // Filter input
      $first_name = mysqli_real_escape_string($connection, $first_name);
      $last_name = mysqli_real_escape_string($connection, $last_name);
      $email = mysqli_real_escape_string($connection, $email);
      $phone = mysqli_real_escape_string($connection, $phone);
      $user_name = mysqli_real_escape_string($connection, $user_name);
      // Validate fileds
      validate_text($first_name, 'a first name');
      validate_text($last_name, 'a last name');
      validate_text($email, 'an email');
      validate_text($phone, 'a phone number');
      validate_text($user_name, 'a user name');
      validate_text($password, 'a password');
      validate_text($confirm_password, 'same password');
      // Check email format
      email_format($email);
      // Check password format
      password_format($password);
      // Check if password fields match
      match_passwords($password, $confirm_password);
      // Encrypt passwords
      $hashed_password = password_encrypt($password);
      // Check to see if member exists in database
      $query_member = "SELECT * FROM members WHERE members.UserName = '{$user_name}'";
      test_query($query_member);
      if(record_exits($query_member)){
        $error_message .= "<p class='text-danger'>This user name already exists in the database.</p><br/>";
        $form_errors = true;
      }
      // if there are no errors add to database
      if ($form_errors == false){
        $query = "INSERT INTO members
                  (UserType, FirstName, LastName, Email, Phone, UserName, Password)
                  VALUES ('{$user_type}', '{$first_name}', '{$last_name}', '{$email}', '{$phone}', '{$user_name}','{$hashed_password}')";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $success_message = "<p class='bg-success'>New user successfully added to database</p>";
      }
  } else {
    $first_name = "";
    $last_name = "";
    $email = "";
    $phone = "";
    $user_name = "";
    $password = "";
    $success_message = "";
    $result = "";
  }
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Add Member</h1>
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
          <label for="user_type" class="col-sm-2 control-label">User Type</label>
          <div class="col-sm-5">
            <select name="user_type" id="user_type" class="form-control" data-validation="required">
              <option value="">Select</option>
              <option value="member">Member</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="col-sm-5">
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
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-5">
            <input type="email" name="email" id="email" class="form-control" data-validation="required" value="<?php echo htmlspecialchars($email); ?>">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">Phone Number</label>
          <div class="col-sm-5">
            <input type="texbox" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>">
          </div>
          <div class="col-sm-5">
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
            <h6>Password must be between 6 and 15 characters long and contain at least one number.</h6>
            <input type="password" name="password" id="password" class="form-control" data-validation="required">
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
            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
            <a type="button" href="manage_members.php" class="btn btn-default">Back</a>
          </div>
        </div>
      </form>
     </div>
<?php
  include('../includes/footer.php');
  mysqli_close($connection);
?>
