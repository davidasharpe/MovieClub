<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_parent_page = "";
  $active_page = "gallery";
  // Render page header
  include('../includes/header.php');
?>

<div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Gallery</h1>
         <div class="row group">
             <div class="col-md-12 column-bg">
                   <div class="col-md-2">
                   </div>
                   <div class="col-md-8">
                   <h2> Road to Revolution Premiere</h2>
                     <ul class="bxslider">
                         <li><img src="images/gallery/Road_to_Revolution_01.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                         <li><img src="images/gallery/Road_to_Revolution_02.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                         <li><img src="images/gallery/Road_to_Revolution_03.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                         <li><img src="images/gallery/Road_to_Revolution_04.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                         <li><img src="images/gallery/Road_to_Revolution_05.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                         <li><img src="images/gallery/Road_to_Revolution_06.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                         <li><img src="images/gallery/Road_to_Revolution_07.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                         <li><img src="images/gallery/Road_to_Revolution_08.jpg" title="Road to Revolution Premiere" alt="Road to Revolution"></li>
                     </ul>
                   </div>
                 <div class="col-md-2">
                 </div>
           </div>
       </div>
     </div>
   </div>
</div><!-- /.container -->
<?php
  include('../includes/footer.php');
?>
<!-- bxSlider Javascript file -->
<script src="jquery.bxslider/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
<script>
$(document).ready(function(){
      $('.bxslider').bxSlider({
          auto: true
      });
});
</script>
