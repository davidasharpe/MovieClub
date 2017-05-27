<?php
  require_once('../includes/database.php');
  require_once('../includes/functions.php');
  include('../includes/header.php');

  // Load data for select drop down lists in form

  $query_director = select_concat('directors', 'FirstName', 'LastName', 'Directors');
  $query_producer = select_concat('producers',  'FirstName', 'LastName','Producers');
  $query_actor = select_concat('actors', 'FirstName', 'LastName', 'Actors');
  $query_genre = select('genres', 'Genre');
  $query_distributor = select('distributors', 'Distributor');

  $result_director = mysqli_query($connection, $query_director);
  $result_producer = mysqli_query($connection, $query_producer);
  $result_actor = mysqli_query($connection, $query_actor);
  $result_genre = mysqli_query($connection, $query_genre);
  $result_distributor = mysqli_query($connection, $query_distributor);

  // Test query results

  if ((!$result_director) || (!$result_producer ) || (!$result_actor ) || (!$result_genre) || (!$result_distributor )){
    die("Database query failed.");
    
  $directors[] = "";
  $productors[] = "";
  $actors[] = "";  

  if(isset($_POST['submit'])){

    // Add new movie

    $title = trim($_POST['title']);
    $release_date = trim(str_replace("/", "-", $_POST['releasedate']));
    $release_date = date('Y-m-d', strtotime($release_date));
    $running_time = trim($_POST['runningtime']);
    $genre = trim($_POST['genre']);
    $distributor = trim($_POST['distributor']);

    $title = mysqli_real_escape_string($connection, $title);
    $release_date = mysqli_real_escape_string($connection, $release_date);
    $running_time = mysqli_real_escape_string($connection, $running_time);
    $genre = mysqli_real_escape_string($connection, $genre);
    $distributor = mysqli_real_escape_string($connection, $distributor);

    if(isset($_POST['directors'])) {$directors = $_POST['directors'];}
    if(isset($_POST['producers'])) {$producers = $_POST['producers'];}
    if(isset($_POST['actors'])) {$actors = $_POST['actors'];}

    $form_errors = false;

    if(isblank($title) || isblank($release_date) || isblank($running_time) || isblank($genre) || isblank($distributor) || isblank($directors) || isblank($producers) || isblank($actors)){$form_errors = true;}

    if($form_errors = false){

    $query = "INSERT INTO movies
              (Title, ReleaseDate, RunningTime, Genre, Distributor)
              VALUES ('{$title}', '{$release_date}', '{$running_time}', '{$genre}', '{$distributor}')";

    $result = mysqli_query($connection, $query);

    test_query($result);

    $movie_id = mysqli_insert_id($connection);

    // Add Director(s) to new movie  --> single director only, need to add loop for multiple directors

    $directors = $_POST['directors'];

    foreach ($directors as $director) {

      $director_id = mysqli_real_escape_string($connection, $director);

      $query = "INSERT INTO director_movie
                (DirectorID, MovieID)
                VALUES ('{$director_id}', '{$movie_id}')";

      $result = mysqli_query($connection, $query);

      test_query($result);
    }

    // Add Producer(s) to new movie  --> single producer only, need to add loop for multiple producers

    $producers = $_POST['producers'];

    foreach($producers as $producer){

      $producer_id = mysqli_real_escape_string($connection, $producer);

      $query = "INSERT INTO producer_movie
                (ProducerID, MovieID)
                VALUES ('{$producer_id}', '{$movie_id}')";

      $result = mysqli_query($connection, $query);

      test_query($result);
    }

    // Add Actor(s) to new movie --> single actor only, need to add loop for multiple actors

    $actors = $_POST['actors'];

    foreach($actors as $actor){

      $actor_id = mysqli_real_escape_string($connection, $actor);

      $query = "INSERT INTO actor_movie
                (ActorID, MovieId)
                VALUES ('{$actor_id}', '{$movie_id}')";

      $result = mysqli_query($connection, $query);

      test_query($result);
    }
 } else{
    $title = "";
    $release_date = "";
    $running_time = "";
    $genre = "";
    $distributor = "";
    }
  }
  }
 ?>

 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Add Movie</h1>
       <div id="demo"></div>
       <form action= "add_movies.php" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-5">
            <input type="texbox" class="form-control" name="title">
          </div>
          <div class=col-sm-5>
          </div>
        </div>
        <div class="form-group">
          <label for="director" class="col-sm-2 control-label">Director</label>
            <div class="col-sm-5">
              <div class="director">
                <div class="field">
                  <!-- this button adds a new select field, so far it is blank, planning on using ajax to load the data dynamically  -->
                  <a class="add_button" title="Add field"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                  <select class="form-control" name=$directors[0]>
                    <option value="">select</option>
                      <?php
                      while ($directors = mysqli_fetch_assoc($result_director)){
                        echo "<option value=' {$directors["DirectorID"]}'>".$directors["Directors"]."</option>";
                      }
                      ?>
                  </select>
                </div>
              </div>
              <a href="add_director.php" class="link">Add Director</a>
            </div>
            <div class="col-sm-5">
            </div>
        </div>
        <div class="form-group">
          <label for="producer" class="col-sm-2 control-label">Producer</label>
          <div class="col-sm-5">
            <div class="producer">
              <div class="field">
                <a class="add_button" title="Add field"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                <select class="form-control" name=producers[0]>
                  <option value="">select</option>
                  <?php
                    while ($producers = mysqli_fetch_assoc($result_producer)){
                      echo "<option value='{$producers["ProducerID"]}'>".$producers["Producers"]."</option>";
                    }
                    ?>
                </select>
              </div>
            </div>
            <a href="add_producer.php" class="link">Add Producer</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="releasedate" class="col-sm-2 control-label">Release Date</label>
          <div class="col-sm-5">
            <input type="date" class="form-control" name="releasedate">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="runningtime" class="col-sm-2 control-label">Running Time</label>
          <div class="col-sm-5">
            <input type="texbox" class="form-control" name="runningtime">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="genre" class="col-sm-2 control-label">Genre</label>
          <div class="col-sm-5">
            <select class="form-control" name="genre">
              <option value="">select</option>
                <?php
                while ($genres = mysqli_fetch_assoc($result_genre)){
                  echo "<option value='{$genres["GenreID"]}'>".$genres["Genre"]."</option>";
                }
                ?>
            </select>
            <a href="add_genre.php" class="link">Add Genre</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="actor" class="col-sm-2 control-label">Actor</label>
          <div class="col-sm-5">
            <div class="actor">
              <div class="field">
                <a class="add_button" title="Add field"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                <select class="form-control" name=actors[0]>
                  <option value="">select</option>
                  <?php
                  while ($actors = mysqli_fetch_assoc($result_actor)){
                    echo "<option value='{$actors["ActorID"]}'>".$actors["Actors"]."</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <a href="add_actor.php" class="link">Add Actor</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="distributor" class="col-sm-2 control-label">Distributor</label>
          <div class="col-sm-5">
            <select class="form-control" name="distributor">
              <option value="">select</option>
              <?php
              while ($distributors = mysqli_fetch_assoc($result_distributor)){
                echo "<option value='{$distributors["DistributorID"]}'>".$distributors["Distributor"]."</option>";
              }
              ?>
            </select>
            <a href="add_distributor.php" class="link">Add Distributor</a>
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
  mysqli_data_seek($result_producer, 1);
  mysqli_data_seek($result_director, 1);
  mysqli_data_seek($result_actor, 1);
  mysqli_close($connection);
?>
