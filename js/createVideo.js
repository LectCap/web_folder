/** Belongs to createCourse.php and is responsible for creating a new course **/

$(document).ready(function(){
  $('#createCourse-form').submit(function(e){
    e.preventDefault();
	var video_title = $('input[name=video_title]').val();
	var video_desc = $('input[name=video_desc]').val();
	var url = $('input[name=url]').val();
    $.ajax({
      url: '/php/setVideo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'video_title' : video_title, 'video_desc' : video_desc, 'url' : url}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
	  window.location.replace("http://localhost:8080/start.php);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
})