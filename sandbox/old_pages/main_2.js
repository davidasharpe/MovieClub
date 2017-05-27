$(document).ready(function(){

  // add new form fields

  var maxField = 10; //Input fields increment limitation
  var d = 0; //Initial field counter is 1
  var p = 0;
  var a = 0;

  var table = "";

  var fieldHTML = "<div class='field'>" +
                  "<a class='remove_button'>" +
                  "<span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span></a>";

  var fieldHTMLReset = "<div class='field'>" +
                       "<a class='remove_button'>" +
                       "<span class='glyphicon glyphicon-minus-sign' aria-hidden='true'></span></a>";

function getAjax(table){
  $.ajax({   
          type: "GET",   
          url: "ajax.php",   
          data: {name: table},
          cache: false,
          success: function(data){
            var id = "";

            if(table == "directors"){
              d++;
              id = "DirectorID";
              fieldHTML += "<select class='form-control' name='$directors[" + d + "]'>" +                  
                           "<option value=''>select</option>";
            } else if(table == "producers"){
              p++;
              id = "ProducerID";
              fieldHTML += "<select class='form-control' name='$producers[" + p + "]'>" +                  
                           "<option value=''>select</option>";
            } else if(table == "actors"){
              a++;
              id = "ActorID";
              fieldHTML += "<select class='form-control' name='$actors[" + a + "]'>" +                  
                           "<option value=''>select</option>";
            }

            $.each( data, function( key, value ) {
              fieldHTML += "<option>" + value.FirstName + " " + value.LastName + "</option>";
            });
           },
           dataType: "json"
         });
}

// Add director field

  $('.director').on('click', '.add_button', function(e) {
    if(d < maxField){

      getAjax('directors');

      fieldHTML += "</select></div>";

      $(this).parent('div').append(fieldHTML);

      fieldHTML = fieldHTMLReset;
    }
  });

  $('.director').on('click', '.remove_button', function(e){
      e.preventDefault();
      $(this).parent('div').remove();
      d--;
  });

// Add producer field

  $('.producer').on('click', '.add_button', function(e) { //Once add button is clicked
    if(p < maxField){ //Check maximum number of input fields
      
      getAjax('producers');

      fieldHTML += "</select></div>";

      $(this).parent('div').append(fieldHTML); // Add field html

      fieldHTML = fieldHTMLReset;
    }
  });

  $('.producer').on('click', '.remove_button', function(e){ //Once remove button is clicked
      e.preventDefault();
      $(this).parent('div').remove(); //Remove field html
      p--; //Decrement field counter
  });

// Add actor field

  $('.actor').on('click', '.add_button', function(e) { //Once add button is clicked
    if(a < maxField){ //Check maximum number of input fields
      
      getAjax('actors');

      fieldHTML += "</select></div>";

      $(this).parent('div').append(fieldHTML); // Add field html

      fieldHTML = fieldHTMLReset;
    }
  });

  $('.actor').on('click', '.remove_button', function(e){ //Once remove button is clicked
      e.preventDefault();
      $(this).parent('div').remove(); //Remove field html
      a--; //Decrement field counter
  });



  // Date Picker

  $(function() {
    $( "#releasedate" ).datepicker();
  });

});
