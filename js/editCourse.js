/*** Belongs to editCourse.php ***/

/* Fills in default course values */
$(document).ready(function(){
	var course_id = $("#editCourse-form").data("courseid");
    $.ajax({
      url: '/php/getCourseinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned,
	  data: JSON.stringify({'course_id' : course_id}),
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
	var course_id = $("#editCourse-form").data("courseid");
	var user_id = $("#editCourse-form").data("userid");
	var course_code = $('input[name=edit_course_code]').val();
	var course_name = $('input[name=edit_course_name]').val();
	var course_description = $('textarea[name=edit_course_description]').val();
	var url = '/php/editCourseinfo.php?user='+user_id+'&course='+course_id;
    $.ajax({
      url: url, //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'course_code' : course_code, 'course_name' : course_name, 'course_description' : course_description}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#editCourse_error').html("");
		  $('#editCourse_error').css('opacity', '1');
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -2) {
			$('#editCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
			$('#editCourse_error').fadeTo(1000, 0.5);	
		  }
		  else if(recv === -1) {
			$('#editCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspCourse code already taken!</p>');
			$('#editCourse_error').fadeTo(1000, 0.5);	
		  }
		  else if(recv === -3) {
			window.location.replace("http://localhost:8080/index.php"); 
		  }
		  else if(recv === 1) {
			$('#editCourse_error').append('<p><i class="fa fa-check" style="color: lime"></i>&nbspCourse information successfully changed!</p>'); 
			$('#editCourse_error').fadeTo(1000, 0.5);		
		  }
		  else{
			$('#editCourse_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
			$('#editCourse_error').fadeTo(1000, 0.5);
		  }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})