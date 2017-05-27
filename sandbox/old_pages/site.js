$(document).ready(function(){

  document.getElementById("demo").innerHTML = "Hello JavaScript";

  // add new form fields

  var maxField = 10; //Input fields increment limitation
  var addButton = $('.add_button'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper

/*
  var fieldHTML = '<a href="javascript:void(0);" class="remove_button"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>';
      fieldHTML += '<select class="form-control">';
      fieldHTML += '<option value="select">select</option>';
      fieldHTML += '<?php ';
      fieldHTML += ' mysqli_data_seek($result_director, 0)';
      fieldHTML += ' while ($directors = mysqli_fetch_assoc($result_director)){';
      fieldHTML += '  echo \"<option value=\'{$directors[\"DirectorID\"]}\'>\".$directors[\"Directors\"].\"</option>\"';
      fieldHTML += ' } ';
      fieldHTML += '?>';
      fieldHTML += '</select>';

*/

var fieldHTML = '<?php echo "Hello" ?>';

  var x = 1; //Initial field counter is 1
  $(addButton).click(function(){ //Once add button is clicked
      if(x < maxField){ //Check maximum number of input fields
          x++; //Increment field counter
          $(wrapper).append(fieldHTML); // Add field html
      }
  });

  $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
      e.preventDefault();
      $(this).parent('div').remove(); //Remove field html
      x--; //Decrement field counter
  });

  // Date Picker

  $(function() {
    $( "#releasedate" ).datepicker();
  });


});
