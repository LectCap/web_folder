/** Belongs to createCourse.php and is responsible for creating a new course **/

$(document).ready(function(){
  $('#createCourse-form').submit(function(e){
    e.preventDefault();
	var course_code = $('input[name=course_code]').val();
	var course_name = $('input[name=course_name]').val();
	var course_description = $('textarea[name=course_description]').val();
    $.ajax({
      url: '/php/setCourseinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'course_code' : course_code, 'course_name' : course_name, 'course_description' : course_description}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#createCourse_error').html(""); 
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -2) {
			$('#createCourse_error').css('color', '#ffa800');
			$('#createCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
		  }
		  else if(recv === -1) {
			$('#createCourse_error').css('color', '#ffa800');
			$('#createCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspCourse code already taken!</p>');
		  }
		  else if(recv === 1) {
			var user_id = data["user_id"];
			var course_id = data["course_id"];
			window.location.replace("http://localhost:8080/course.php?user=" + user_id + "&course=" + course_id);
		  }
		  else{
			$('#createCourse_error').css('color', '#ffa800');
			$('#createCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
		  }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})