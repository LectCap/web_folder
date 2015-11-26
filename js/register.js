$(document).ready(function(){
  $('#register-form').submit(function(e){
	console.log("JS entered");
    e.preventDefault();
	var username = $('input[name=username_reg]').val();
	var pwd = $('input[name=password_reg]').val();
	var pwd2 = $('input[name=password_confirm]').val();
	var firstname = $('input[name=firstname]').val();
	var lastname = $('input[name=lastname]').val();
	var school = $('input[name=school]').val();
	var programme = $('input[name=programme]').val();
	var email = $('input[name=email]').val();
	console.log(username);
	console.log(pwd);
    $.ajax({
      url: '/php/register.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'username_reg' : username, 'password_reg' : pwd, 'password_confirm' : pwd2, 'firstname' : firstname, 'lastname' : lastname, 'school' : school, 'programme' : programme, 'email' : email}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#register_error').html(""); 
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -2) {
			$('#register_error').append("<p>Database error! Please consult administrator</p>");  
		  }
		  else if(recv === -1) {
			$('#register_error').append("<p>Wrong username or password!</p>");  
		  }
		  else if(recv === 0) {
			$('#register_error').append("<p>Username already exists!</p>");  
		  }
		  else if(recv === -3) {
			$('#register_error').append("<p>Email already exists!</p>");  
		  }
		  else if(recv === 1) {
			window.location.replace("http://localhost:8080/start.php");
		  }
		  else{
			$('#register_error').append("<p>Something went terribly wrong</p>");  
		  }
		  console.log(recv);
          $('#register_error').append("<p>"+recv+"</p>");
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})