/** Belongs to createCourse.php and is responsible for creating a new course **/

$(document).ready(function(){
  $('#createVideo-form').submit(function(e){
    e.preventDefault();
	var video_title = $('input[name=video_title]').val();
	var video_description = $('input[name=video_description]').val();
	var url = $('input[name=url]').val();
    $.ajax({
      url: '/php/setVideo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'video_title' : video_title, 'video_description' : video_description, 'url' : url}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#createVideo_error').html(""); 
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -2) {
			$('#createVideo_error').append("<p>Database error! Please consult administrator</p>");
		  }
		  else if(recv === -1) {
			$('#createVideo_error').append("<p>Course code already taken!</p>");
		  }
		  else if(recv === 1) {
			var user_id = data["user_id"];
			window.location.replace("http://localhost:8080/");
		  }
		  else{
			$('#createVideo_error').append("<p>Something went terribly wrong</p>");  
		  }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})