// http://thisinterestsme.com/simple-ajax-request-example-jquery-php/

// Ajax GET request
$.ajax({    
  type: "GET",    
  url: 'test.php',    
  success: function(data){        
    alert(data);    
  }
});

// Ajax GET request with query string parameters
$.ajax({    
  type: "GET",    
  url: 'test.php',    
  data: {name: 'Wayne'},    
  success: function(data){        
    alert(data);    
  }
});

// Ajax POST request
$.ajax({    
  type: "POST",    
  url: 'submission.php',    
  data: {name: 'Wayne', age: 27},    
  success: function(data){        
    alert(data);    
  }
});





