<?php
  if(isset($_POST['submit'])){
    // Initialise variables
    $form_errors = false;
    $success_message = "";
    $error_message = "";
    // Get post values and remove whitespace
    $rating = trim($_POST["rating"]);
    $review = trim($_POST["review"]);
    $member_id =  $_SESSION["member_id"];
    $movie_id = $_GET['id'];
    // Filter input
    $rating = mysqli_real_escape_string($connection, $rating);
    $review = mysqli_real_escape_string($connection, $review);
    // Validate fileds
    validate_select_field($rating);
    validate_text($review, 'a review');
    // if there are no errors add to database
    if ($form_errors == false){
        $insert_rating = "INSERT INTO movie_rating
                         (MovieID, MemberID, Rating, Review)
                         VALUES ('{$movie_id }', '{$member_id}','$rating','$review')";
        $result = mysqli_query($connection, $insert_rating);
       test_insert_query($result);
       $success_message = "<p class='bg-success'>New rating successfully added to database</p>";
    }
    else {
      $success_message = "";
      $result = "";
    }
  }
?>
<div class="row col-sm-12">
  <div class="well well-sm">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal">
      <div class="form-group">
        <div class="form-group">
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-5">
              <?php if(isset($success_message)) { echo $success_message; } ?>
              <?php if(isset($error_message)) { echo $error_message; } ?>
            </div>
          </div>
        </div>
        <label for=rating class="control-label col-sm-2">Rate Movie</label>
          <div class="col-sm-10" id="rating">
            <label class="radio-inline">1 Star</label><input type="radio" name="rating" value="1" class="">
            <label class="radio-inline">2 Stars</label><input type="radio" name="rating" value="2" class="">
            <label class="radio-inline">3 Stars</label><input type="radio" name="rating" value="3" class="">
            <label class="radio-inline">4 Stars</label><input type="radio" name="rating" value="4" class="">
            <label class="radio-inline">5 Stars</label><input type="radio" name="rating" value="5" class="">
            </div>
          </div>
    <div class="form-group">
        <label for=rating class="control-label col-sm-2">Review</label>
        <div class="col-sm-9">
          <textarea name="review"></textarea>
        </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" name="submit" value="Submit" class="btn btn-success"/>
      </div>
    </div>
    </form>
  </div>
  </div>
