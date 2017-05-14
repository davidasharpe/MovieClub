<?php
// Validate text
function validate_text($title, $name){
  global $form_errors;
  global $error_message;
  if(!isset($title) || $title === ""){
    $error_message .= "<p class='bg-danger'>Please enter {$name}.</p>";
    $form_errors = true;
  }
}
// Validate release date
function validate_date($release_date){
  global $error_message;
  global $form_errors;
  if(!isset($release_date) || $release_date === ""){
    $error_message .= "<p class='bg-danger'>Please enter a release date</p>";
    $form_errors = true;
  }
  if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $release_date)) {
    $error_message .= "<p class='bg-danger'>Release date is not in the correct format (yyyy-mm-dd).</p>";
    $form_errors = true;
  }
}
// Validate running time
function validate_time($running_time){
  global $error_message;
  global $form_errors;
  if(!isset($running_time) || $running_time === "" || $running_time == 0){
    $error_message .= "<p class='bg-danger'>Please enter a running time.</p>";
    $form_errors = true;
  }
  if (isset($running_time) && !filter_var($running_time, FILTER_VALIDATE_INT)) {
    $error_message .= "<p class='bg-danger'>Running time is not a valid number.</p>";
    $form_errors = true;
  }
  if (isset($running_time) && $running_time < 0 || $running_time > 999) {
    $error_message .= "<p class='bg-danger'>Running time must be between 1 and 999.</p>";
    $form_errors = true;
  }
}
// Validate select fields
function validate_select_field($field){
  global $error_message;
  global $form_errors;
  if(!isset($field)){
    $error_message .= "<p class='bg-danger'>Please select a {$field}.</p>";
    $form_errors = true;
  }
}
// Check if record exists in database
function record_exits($query){
  global $connection;
  $record_exists_query = $query;
  // Perform database query
  $query_result = mysqli_query($connection, $record_exists_query);
  // Test if there was a query error
  confirm_query($query_result);
  // Check if record already exists
  if (mysqli_num_rows($query_result) > 0) {
      return true;

      debug_to_console($query_result);
  }
  // Release returned data
  mysqli_free_result($query_result);

  }
  // Test if there was a query error
  function confirm_query($results_set) {
      global $connection;
      if (!$results_set) {
          die("Database query failed. " . mysqli_error($connection));
      }
  }
  // Debug to console
  function debug_to_console($data) {
      if(is_array($data) || is_object($data))
  	{
  		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
  	} else {
  		echo("<script>console.log('PHP: ".$data."');</script>");
  	}
  }
  // Check email format
  function email_format($email){
    global $form_errors;
    global $error_message;
    if(!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $email)){
      $error_message .= "<p class='bg-danger'>Email must be a vaild email address.</p>";
      $form_errors = true;
    }
  }
  // Check password format
  function password_format($password){
    global $form_errors;
    global $error_message;
    if(!preg_match("/^(?=.*\d).{6,15}$/", $password)){
      $error_message .= "<p class='bg-danger'>Password must be between 4 and 15 characters long and include at least one number.</p>";
      $form_errors = true;
    }
  }
  // Check for matching passwords
  function match_passwords($hashed_password, $confirm_password){
    global $error_message;
    global $form_errors;
    if($hashed_password != $confirm_password){
      $error_message .= "<p class='bg-danger'>Passwords do not match.</p>";
      $form_errors = true;
    }
  }
?>
