<?php
  // Include session & functions
  require_once('../includes/session.php');
  require_once('../includes/functions.php');
  // Include database & validation
  require_once('../includes/database.php');
  require_once('../includes/validation.php');
  // Set active page for navigation
  $active_parent_page = "";
  $active_page = "help";
  // Render page header
  include('../includes/header.php');
?>
 <div class="container">
   <div class="main">
     <div class="starter-template">
       <h1>Help</h1>
             <div class="col-md-12 column-bg">
               <div class="col-md-2"></div>
               <div class="col-md-8">
                 <div id="accordion">
                  <h3>All Users</h3>
                     <h4 class="accordion-toggle">View Movies</h4>
                     <div class="accordion-content default">
                      <p>To view movies navigate to Movies -> View Movies.<p>
                      <p>On the movie list click on the View link to view the selected movie.<p>
                     </div>
                     <h4 class="accordion-toggle">View Ratings</h4>
                     <div class="accordion-content">
                      <p>Ratings for each movie can be seen in the View movie page of the selected movie.</p>
                     </div>
                  <hr/>
                  <h3>Members</h3>
                     <h4 class="accordion-toggle">Login and Logout</h4>
                     <div class="accordion-content default">
                       <p>To log in navigate to the Login Page by clicking on Login on the right hand side of the naviation menu. Enter your username and password. You will then be redirected to the home page.<p>
                       <p>To log out click on Logout on the navigation menu.</p>
                     </div>
                     <h4 class="accordion-toggle">Add Movies</h4>
                     <div class="accordion-content">
                       <p>To Add a Movie navigate to the Movies -> Add Movie page. Fill out the online form:</p>
                       <ol>
                         <li>The following fields are required to be filled: Tille, Release Date, Running Time</li>
                         <li>Directors, Producers, Actors, Genres, Distributors can be selected with the drop down menus. If the item you are looking is not on the list, you will have to add them to the database.</li>
                         <li>To add a new director, click on Add Director link, which take to another page. Enter the first and last name and clikc on Submit.</li>
                         <li>Click Back to take you back the Add Movie page.</li>
                         <li>Repeat the same steps to add a new producer, actor, genre and distributor.</li>
                         <li>Once you have added the new items, fill in the form. If you have added new director, producer, actor, genre or distributor, they will appear in the drop down lists.</li>
                         <li>Click on Submit button. The movie is now added to the database which can be seen in the View Movies page.</li>
                       </ol>
                     </div>
                     <h4 class="accordion-toggle">Rate Movie</h4>
                     <div class="accordion-content">
                       <p>You can rate movie by navigating to Movies -> View Movie and click View for the selected movie you wish to rate.</p>
                       <p>In the View selected movie page scroll to bottom to the movie rating form. Select the rate from 1 to five stars, write a short review and click Submit.</p>
                       <P>Your movie rating now appears under Movie Ratings on the page</p>
                     </div>
                     <h4 class="accordion-toggle">View/Edit Account</h4>
                     <div class="accordion-content">
                       <p>When you login your user name appears in the navagation bar on the right hand side. Click on your user name to access your account details.</p>
                       <p>In your Members Account page you and update your Name, email and phone number.</p>
                     </div>
                     <h4 class="accordion-toggle">Change Password</h4>
                     <div class="accordion-content">
                       <p>Your password can be changed by clinking on Change Password button in the Member Account page.</p>
                       <P>On the Change Password page re-enter your old password, enter your new password, confirm password and click Submit.</P>
                     </div>
                   <hr/>
                   <h3>Admin</h3>
                     <h4 class="accordion-toggle">Manage Members</a></h4>
                     <div class="accordion-content">
                       <p>Logining as an administrator gives you access to the Admin section of the website. The Admin dropdown menu appears in the navigation bar. Click on this dropdown reveals sub menu for Manage Members and Add Member.</p>
                       <p>Click on the Admin dropdown menu and then click on Manage Members.</p>
                       <P>The Manage Members page displays a list of members. From here you can edit member details or add a new member.</p>
                     </div>
                     <h4 class="accordion-toggle">Add Member</h4>
                     <div class="accordion-content">
                       <p>To add a member navigate to Admin -> Add Members</p>
                       <P>Fill in the form on the Add Member page, create a temporary password and click Submit.</p>
                       <p>The new member now appears in the members list on the Manage Members page.</p>
                       <p>The member can now change their password after logging into their account.</p>
                     </div>
                     <h4 class="accordion-toggle">Edit Member</h4>
                     <div class="accordion-content">
                       <p>To Edit a member navigate to Admin -> Manage Members. The click Edit on the member you wish to edit.</p>
                       <P>On the Member Account page update the form and click Submit.</p>
                       <P>The updated member details now appears on the Manage Members page.</p>
                     </div>
                     <h4 class="accordion-toggle">Delete Member</h4>
                     <div class="accordion-content">
                       <p>To delete a member navigate to Admin -> Manage Members. The click Edit on the member you wish to delete.</p>
                       <p>On the Edit Member page click the delete button and confirm deletion. The member is now deleted.</p>
                     </div>
                     <h4 class="accordion-toggle">Edit Movie</h4>
                     <div class="accordion-content">
                       <p>To edit a movie navigate to Movies -> View Movies. Then click Edit on the movie you wish to edit.</p>
                       <p>Update the movie details and then click Submit.</p>
                       <P>The updated movie now appears on the View Movies page</p>
                     </div>
                     <h4 class="accordion-toggle">Delete Movie</h4>
                     <div class="accordion-content">
                       <p>To delete a movie navigate to Movies -> View Movies. Then click Edit on the movie you wish to delete.</p>
                       <p>On the Edit Movie page click the delete button and confirm deletion. The movie is now deleted.</p>
                     </div>
                     <h4 class="accordion-toggle">Delete Movie Rating</h4>
                     <div class="accordion-content">
                       <p>To delete a movie rating navigate to Movies -> View Movies. Then click View on the movie you wish to delete the rating from.</p>
                       <p>On the View selected movie page click the delete button on the rating you wish to delete and confirm deletion. The movie rating is now deleted.</p>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-2"></div>
             </div>
         </div>
     </div>
 </div>
<?php
  include('../includes/footer.php');
?>
<script type="text/javascript">
  $(document).ready(function($) {
    $('#accordion').find('.accordion-toggle').click(function(){

      //Expand or collapse this panel
      $(this).next().slideToggle('fast');

      //Hide the other panels
      $(".accordion-content").not($(this).next()).slideUp('fast');

    });
  });
</script>
