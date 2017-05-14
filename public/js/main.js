$(document).ready(function(){

  // validation
  // Setup form validation on all forms

  $.validate({ modules: 'file' });

  // Date Picker

  $(function() {
    $( "#releasedate" ).datepicker();
  });

});
