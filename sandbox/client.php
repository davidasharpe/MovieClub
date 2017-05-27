<!---------------------------------------------------------------------------
Example client script for JQUERY:AJAX -> PHP:MYSQL example
---------------------------------------------------------------------------->

<html>
  <head>
    <script language="javascript" type="text/javascript" src="../lib/jquery/jquery-3.1.1.min.js"></script>
  </head>
  <body>

  <!-------------------------------------------------------------------------
  1) Create some html content that can be accessed by jquery+

  https://openenergymonitor.org/forum-archive/node/107.html
  htmlhttps://programmerblog.net/jquery-ajax-get-example-php-mysql/
  http://www.w3resource.com/ajax/working-with-PHP-and-MySQL.php


  -------------------------------------------------------------------------->
  <h2> Client example </h2>
  <h3>Output: </h3>
  <div id="output">this element will be accessed by jquery and this text replaced</div>

  <script id="source" language="javascript" type="text/javascript">

  $(function ()
  {
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    $.ajax({
      method: 'GET',
      url: 'api.php',                  //the script to call to get data
      data: "",                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format
      success: function(data)          //on recieve of reply
      {
        var id = data[0];              //get id
        var firstname = data[1];
        var lastname = data[2];         //get name
        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------

        var result = JSONparse(data);

        $.each( result, function( key, value ) {

          $('#output').html("<b>id: </b>" + value[id] + "<b> First Name: </b>" + value[firstname] + "<br/><b>Last Name</b><b>" + value[lastname]); //Set output element html

        }

        //recommend reading up on jquery selectors they are awesome
        // http://api.jquery.com/category/selectors/
      }
    });
  });

  </script>
  </body>
</html>
