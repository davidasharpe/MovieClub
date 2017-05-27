$('.button').click(function(){
  //alert("I'm Clicked!");

  $.ajax({   
    type: "GET",   
    url: 'test.php',   
    data: {name: 'Wayne'},   
    success: function(data){       
      alert(data);   
    }

  });

});
