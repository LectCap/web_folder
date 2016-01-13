/** Belongs to lecture.php
 ** Used to change video information, such as title, description, and link **/

/* Fills in default lecture values */
$(document).ready(function(){
	var lecture_id = $("#editVideo-form").data("lectureid");
    $.ajax({
      url: '/php/getVideoinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned,
	  data: JSON.stringify({'lecture_id' : lecture_id}), //The data to send. Needs to turned into JSON compatible data
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

/* Submits new lecture information */
$(document).ready(function(){
  $('#editVideo-form').submit(function(e){
    e.preventDefault();
	var lecture_id = $("#editVideo-form").data("lectureid");
	var title = $('input[name=edit_video_title]').val();
	var description = $('textarea[name=edit_video_description]').val();
	var url = $('input[name=edit_url]').val();
	var url_id = youtube_parser(url);
	if(!url_id) {
		$('#editVideo_error').html("");
		$('#editVideo_error').css('opacity', 1);
		$('#editVideo_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspLink incorrect!</p>');
		$('#editVideo_error').fadeTo(2000, 0.7);
		return 0;
	}
    $.ajax({
      url: '/php/editVideoinfo.php', //PHP file you want to access
      type: 'POST',
	  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
	  dataType: "json", //Tells AJAX to expect JSON data to be returned
      data: JSON.stringify({'lecture_id' : lecture_id, 'title' : title, 'description' : description, 'url_id' : url_id}), //The data to send. Needs to turned into JSON compatible data
      success: function(data) { //Data is the returned variable with echo.
		  $('#editVideo_error').html("");
		  $('#editVideo_error').css('opacity', 1);
		  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
		  if(recv === -2) {
			$('#editVideo_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
			$('#editVideo_error').fadeTo(2000, 0.7);
		  }
		  else if(recv === -1) {
			$('#editVideo_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspYou do not have permission to do that!</p>');
			$('#editVideo_error').fadeTo(2000, 0.7);
		  }
		  else if(recv === 1) {
			location.reload();
		  }
		  else{
			$('#editVideo_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');
			$('#editVideo_error').fadeTo(2000, 0.7);
		  }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
  });
  
	 /* Function which extracts Youtube video id */
	function youtube_parser(url){
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		return (match&&match[7].length==11)? match[7] : false;
	}
})