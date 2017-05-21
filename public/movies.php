<?php
  // Include session database & functions
  require_once('../includes/session.php');
  require_once('../includes/database.php');
  require_once('../includes/functions.php');
  // Set active page for navigation
  $active_parent_page = "movies";
  $active_page = "view_movies";
  // Render header
  include('../includes/header.php');
   // Set default for movie result
  $result_movies="";
   // Query movie database
  list_all_movies();
?>
  <div class="container">
    <div class="main">
   <div class="starter-template">
      <h1>Movies</h1>
      <div class="column-bg">
      <table class="table">
        <tr>
         <th>Title</th>
         <th>Release Date</th>
         <th>Genre</th>
         <th></th>
         <th></th>
        </tr>
     <?php
          // Use returned data (if any)
          while($row = mysqli_fetch_assoc($result_movies)){
          $id = $row["MovieID"];
     ?>
        <tr>
           <td><?php echo $row["Title"] ?></td>
           <td><?php echo $row["ReleaseDate"] ?></td>
           <td><?php echo $row["Genre"] ?></td>
           <td>
         <?php
           echo "<a href='view_movie.php?id={$id}' class='button'>View</a>";
         ?>
          </td>
          <td>
         <?php
           if(($logged_in == true) && ($user_type == "admin")){
             echo "<a href='edit_movie.php?id={$id}' class='button'>Edit</a>";
           }
         ?>
          </td>
        </tr>
     <?php
       }
      ?>
        </table>
      </div>
    </div>
<?php
   include('../includes/footer.php');
?>
