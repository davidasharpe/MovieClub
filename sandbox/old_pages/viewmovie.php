<?php
  require_once('../includes/header.php');
  require_once('../includes/moviedata.php');
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
         <?php

             $i = $_GET['id'];

             foreach ($movies[$i] as $key => $value) {
              echo "{$key} : {$value} <br/>";
             }
         ?>

         <br/>

         <a href='movies.php' class="button">Back</a>

     </div>
<?php
  require_once('../includes/footer.php');
?>
