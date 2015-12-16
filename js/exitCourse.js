/*** Belongs to course.php ***/

/* Deletes all relevant database entries for the course in order to successfully close it. */
$(document).ready(function(){
  $('#exitCourse_form').submit(function(e){
    e.preventDefault();
	if(confirm("Do you really want to exit the course?\nThis will prevent you from accessing this course site unless you reapply!")) {
		var course_id = $("#exitCourse_form").data("course");
		var user_id = $("#exitCourse_form").data("user");
		var teacher = $("#exitCourse_form").data("teacher");
		$.ajax({
		  url: '/php/exitCourse.php', //PHP file you want to access
		  type: 'POST',
		  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
		  dataType: "json", //Tells AJAX to expect JSON data to be returned,
		  data: JSON.stringify({'user_id' : user_id, 'course_id': course_id, 'teacher': teacher}),
		  success: function(data) { //Data is the returned variable with echo.
			  $('#exitCourse_error').html("");
			  $('#exitCourse_error').css('opacity', '1');
			  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
			  if(recv === -2) {
				$('#exitCourse_error').css('color', '#ffa800');
				$('#exitCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
				$('#exitCourse_error').fadeTo(1000, 0.5);	
			  }
			  if(recv === -1) {
				$('#exitCourse_error').css('color', '#ffa800');
				$('#exitCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspYou are the only teacher in the course! Assign another user as teacher or close the course.</p>');
				$('#exitCourse_error').fadeTo(1000, 0.5);	
			  }
			  else if(recv === -3) {
				window.location.replace("http://localhost:8080/index.php"); 
			  }
			  else if(recv === 1) {
				window.location.replace("http://localhost:8080/start.php?info=exitedCourse"); 
			  }
			  else {
				$('#exitCourse_error').css('color', '#ffa800');
				$('#exitCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
				$('#exitCourse_error').fadeTo(1000, 0.5);
			  }
		  },
		  error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		  }
		}); // end ajax call
	} else {
		return 0;
	}
  });
})