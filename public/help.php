<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_parent_page = "";
  $active_page = "help";
  // Render page header
  include('../includes/header.php');
?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Help</h1>
         <div class="row group">
             <div class="column span12">
                 <div class="column-bg">
                   <h2>Members</h2>
                   <h4>Login and Logout</h4>
                   <h4>View Movies</h4>
                   <h4>Add Movies</h4>
                   <h4>Rate Movie</h4>


                 </div>
             </div>
           </div>
       </div>
     </div>
<?php
  include('../includes/footer.php');
?>
