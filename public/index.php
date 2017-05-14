 <?php
  // Include session, database & functions
  require_once('../includes/session.php');
  require_once('../includes/database.php');
  require_once('../includes/functions.php');
  // Set active page for navigation
  $active_page = "index";
  // Render header
  include('../includes/header.php');
  // Detect form submission
  if (isset($_POST['submit'])) {
    // Set chosen theme, font size and background values
    $theme = $_POST["theme"];
    $font_size = $_POST["font_size"];
    $background_image = $_POST["background_image"];
    // set cookies
    setcookie("theme", $theme, time()+60*60*24*30);
    setcookie("font_size", $font_size, time()+60*60*24*30);
    setcookie("background_image", $background_image, time()+60*60*24*30);
    // reload page so has new cookie variables
    header('Location: index.php');
  }
 ?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <div class="row">
         <div class="col-sm-5">
           <h1>Movie Club</h1>
           <h2>Welcome to the movie club</h2>
           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin finibus posuere blandit. Etiam nec eros vel ante auctor congue vel et lacus. Quisque aliquet posuere ipsum, at ultricies eros ultricies et. Suspendisse sit amet nisl metus. Cras auctor cursus nibh, eu pretium orci interdum fringilla. Sed ipsum mi, euismod in nisl vel, ullamcorper dapibus ante. Morbi congue, sem quis auctor accumsan, ipsum ipsum euismod dolor, tincidunt tempor nibh sapien a mi. In euismod sapien id venenatis maximus. Aenean ultrices mi facilisis scelerisque sodales. Sed mattis auctor diam eu faucibus. Nulla sollicitudin risus suscipit iaculis pulvinar. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
           <p>Pellentesque arcu metus, scelerisque fermentum porta vel, lobortis quis justo. Integer quis lectus lorem. Quisque ex est, fermentum non vulputate in, lobortis in erat. Donec eu arcu augue. Aenean sollicitudin orci eget laoreet efficitur. Quisque tincidunt turpis vel leo venenatis, eu sollicitudin orci dignissim. Ut dapibus metus et iaculis maximus.</p>
           <p>Phasellus commodo diam sit amet sapien vehicula, eu rhoncus neque blandit. Etiam eget interdum felis. Aenean egestas vestibulum metus, et tincidunt sem posuere eu. Sed pharetra, mauris in lacinia imperdiet, dui purus laoreet tellus, in tincidunt lectus lectus eget libero. Nam rhoncus nec nunc vel tempor. Fusce eu facilisis sapien. Sed sed nisl id diam facilisis laoreet. Maecenas sed sagittis tortor. Nulla sodales est vel risus rhoncus varius. Aliquam quis velit at turpis consequat tempor. Integer lorem tortor, scelerisque sit amet ante vitae, porta luctus mauris. Proin et dolor nec dolor feugiat vestibulum.</p>
         </div>
         <div class="col-sm-5"></div>
         <div class="col-sm-2">
           <div id="user_preferences">
             <h4>User Preferences</h4>
             <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal">
               <div class="form-group">
                   <label for="theme" class="col-sm-12 control-label" style="text-align:left">Select Theme</label>
                   <div class="col-sm-12">
                     <select name="theme" class="form-control">
                       <option value="">Default</option>
                       <option value="Cerulean"<?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Cerulean"){echo "selected";}}?>>Cerulean</option>
                       <option value="Cosmo" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Cosmo"){echo "selected";}}?>>Cosmo</option>
                       <option value="Cyborg" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Cyborg"){echo "selected";}}?>>Cyborg</option>
                       <option value="Darkly" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Darkly"){echo "selected";}}?>>Darkly</option>
                       <option value="Flatly" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Flatly"){echo "selected";}}?>>Flatly</option>
                       <option value="Journal" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Journal"){echo "selected";}}?>>Journal</option>
                       <option value="Lumen" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Lumen"){echo "selected";}}?>>Lumen</option>
                       <option value="Paper" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Paper"){echo "selected";}}?>>Paper</option>
                       <option value="Readable" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Readable"){echo "selected";}}?>>Readable</option>
                       <option value="Sandstone" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Sandstone"){echo "selected";}}?>>Sandstone</option>
                       <option value="Simplex" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Simplex"){echo "selected";}}?>>Simplex</option>
                       <option value="Slate" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Slate"){echo "selected";}}?>>Slate</option>
                       <option value="Spacelab" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Spacelab"){echo "selected";}}?>>Spacelab</option>
                       <option value="Superhero" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Superhero"){echo "selected";}}?>>Superhero</option>
                       <option value="Unitied" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Unitied"){echo "selected";}}?>>Unitied</option>
                       <option value="Yeti" <?php if(isset($_COOKIE["theme"])){if($_COOKIE["theme"] == "Yeti"){echo "selected";}}?>>Yeti</option>
                     </select>
                   </div>
               </div>
               <div class="form-group">
                 <label for="font_size" class="col-sm-12 control-label" style="text-align:left">Font Size</label>
                 <div class="col-sm-12">
                   <select name="font_size" class="form-control">
                     <option value="">Default</option>
                     <option value="extra_small" <?php if(isset($_COOKIE["font_size"])){if($_COOKIE["font_size"] == "extra_small"){echo "selected";}}?>>Extra Small</option>
                     <option value="small" <?php if(isset($_COOKIE["font_size"])){if($_COOKIE["font_size"] == "small"){echo "selected";}}?>>Small</option>
                     <option value="medium" <?php if(isset($_COOKIE["font_size"])){if($_COOKIE["font_size"] == "medium"){echo "selected";}}?>>Medium</option>
                     <option value="large" <?php if(isset($_COOKIE["font_size"])){if($_COOKIE["font_size"] == "large"){echo "selected";}}?> >Large</option>
                     <option value="extraLarge" <?php if(isset($_COOKIE["font_size"])){if($_COOKIE["font_size"] == "extraLarge"){echo "selected";}}?>>Extra Large</option>
                   </select>
                 </div>
               </div>
               <div class="form-group">
                 <label for="font_size" class="col-sm-12 control-label" style="text-align:left">Background</label>
                 <div class="col-sm-12">
                   <select name="background_image" class="form-control">
                     <option value="">Default</option>
                     <option value="cubes" <?php if(isset($_COOKIE["background_image"])){if($_COOKIE["background_image"] == "cubes"){echo "selected";}}?>>Cubes</option>
                     <option value="emboss" <?php if(isset($_COOKIE["background_image"])){if($_COOKIE["background_image"] == "emboss"){echo "selected";}}?>>Emboss</option>
                     <option value="grunge" <?php if(isset($_COOKIE["background_image"])){if($_COOKIE["background_image"] == "grunge"){echo "selected";}}?>>Grunge</option>
                     <option value="paper" <?php if(isset($_COOKIE["background_image"])){if($_COOKIE["background_image"] == "paper"){echo "selected";}}?>>Paper</option>
                     <option value="waves" <?php if(isset($_COOKIE["background_image"])){if($_COOKIE["background_image"] == "waves"){echo "selected";}}?>>Waves</option>
                   </select>
                 </div>
               </div>
               <div class="form-group">
                 <div class="col-sm-12">
                   <input type="submit" name="submit" value="Submit" class="btn btn-success"/>
                 </div>
               </div>
             </form>
           </div>
         </div>
       </div>
   </div>
<?php
  include('../includes/footer.php');
?>
