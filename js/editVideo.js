/** Belongs to lecture.php
 ** Used to change video information, such as title, description, and link **/

/* Fills in default video values */
$(document).ready(function(){
    $.ajax({
      url: '/php/getVideoinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned,
	  //data: JSON.stringify({'course_code' : course_code, 'course_name' : course_name, 'course_description' : course_description}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('input[name=edit_video_title]').val(data['title']);
		  $('textarea[name=edit_video_description]').val(data['description']);
		  $('input[name=edit_url]').val(data['url']);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
})