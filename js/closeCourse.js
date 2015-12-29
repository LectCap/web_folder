/*** Belongs to editCourse.php ***/

/* Deletes all relevant database entries for the course in order to successfully close it. */
$(document).ready(function(){
  $('#closeCourse-form').submit(function(e){
    e.preventDefault();
	if($('#close_course_confirm').css('display') == 'none') {
		$('#close_course_confirm').show();
		$("input[name=close_course_password").prop('required',true);
	}
	else {
		if(confirm("Do you really want to delete the course?\nThe decision cannot be reversed!")) {
			var course_id = $("#closeCourse-form").data("courseid");
			var user_id = $("#closeCourse-form").data("userid");
			var pwd = $('input[name=close_course_password]').val();
			var url = '/php/closeCourse.php?user='+user_id+'&course='+course_id;
			$.ajax({
			  url: url, //PHP file you want to access
			  type: 'POST',
			  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
			  dataType: "json", //Tells AJAX to expect JSON data to be returned,
			  data: JSON.stringify({'password' : pwd}),
			  success: function(data) { //Data is the returned variable with echo.
				  $('#closeCourse_error').html("");
				  $('#closeCourse_error').css('opacity', 1);
				  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
				  if(recv === -2) {
					$('#closeCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
					$('#closeCourse_error').fadeTo(2000, 0.7);	
				  }
				  if(recv === -1) {
					$('#closeCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspYou have entered the wrong password!</p>');
					$('#closeCourse_error').fadeTo(2000, 0.7);	
				  }
				  else if(recv === -3) {
					window.location.replace("http://localhost:8080/index.php"); 
				  }
				  else if(recv === 1) {
					var course_code = data["course_code"];
					window.location.replace("http://localhost:8080/start.php?info=courseClosed");
				  }
				  else {
					$('#closeCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
					$('#closeCourse_error').fadeTo(2000, 0.7);
				  }
			  },
			  error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			  }
			}); // end ajax call
		}
		else {
			return 0;
		}
	}
  });
})