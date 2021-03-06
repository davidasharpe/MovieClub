<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
  // Check if user is logged in as admin, if not rediect to login page
  if(($logged_in == false) || ($user_type != "admin")){
    redirect_to('login.php');
  }
  // Include database
  require_once('../includes/database.php');
  // Set active page for navigation
  $active_parent_page = "admin";
  $active_page = "manage_members";
  // Render header
  include('../includes/header.php');
  // Pagination
  if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
  } else {
   $pageno = 1;
  }
  // List all members
  list_all_members();
?>
<div class="container">
  <div class="main">
    <div class="starter-template">
      <h1>Members</h1>
      <div class="column-bg">
      <?php if(isset($_SESSION["message"])){echo "<h6 class='bg-success'>".$_SESSION["message"]."</h6>"; $_SESSION["message"] = "";} ?>
      <?php if(isset($_SESSION["error"])){echo "<h6 class='bg-danger'>".$_SESSION["error"]."</h6>"; $_SESSION["error"] = "";} ?>
      <table class="table">
        <tr>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Phone No.</th>
         <th>Email</th>
         <th>User Name</th>
         <th>User Type</th>
         <th></th>
       </tr>
        <?php
         // Use returned data (if any)
         while($row = mysqli_fetch_assoc($result_members)){
           $id = $row["MemberID"];
        ?>
         <tr>
           <td><?php echo $row["FirstName"] ?></td>
           <td><?php echo $row["LastName"] ?></td>
           <td><?php echo $row["Phone"] ?></td>
           <td><?php echo $row["Email"] ?></td>
           <td><?php echo $row["UserName"] ?></td>
           <td><?php echo $row["UserType"] ?></td>
         <?php
           echo "<td><a href='account.php?id={$id}' class='button'>Edit</a></td>";
         ?>
         </tr>
        <?php
         }
        ?>
      </table>
      <a href="add_member.php" class="link">Add Member</a>
    </div>
  </div>
<?php
  include('../includes/footer.php');
?>
