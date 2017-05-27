<?php
  require_once('../includes/database.php');
  require_once('../includes/functions.php');
  include('../includes/header.php');

  if (isset($_POST['submit'])){

      $title = $_POST["title"];
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

      $query = "INSERT INTO movies
                (Title, ReleaseDate, RunningTime, Genre, Distributor)
                VALUES ('{$title}', '{$release_date}', '{$running_time}', '{$genre}', '{$distributor}')";

      $result = mysqli_query($connection, $query);

      test_query($result);

      $result_message = $message;

    } else {
      $title = "";
      $release_date = "";
      $running_time = "";
      $genre = "";
      $distributor = "";
      $result_message = "";

    }
 ?>

 <div class="container">
   <div class="main">
     <div class="starter-template">
       <pre>
         <?php echo htmlspecialchars($title)."<br/>";
               echo htmlspecialchars($release_date)."<br/>";
               echo htmlspecialchars($running_time)."<br/>";
               echo htmlspecialchars($genre)."<br/>";
               echo htmlspecialchars($distributor)."<br/>";
          ?>
       </pre>

       <h1>Add Movie</h1>
       <form action="add_movie_2.php" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-5">
            <input type="texbox" name="title" class="form-control" value= "<?php echo htmlspecialchars($title); ?>">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="releasedate" class="col-sm-2 control-label">Release Date</label>
          <div class="col-sm-5">
            <input type="textbox" class="form-control" name="releasedate">
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
                <?php get_genres(); ?>
            </select>
            <br/>
            <a href="add_genre.php" class="link">Add Genre</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="distributor" class="col-sm-2 control-label">Distributor</label>
          <div class="col-sm-5">
            <select class="form-control" name="distributor">
              <option value="">select</option>
              <?php get_distributors(); ?>
            </select>
            <br/>
            <a href="add_distributor.php" class="link">Add Distributor</a>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
          </div>
        </div>
      </form>
      <span id="message"><?php echo $result_message; ?></span>
      <span id="close"></span>
     </div>
<?php
  include('../includes/footer.php');
  mysqli_close($connection);
?>
