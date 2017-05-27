$(document).ready(function(){

  // validation
  // Setup form validation on all forms

  $.validate({ modules: 'file' });

  // Ajax

  var table = "";
  var fieldHTML = "";
  function getAjax(table){
    $.ajax({   
            type: "GET",   
            url: "ajax.php",   
            data: {name: table},
            cache: false,
            success: function(data){
              var id = "";
              if(table == "directors"){
                id = "DirectorID";
              } else if(table == "producers"){
                id = "ProducerID";
              } else if(table == "actors"){
                id = "ActorID";
              }
              $.each( data, function( key, value ) {
                fieldHTML += "<option value='" + value.id + "'>" + value.FirstName + " " + value.LastName + "</option>";
              });
             },
             dataType: "json"
           });
  }

  getAjax("directors");

  $.when( $.ready ).then(function() {
    $("#directors").append(fieldHTML);
  });

  $("button").click(function(){
    var title = $("#title").val();
    var release_date = $("#release_date").val();
    var running_time = $("#running_time").val();
    var genre = $("#genre").val();
    var distributor = $("#distributor").val();
    console.log(title + " " + release_date + " " + running_time + " " + genre + " " + distributor);
  });

  $("#submit").click(function(){
    $("#title").val(title);
    $("#release_date").val(release_date);
    $("#running_time").val(running_time);
    $("#genre").val(genre);
    $("#distributor").val(distributor);
  });

// get directors

$("#load").click(function(){
  $("#directors").append(fieldHTML);
});

// Reset fieldHTML

fieldHTML = "";

  // Date Picker

  $(function() {
    $( "#releasedate" ).datepicker();
  });

});
