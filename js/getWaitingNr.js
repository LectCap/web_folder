/* Puts a number in the course header menu indicating how many users are awaiting enrollment confirmation 
 * for the specified course. Belongs to course.php and all other course related pages with a menu */
$(document).ready(function(){
	var user_id = $("#waitingNr").data("user");
	var course_id = $("#waitingNr").data("course");
    $.ajax({
      url: '/php/getWaitingNr.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
	  data: JSON.stringify({'user_id' : user_id, 'course_id' : course_id}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		var nr = data['nr'];
		if(nr > 0) {
			$('#waitingNr').append(data['nr']);
		}
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
})
