/* Fills in default account values */
$(document).ready(function(){
    $.ajax({
      url: '/php/getAccinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      success: function(data) { //Data is the returned variable with echo.
		  $('input[name=firstname]').val(data['firstname']);
		  $('input[name=lastname]').val(data['lastname']);
		  $('input[name=school]').val(data['school']);
		  $('input[name=programme]').val(data['programme']);
		  $('input[name=email]').val(data['email']);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
})

/* Submits new account information */
$(document).ready(function(){
  $('#edit-accinfo').submit(function(e){
    e.preventDefault();
	var firstname = $('input[name=firstname]').val();
	var lastname = $('input[name=lastname]').val();
	var school = $('input[name=school]').val();
	var programme = $('input[name=programme]').val();
    $.ajax({
      url: '/php/setAccinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'firstname' : firstname, 'lastname' : lastname, 'school' : school, 'programme' : programme}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#editAcc_error').html("");
		  $('#editAcc_error').show();
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -1) {
			$('#editAcc_error').css('color', 'red');
			$('#editAcc_error').append("<p>Database error! Please consult administrator</p>");  
		  }
		  else if(recv === 0) {
			$('#editAcc_error').css('color', 'red');
			$('#editAcc_error').append("<p>Email already taken!</p>");  
		  }
		  else if(recv === 1) {
			$('#editAcc_error').css('color', 'green');
			$('#editAcc_error').append("<p>Account information successfully changed!</p>"); 
			$('#editAcc_error').fadeOut(3000);
		  }
		  else{
			$('#editAcc_error').css('color', 'red');
			$('#editAcc_error').append("<p>Something went terribly wrong</p>");  
		  }
		  console.log(recv);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})

/* Submits new email */
$(document).ready(function(){
  $('#edit-email').submit(function(e){
    e.preventDefault();
	var pwd = $('input[name=password_email]').val();
	var email = $('input[name=email]').val();
    $.ajax({
      url: '/php/setEmail.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'password' : pwd, 'email' : email}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#editEmail_error').html(""); 
		  $('#editEmail_error').show();
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -1) {
			$('#editEmail_error').css('color', 'red');
			$('#editEmail_error').append("<p>Database error! Please consult administrator</p>");  
		  }
		  else if(recv === 0) {
			$('#editEmail_error').css('color', 'red');
			$('#editEmail_error').append("<p>Email already taken or it\'s your current email!</p>");  
		  }
		  else if(recv === 1) {
			$('#editEmail_error').css('color', 'green');
			$('#editEmail_error').append("<p>Email successfully changed!</p>"); 
			$('#editEmail_error').fadeOut(3000);
		  }
		  else if(recv === -2) {
			$('#editEmail_error').css('color', 'red');
			$('#editEmail_error').append("<p>Incorrect password!</p>"); 
		  }
		  else{
			$('#editEmail_error').css('color', 'red');
			$('#editEmail_error').append("<p>Something went terribly wrong</p>");  
		  }
		  console.log(recv);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})

/* Submits new password */
$(document).ready(function(){
  $('#edit-pwd').submit(function(e){
    e.preventDefault();
	var current_pwd = $('input[name=current_password]').val();
	var new_pwd = $('input[name=new_password]').val();
	var pwd_confirm = $('input[name=password_confirm]').val();
    $.ajax({
      url: '/php/setPwd.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'current_password' : current_pwd, 'new_password' : new_pwd, 'password_confirm' : pwd_confirm}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#editPwd_error').html(""); 
		  $('#editPwd_error').show();
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -1) {
			$('#editPwd_error').css('color', 'red');
			$('#editPwd_error').append("<p>Database error! Please consult administrator</p>");  
		  }
		  else if(recv === 0) {
			$('#editPwd_error').css('color', 'red');
			$('#editPwd_error').append("<p>Email already taken or it\'s your current email!</p>");  
		  }
		  else if(recv === 1) {
			$('#editPwd_error').css('color', 'green');
			$('#editPwd_error').append("<p>Email successfully changed!</p>"); 
			$('#editPwd_error').fadeOut(3000);
		  }
		  else if(recv === -2) {
			$('#editPwd_error').css('color', 'red');
			$('#editPwd_error').append("<p>Incorrect password!</p>"); 
		  }
		  else{
			$('#editPwd_error').css('color', 'red');
			$('#editPwd_error').append("<p>Something went terribly wrong</p>");  
		  }
		  console.log(recv);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})