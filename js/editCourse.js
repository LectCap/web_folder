/* Fills in default course values */
$(document).ready(function(){
	var course_code = $("#editCourse-form").data("id");
    $.ajax({
      url: '/php/getCourseinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned,
	  data: JSON.stringify({'course_id' : course_code}),
      success: function(data) { //Data is the returned variable with echo.
		  var recv = data['code'];
		  if(recv === -2) {
			window.location.replace("http://localhost:8080/index.php");
		  } else if (recv === 1) {
				$('input[name=edit_course_code]').val(data['course_code']);
			    $('input[name=edit_course_name]').val(data['course_name']);
			    $('textarea[name=edit_course_description]').val(data['course_description']); 
		  } else {
			window.location.replace("http://localhost:8080/index.php");  
		  } 
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
})

/* Submits changes to course attributes */
$(document).ready(function(){
  $('#editCourse-form').submit(function(e){
    e.preventDefault();
	var course_code = $('input[name=edit_course_code]').val();
	var course_name = $('input[name=edit_course_name]').val();
	var course_description = $('textarea[name=edit_course_description]').val();
    $.ajax({
      url: '/php/editCourseinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'course_code' : course_code, 'course_name' : course_name, 'course_description' : course_description}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#editCourse_error').html(""); 
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -2) {
			$('#editCourse_error').append("<p>Database error! Please consult administrator</p>");
		  }
		  else if(recv === -1) {
			$('#editCourse_error').append("<p>Course code already taken!</p>");
		  }
		  else if(recv === 1) {
			var user_id = data["user_id"];
			var course_id = data["course_id"];
			window.location.replace("http://localhost:8080/course.php?user=" + user_id + "&course=" + course_id);
		  }
		  else{
			$('#editCourse_error').append("<p>Something went terribly wrong</p>");  
		  }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})