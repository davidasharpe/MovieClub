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

  require_once '../includes/paginator.class.php';

  $limit        = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 1;
  $page         = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 10;
  $links        = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 1;
  $query        = "SELECT MovieID, Title, Genre, ReleaseDate
                   FROM movies
                   INNER JOIN genres ON movies.GenreID = genres.GenreID
                   ORDER BY Title ASC";

  $paginator  = new Paginator( $connection, $query );

  $results    = $paginator->getData( $page, $limit );
  test_query($results);
  // Set default for movie result
  $result_movies="";

 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <div>
       <h1>Movies</h1>
       <div class="column-bg">
         <table class="table">
           <thead>
             <tr>
              <th width="40%">Title</th>
              <th width="20%">Genre</th>
              <th width="20%">Release Date</th>
              <th width="20%"></th>
            </tr>
          </thead>
          <tbody>
            <?php for( $i = 0; $i < count( $results->data ); $i++ ) :
              $movie_id = $results->data[$i]["MovieID"]; ?>
            <tr>
                <td><?php echo $results->data[$i]['Title']; ?></td>
                <td><?php echo $results->data[$i]['Genre']; ?></td>
                <td><?php echo $results->data[$i]['ReleaseDate']; ?></td>
                <td><?php echo "<td><a href='view_movie.php?id={$movie_id}' class='button'>View</a></td>";?></td>
            </tr>
           <?php endfor; ?>
          </tbody>
         </table>
         <?php echo $paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
       </div>
     </div>
<?php
  include('../includes/footer.php');
?>
