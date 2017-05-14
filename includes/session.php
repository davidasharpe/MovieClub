<?php
  // Start Session
  session_start();
  // Check if user is logged in
  $logged_in = isset($_SESSION["logged_in"]) ? $_SESSION["logged_in"] : "";
  $member_id = isset($_SESSION["member_id"]) ? $_SESSION["member_id"] : "";
  $user_name = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "";
  $user_type = isset($_SESSION["user_type"]) ? $_SESSION["user_type"] : "";
?>
