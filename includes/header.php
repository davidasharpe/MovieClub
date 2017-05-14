// Get user preferences
<?php require_once('../includes/user_preferences.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Movie Club</title>
    <!-- Bootstrap Selected Theme -->
    <link href="<?php echo $css ?>" rel="stylesheet">
    <link href="../lib/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/site.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background: <?php echo $background ?>; font-size: <?php echo $font ?>">
    <nav class="navbar navbar-inverse navbar-fixed-top" > <!-- class="navbar navbar-inverse navbar-fixed-top" -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Movie Club</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if($active_page == "index"){echo "class='active'";} ?>><a href="index.php">Home</a></li>
            <li <?php if($active_page == "movies"){echo "class='active'";} ?>><a href="movies.php">Movies</a></li>
            <li <?php if($active_page == "add_movie"){echo "class='active'";} ?>><a href="add_movie.php">Add Movie</a></li>
            <?php if(isset($_SESSION['user_type'])){
              if ($_SESSION["user_type"] == "admin"){
                echo "<li class='dropdown"; if($active_page == "admin"){echo " active'";}
                echo "'><a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Admin<span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                          <li><a href='manage_members.php'>Manage Members</a></li>
                          <li><a href='add_member.php'>Add Member</a></li>
                        </ul>
                      </li>";
                }
              }
            ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if($logged_in == true) {echo "<li "; if($active_page == "account"){echo "class='active'";} echo "><a href='account.php?id={$member_id}'>" . $user_name . "</a></li>";} ?>
            <?php if($logged_in == false) {echo "<li "; if($active_page == "login"){echo "class='active'";} echo "><a href='login.php'>Login</a></li>";} else {echo "<li><a href='logout.php?action=logout'>Logout</a></li>";} ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
