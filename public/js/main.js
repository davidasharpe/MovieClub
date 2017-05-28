$(document).ready(function(){

  // validation
  // Setup form validation on all forms
  $.validate({ modules: 'file' });

  // Ajax
  var table = "";
  var fieldHTML = "";
  function getAjax_1(table){
    $.ajax({   
            type: "GET",   
            url: "ajax_1.php",   
            data: {name: table},
            cache: false,
            success: function(data){
              var id = "";
              var selector = "";
              if(table == "genres"){
                id = "GenreID";
                selector = "#genres"
              } else if(table == "distributors"){
                id = "DistributorID";
                selector = "#distributors"
              }
              $.each( data, function( key, value ) {
                fieldHTML += "<option value='" + value.id + "'>" + value.Name + "</option>";
              });
              $(selector).append(fieldHTML);
              console.log(fieldHTML);
              fieldHTML = "";
             },
             dataType: "json"
           });
  }

  function getAjax_2(table){
    $.ajax({   
            type: "GET",   
            url: "ajax_2.php",   
            data: {name: table},
            cache: false,
            success: function(data){
              var id = "";
              var selector = "";
              if(table == "directors"){
                id = "DirectorID";
                selector = "#directors"
              } else if(table == "producers"){
                id = "ProducerID";
                selector = "#producers"
              } else if(table == "actors"){
                id = "ActorID";
                selector = "#actors"
              }
              $.each( data, function( key, value ) {
                fieldHTML += "<option value='" + value.id + "'>" + value.FirstName + " " + value.LastName + "</option>";
              });
              $(selector).append(fieldHTML);
              console.log(fieldHTML);
              fieldHTML = "";
             },
             dataType: "json"
           });
  }

  getAjax_1("genres");

  getAjax_1("distributors");

  getAjax_2("directors");

  getAjax_2("producers");

  getAjax_2("actors");

  // Re-load Directors
  $("#loadDirectors").click(function(){
    $("#directors").append(fieldHTML);
  });

  // Re-load Producers
  $("#loadProducers").click(function(){
    $("#producers").append(fieldHTML);
  });

  // Re-load Actors
  $("#loadActors").click(function(){
    $("#actors").append(fieldHTML);
  });

  // Re-load Actors
  $("#loadGenres").click(function(){
    $("#genres").append(fieldHTML);
  });

  // Re-load Dsitributors
  $("#loadDistributors").click(function(){
    $("#distributors").append(fieldHTML);
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

  // Date Picker
  $(function() {
    $( "#releasedate" ).datepicker();
  });

  // Tool tip
  $('[data-toggle="tooltip"]').tooltip();

});
