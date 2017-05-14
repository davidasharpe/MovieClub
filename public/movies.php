<?php
  // Include session database & functions
  require_once('../includes/session.php');
  require_once('../includes/database.php');
  require_once('../includes/functions.php');
  // Set active page for navigation
  $active_page = "movies";
  // Render header
  include('../includes/header.php');
  // Set default for movie result
  $result_movies="";
  // Pagination
  if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
  } else {
   $pageno = 1;
  } // if
  // Query movie database
  list_all_movies();
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Movies</h1>
       <table class="table">
         <tr>
          <th>Title</th>
          <th>Release Date</th>
          <th>Running Time</th>
          <th>Genre</th>
          <th>Distributor</th>
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
            <td><?php echo $row["RunningTime"] ?></td>
            <td><?php echo $row["Genre"] ?></td>
            <td><?php echo $row["Distributor"] ?></td>
          <?php
            echo "<td><a href='view_movie.php?id={$id}' class='button'>View</a></td>";
          ?>
          </tr>
         <?php
          }
         ?>
       </table>
     </div>
     <div class="pagination">
      <a href="#">&laquo;</a>
      <a href="#">1</a>
      <a class="active" href="#">2</a>
      <a href="#">3</a>
      <a href="#">&raquo;</a>
    </div>
<?php
  include('../includes/footer.php');
?>
