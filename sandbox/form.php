<?php
  require_once('../includes/database.php');
  require_once('../includes/functions.php');

  if (isset($_POST['submit'])){

      $select = $_POST["select"];
      $date = $_POST["date"];
      $directors = $_POST["directors"];

      $result = $select."<br/>"
      .$date."</br"
      .$directors;

    } else {

      $result = "";

    }

 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

 <html lang="en">
 	<head>
 		<title>untitled</title>
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/jquery-ui/jquery-ui.min.css" rel="stylesheet">
 	</head>
 	<body>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <div>
         <pre>
           <?php echo $result; ?>
         </pre>
       </br>
       </div>
       <h1>Form</h1>
       <form action="form.php" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="select" class="col-sm-2 control-label">Select</label>
          <div class="col-sm-5">
            <select name="select">
              <option value="">select</option>
              <option value="1">option 1</option>
              <option value="2">option 2</option>
              <option value="3">option 3</option>
            </select>
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="date" class="col-sm-2 control-label">Date</label>
          <div class="col-sm-5">
            <input type="date" class="form-control" name="date">
          </div>
          <div class="col-sm-5">
          </div>
        </div>
        <div class="form-group">
          <label for="director" class="col-sm-2 control-label">Director</label>
            <div class="col-sm-5">
              <div class="director">
                <div class="field">
                  <!-- this button adds a new select field, so far it is blank, planning on using ajax to load the data dynamically  -->
                  <select multiple class="form-control" name="directors">
                      <?php get_directors(); ?>
                  </select>
                </div>
              </div>
              <br/>
              <a href="add_director.php" class="link">Add Director</a>
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
     </div>
   </body>
 </html>
