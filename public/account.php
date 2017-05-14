<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
  // Get member id for the logged in user
  $member_id = $_GET["id"];
  // Check if user is logged in, if not rediect to login page
  if($logged_in == false){
    redirect_to('login.php');
  }
  // Check if user is authorised to access account, if not direct to correct member page
  else if($member_id != $_SESSION["member_id"] && $_SESSION['user_type'] != "admin"){
          $member_id = $_SESSION["member_id"];
          redirect_to('account.php?id='.$member_id);
  }
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_page = "account";
  // Render header
  include('../includes/header.php');
  // Set result to default
  $result_member = "";
  // Get member data
  get_member($member_id);
  $member = mysqli_fetch_assoc($result_member);
  $user_name = $member["UserName"];
  $user_type = $member["UserType"];
  $first_name = $member["FirstName"];
  $last_name = $member["LastName"];
  $email = $member["Email"];
  $phone = $member["Phone"];
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
      // Filter input
      $first_name = mysqli_real_escape_string($connection, $first_name);
      $last_name = mysqli_real_escape_string($connection, $last_name);
      $email = mysqli_real_escape_string($connection, $email);
      $phone = mysqli_real_escape_string($connection, $phone);
      // Validate fileds
      validate_text($first_name, 'a first name');
      validate_text($last_name, 'a last name');
      validate_text($email, 'an email');
      validate_text($phone, 'a phone number');
      // Check email format
      email_format($email);
      // if there are no errors update database
      if ($form_errors == false){
        // Upate member details
        $query = "UPDATE members
                  SET FirstName = '{$first_name}', LastName = '{$last_name}', Email = '{$email}', Phone = '{$phone}'
                  WHERE MemberID = '{$member_id}'";
        $result = mysqli_query($connection, $query);
        test_insert_query($result);
        $success_message = "<p class='bg-success'>Member details has been successfully updated</p>";
      }
  } else {
    $first_name = $member["FirstName"];
    $last_name = $member["LastName"];
    $email = $member["Email"];
    $phone = $member["Phone"];
    $success_message = "";
    $result = "";
  }
?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Member Account</h1>
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
            <?php echo "<label style='padding:8px'>" . $user_name . "</label>"; ?>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="user_type" class="col-sm-2 control-label">User Type</label>
          <div class="col-sm-5">
            <?php echo "<label style='padding:8px'>" . $user_type . "</label>"; ?>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit" value="Edit" class="btn btn-success" />
            <a type="button" href="password.php" class="btn btn-default">Change Password</a>
            <?php
              if ($_SESSION["user_type"] == "admin"){
                echo "<a type='button' href='manage_members.php' class='btn btn-default'>Back</a>";
              }
            ?>
          </div>
        </div>
      </form>
     </div>
   </div>
<?php
  include('../includes/footer.php');
?>
