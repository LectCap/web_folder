/* Belongs to course.php. Used for generating tables and giving users links to lectures */
 /* DataTables jQuery plugin is used here to show the table */
$(document).ready(function() {
	var course_id = $('#lectures_list').data('courseid');
	var user_id = $('#lectures_list').data('userid');
	var thNr = $('#lectures_list th').length;
	if(thNr==8){
    var lectures_table = $('#lectures_list').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "php/getLecturesList.php?course="+course_id,
        "columnDefs": [
            { 
				"data": "title",
				"targets": 0
			},
            { 
				"data": "description", 
				"targets": 1 
			},
            { 
				"data": "id", 
				"targets": 2,
				//Insert button with link to lecture
				"createdCell": function (td, cellData, rowData, row, col) {
					var id = cellData;
					$(td).html(cellData.replace(id, '<button class="lectureLink tableButton" data-lecture='+id+'>Open</button>'));
				}			
			},
				{ //Remove student button
					"data": null,
					"defaultContent": "<button class='removeBtn tableButton'>Remove</button>",
					"class": "removeBtn",
					"searchable": false,
					"targets": 3
				},
			{
				"class": "details-control",
                //"orderable":      false,
                "data":           null,
				"targets": [0,1,2]
			},
			
        ],
        "order": [[1, 'asc']]
    } );
}
 else{
	     var lectures_table = $('#lectures_list').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "php/getLecturesList.php?course="+course_id,
        "columnDefs": [
            { 
				"data": "title",
				"targets": 0
			},
            { 
				"data": "description", 
				"targets": 1 
			},
            { 
				"data": "id", 
				"targets": 2,
				//Insert button with link to lecture
				"createdCell": function (td, cellData, rowData, row, col) {
					var id = cellData;
					$(td).html(cellData.replace(id, '<button class="lectureLink tableButton" data-lecture='+id+'>Open</button>'));
				}			
			},
			{
				"class": "details-control",
                //"orderable":      false,
                "data":           null,
				"targets": [0,1,2]
			},
			
        ],
        "order": [[1, 'asc']]
    } );
	 
 }
    // Array to track the ids of the details displayed rows
    var detailRows = [];
/* When clicking the Open button, the user is redirected to the lecture page */
    $('#lectures_list tbody').on( 'click', '.lectureLink', function () {
		var button = $(this);
		var lecture_id = button.data("lecture");
		var lectureLink = "./lecture.php?user="+user_id+"&course="+course_id+"&lecture_id="+lecture_id;
		window.location.replace(lectureLink); 
    } );
	
		/* When clicking Remove button, the lecture is removed from the course */
    $('#lectures_list tbody').on( 'click', 'button.removeBtn', function () {
		if(confirm("Do you really want to remove this lecture from the course?")) {
			var tr = $(this).closest('tr');
			var button = $(this);
			var row = lectures_table.row( tr );
			var rowData = lectures_table.row(tr).data();
			var id = rowData['DT_RowId'];
			/* Row id has format "row-XX". Need to extract only the id */
			id = id.split("_").pop();
			console.log(id);
			$.ajax({
			  url: "/php/removeLecture.php", //PHP file you want to access
			  type: 'POST',
			  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
			  dataType: "json", //Tells AJAX to expect JSON data to be returned
			  data: JSON.stringify({'user_id': user_id, 'course_id': course_id, 'lecture_id' : id}), //The data to send. Needs to turned into JSON compatible data
			  success: function(data) { //Data is the returned variable with echo.
				  $('#lectures_list_error').html("");
				  $('#lectures_list_error').css('opacity', '1');
				  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
				  if(recv === -2) {
					$('#lectures_list_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
					$('#lectures_list_error').fadeTo(1000, 0.5);	
				  } else if(recv === -1) {
					$('#lectures_list_error').append('<p><i class="fa fa-check" style="color: red"></i>&nbspYou cannot remove yourself from this menu!<br/>&nbspIn order to exit the course do this through the main course page.</p>');  
					$('#lectures_list_error').fadeTo(1000, 0.5);			
				  } else if(recv === 1) {
					row.remove();
					lectures_table.draw();
					$('#lectures_list_error').append('<p><i class="fa fa-check" style="color: green"></i>&nbspLecture has been removed from the course!</p>');  
					$('#lectures_list_error').fadeTo(1000, 0.5);			
				  }
				  else{
					$('#lectures_list_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
					$('#lectures_list_error').fadeTo(1000, 0.5);
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
    } );
} );