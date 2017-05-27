<?php
  require_once('../includes/database.php');
  include('../includes/header.php');

  $query_director = "SELECT CONCAT_WS(' ', FirstName, LastName) AS Directors
                     FROM directors
                     ORDER BY Directors ASC";

  $query_producer = "SELECT CONCAT_WS(' ', FirstName, LastName) AS Producers
                     FROM producers
                     ORDER BY Producers ASC";

  $query_actor = "SELECT CONCAT_WS(' ', FirstName, LastName) AS Actors
                  FROM actors
                  ORDER BY Actors ASC";

  $query_genre = "SELECT Genre
                  FROM genres
                  ORDER BY Genre ASC";

  $query_distributor = "SELECT Distributor
                        FROM distributors
                        ORDER BY Distributor ASC";

  $result_director = mysqli_query($connection, $query_director);
  $result_producer = mysqli_query($connection, $query_producer);
  $result_actor = mysqli_query($connection, $query_actor);
  $result_genre = mysqli_query($connection, $query_genre);
  $result_distributor = mysqli_query($connection, $query_distributor);

  // Test query results
  if ((!$result_director) || (!$result_producer ) || (!$result_actor ) || (!$result_genre) || (!$result_distributor )){
    die("Database query failed.");
  }
 ?>

 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Add Movie</h1>
       <div id="demo"></div>
       <form class="form-horizontal">
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-5">
            <input type="texbox" class="form-control" id="title">
          </div>
          <div class=col-sm-5>
          </div>
        </div>
        <div class="form-group">
          <label for="director" class="col-sm-2 control-label">Director</label>
          <div clsss="field_wrapper">
            <div class="col-sm-5">
              <select class="form-control">
                <option value="select">select</option>
                  <?php
                  while ($directors = mysqli_fetch_assoc($result_director)){
                    echo "<option value='{$directors["DirectorID"]}'>".$directors["Directors"]."</option>";
                  }
                  ?>
              </select>
              <a href="add_director.php">Add Director</a>
            </div>
            <div class="col-sm-5">
              <a href="javascript:void(0);" class="add_button"><span class="glyphicon glyphicon-plus-sign form-icon plus" aria-hidden="true"></span></a>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="producer" class="col-sm-2 control-label">Producer</label>
          <div class="col-sm-5">
            <select class="form-control">
              <option value="select"></option>
              <?php
                while ($producers = mysqli_fetch_assoc($result_producer)){
                  echo "<option value='{$producers["ProducerID"]}'>".$producers["Producers"]."</option>";
                }
                ?>
            </select>
            <a href="#">Add Producer</a>
          </div>
          <div class="col-sm-5">
            <a><span id="addButton" class="glyphicon glyphicon-plus-sign form-icon plus" aria-hidden="true"></span></a>
            <a><span id="removeButton" class="glyphicon glyphicon-minus-sign form-icon minus" aria-hidden="true"></span></a>
          </div>
        </div>
        <div class="form-group">
          <label for="releasedate" class="col-sm-2 control-label">Release Date</label>
          <div class="col-sm-5">
            <input type="date" class="form-control" id="releasedate">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="runningtime" class="col-sm-2 control-label">Running Time</label>
          <div class="col-sm-5">
            <input type="texbox" class="form-control" id="runningtime">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="genre" class="col-sm-2 control-label">Genre</label>
          <div class="col-sm-5">
            <select class="form-control" id="genre">
              <option value="select">select</option>
                <?php
                while ($genres = mysqli_fetch_assoc($result_genre)){
                  echo "<option value='{$genres["GenreID"]}'>".$genres["Genre"]."</option>";
                }
                ?>
            </select>
            <a href="#">Add Genre</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="actor" class="col-sm-2 control-label">Actor</label>
          <div class="col-sm-5">
            <select class="form-control" id="actor">
              <option value="select">select</option>
                <?php
                while ($actors = mysqli_fetch_assoc($result_actor)){
                  echo "<option value='{$actors["ActorID"]}'>".$actors["Actors"]."</option>";
                }
                ?>
            </select>
            <a href="#">Add Actor</a>
          </div>
          <div class="col-sm-5">
            <a><span class="glyphicon glyphicon-plus-sign form-icon plus" aria-hidden="true"></span></a>
            <a><span class="glyphicon glyphicon-minus-sign form-icon minus" aria-hidden="true"></span></a>
          </div>
        </div>
        <div class="form-group">
          <label for="distributor" class="col-sm-2 control-label">Distributor</label>
          <div class="col-sm-5">
            <select class="form-control" id="distributor">
              <option value="select">select</option>
              <?php
              while ($distributors = mysqli_fetch_assoc($result_distributor)){
                echo "<option value='{$distributors["DistributorID"]}'>".$distributors["Distributor"]."</option>";
              }
              ?>
            </select>
            <a href="#">Add Distributor</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
     </div>
<?php
  include('../includes/footer.php');
  mysqli_close($connection);
?>

<div class="field_wrapper">
  <a href="javascript:void(0);" class="remove_button"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
  <select class="form-control">
    <option value="select">select</option>
    <?php
    mysqli_data_seek($result_director, 0);
    while ($directors = mysqli_fetch_assoc($result_director)){
      echo "<option value='{$directors["DirectorID"]}'>".$directors["Directors"]."</option>";
    }
    ?>;
  </select>
</div>
