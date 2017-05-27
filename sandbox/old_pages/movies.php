<?php
  require_once('../includes/header.php');
  require_once('../includes/moviedata.php');
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>hello ovies</h1>
       <table class="table">
         <tr>
          <th>Title</th>
          <th>Director</th>
          <th>Producer</th>
          <th>Release Date</th>
          <th>Running Time</th>
          <th>Genre</th>
          <th>Staring</th>
          <th></th>
        </tr>
         <?php
          $length = count($movies);
          // generate row
          for ($i = 0; $i <= $length - 1; $i++) {
           echo "<tr>";
             // generate column
             foreach ($movies[$i] as $key => $value) {
              echo "<td>{$value}</td>";
           }
           echo "<td><a href='viewmovie.php?id={$i}' class='button'>View</a></td>";
           echo "</tr>";
          }
         ?>
       </table>
     </div>

     <script>

      var hello = '<?php echo "Hello" ?>'

      $('.main').append(hello);

     </script>

<?php
  require_once('../includes/footer.php');
?>
