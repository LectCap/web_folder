/* Fills in default account values */
$(document).ready(function(){
	var username = $('input[name=username]').val();
	var pwd = $('input[name=password]').val();
	console.log(username);
	console.log(pwd);
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
		  //$('input[name=email]').val(data['email']);
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
	var email = $('input[name=email]').val();
    $.ajax({
      url: '/php/setAccinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'firstname' : firstname, 'lastname' : lastname, 'school' : school, 'programme' : programme, 'email' : email}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#editAcc_error').html(""); 
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -1) {
			$('#editAcc_error').append("<p>Database error! Please consult administrator</p>");  
		  }
		  else if(recv === 0) {
			$('#editAcc_error').append("<p>Email already taken!</p>");  
		  }
		  else if(recv === 1) {
			$('#editAcc_error').append("<p>Account information successfully changed!</p>"); 
			$('#editAcc_error').fadeOut(3000);
		  }
		  else{
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