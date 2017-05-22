<?php
// Include session & functions
require_once('../includes/session.php');
require_once('../includes/functions.php');
// Include database & validation
require_once('../includes/database.php');
require_once('../includes/validation.php');
// Check if user is logged in
// Check if user is logged in, if not rediect to login page
if(($logged_in == false) || ($user_type != "admin")){
  redirect_to('login.php');
}

$member_id = $_GET["id"];

get_member($member_id);

$query = "DELETE FROM members WHERE MemberID = {$member_id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
  // Success
  $_SESSION["message"] = "Member deleted.";
  redirect_to("manage_members.php");
} else {
  // Failure
  $_SESSION["error"] = "Member deletion failed.";
  redirect_to("manage_members.php");
}

?>
