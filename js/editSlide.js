/* Belongs to lecture.php. Used for generating table for slides */
/* DataTables jQuery plugin is used here to show the tables */
$(document).ready(function() {
	var video_id = $("#slides").data("lectureid");
    var slideTable = $('#slides').DataTable( {
        "processing": true,
        "ajax": "php/getSlidesList.php?lecture="+video_id,
        "columnDefs": [
            { 
				"data": "time",
				"targets": 0
			},
            { 
				"data": "path", 
				"targets": 1,
				"searchable": false,
				//Replace the image path with the image
				"createdCell": function (td, cellData, rowData, row, col) {
					$(td).html(cellData.replace(cellData, '<img src="'+cellData+'" width="64" height="64">'));
				}
			},
			{
				"class": "details-control",
                //"orderable":      false,
                "data":           null,
				"targets": [0,1]
			},
			{
				"data": null,
				"defaultContent": "<button class='tableButton removeSlide'>Delete</button>",
				"class": "details-control button",
				"searchable": false,
				"targets": 2
			},
        ],
        "order": [[0, 'asc']]
    } );
	
	/* When clicking Delete button, the slide is removed from the lecture */
    $('#slides tbody').on( 'click', 'button.removeSlide', function () {
		if(confirm("Do you really want to remove this slide from the lecture?")) {
			var tr = $(this).closest('tr');
			var button = $(this);
			var row = slideTable.row( tr );
			var rowData = slideTable.row(tr).data();
			var slide_id = rowData['DT_RowId'];
			/* Row id has format "row-XX". Need to extract only the id */
			slide_id = slide_id.split("_").pop();
			var video_id = $('#slides').data('lectureid');
			console.log(video_id);
			console.log(slide_id);
			$.ajax({
			  url: "/php/deleteSlide.php", //PHP file you want to access
			  type: 'POST',
			  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
			  dataType: "json", //Tells AJAX to expect JSON data to be returned
			  data: JSON.stringify({'slide_id': slide_id}), //The data to send. Needs to turned into JSON compatible data
			  success: function(data) { //Data is the returned variable with echo.
				  $('#slides_error').html("");
				  $('#slides_error').css('opacity', '1');
				  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
				  if(recv === -2) {
					$('#slides_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
					$('#slides_error').fadeTo(1000, 0.5);	
				  } else if(recv === -1) {
					$('#slides_error').append('<p><i class="fa fa-check" style="color: red"></i>&nbspYou do not have permission to do that!<br/>&nbspIn order to exit the course do this through the main course page.</p>');  
					$('#slides_error').fadeTo(1000, 0.5);			
				  } else if(recv === 1) {
					row.remove();
					slideTable.draw();
					$('#slides_error').append('<p><i class="fa fa-check" style="color: green"></i>&nbspSlide has been removed!</p>');  
					$('#slides_error').fadeTo(1000, 0.5);			
				  }
				  else{
					$('#slides_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
					$('#slides_error').fadeTo(1000, 0.5);
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
		
