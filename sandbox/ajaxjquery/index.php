<html>

<head>

   <title>jQuery AJAX Example</title>

   <!-- https://programmerblog.net/jquery-ajax-get-example-php-mysql/ -->

</head>

<body>

 <p><strong>Click on button to view users</strong></p>

 <div id = "container" >

<div id="records"></div>

<p>
    <button type=”button” id = "getusers" >Get Users</button>
</p>

</div>

<script src=”../../includes/jquery/jquery-3.1.1.min.js”></script>

<script type=”text/javascript”>

    $(function(){

      $( "#getusers" ).click(function() {
        alert( "Handler for .click() called." );
      });

      $("#getusers").on('click', function(){

        $(this).append('clicked');

      $.ajax({
        method: "GET",

        url: "getrecords.php",

      }).done(function( data ) {

       var result = JSONparse(data);

       var string = "<table>" +
                    "<tr>" +
                    "<th>#</th>" +
                    "<th>Name</th>" +
                    "<th>Email</th>" +
                    "</tr>";

       //from result create a string of data and append to the div
       $.each( result, function( key, value ) {

         string += "<tr>" +
                   "<td>" + value['id'] + "</td>" +
                   "<td>" + value['first_name'] +' '+ value['last_name']+"</td>" +
                   "<td>" + value['email'] + "</td>" +
                   "</tr>";

        });

        string += '</table>';

        $("#records").html(string);
      });

    });

</script>

</body>

</html>
