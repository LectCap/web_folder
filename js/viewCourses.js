/* Belongs to viewCourses.php. Used for generating tables and handling course enrollment */
function format ( d ) {
    return 'Full name: '+d.code+' '+d.name+'<br>'+
        'Salary: '+d.description+'<br>'+
        'The child row can contain any data you wish, including links, images, inner tables etc.';
}
 /* DataTables jQuery plugin is used here to show the tables */
$(document).ready(function() {
    var dt = $('#course_list').DataTable( {
        "processing": true,
        "ajax": "php/getCourselist.php",
        "columnDefs": [
            { 
				"data": "code",
				"targets": 0
			},
            { 
				"data": "name", 
				"targets": 1 
			},
            { 
				"data": "description", 
				"targets": 2
			},
			{
				"class": "details-control",
                //"orderable":      false,
                "data":           null,
				"targets": [0,1,2]
			},
			{
				"data": null,
				"defaultContent": "<button class='tableButton'>Enroll</button>",
				"class": "details-control button",
				"searchable": false,
				"targets": 3
			},
        ],
		//Checks if the user has enrolled in the course. If he/she has, then the row is not shown
		"createdRow": function( row, data, dataIndex ) {
			var rowData = row;
			var course_id = rowData['id'];
			course_id = course_id.split("_").pop();
			$.ajax({
			  url: "/php/checkCourseParticipation.php", //PHP file you want to access
			  type: 'POST',
			  async: false, // We need a synced response to allow removal of unwanted rows
			  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
			  dataType: "json", //Tells AJAX to expect JSON data to be returned
			  data: JSON.stringify({'course_id' : course_id}), //The data to send. Needs to turned into JSON compatible data
			  success: function(data) { //Data is the returned variable with echo.
				  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
				  if(recv == 1) {
					dt.rows($(row)).remove();
				  }
			  },
			  error: function(xhr, desc, err) {
				console.log(xhr);
				console.log("Details: " + desc + "\nError:" + err);
			  }
			}); // end ajax call
		},
        "order": [[1, 'asc']]
    } );
 
    // Array to track the ids of the details displayed rows
    var detailRows = [];
/* When clicking a button, an enrollment request is sent to the server */
    $('#course_list tbody').on( 'click', 'button', function () {
        var tr = $(this).closest('tr');
		var button = $(this);
        var row = dt.row( tr );
		var rowData = dt.row(tr).data();
		console.log(rowData);
		var course_id = rowData['DT_RowId'];
		/* Row id has format "row-XX". Need to extract only the id */
		var course_id = course_id.split("_").pop();
		var user_id = $('#course_list').data('userid');
		$.ajax({
		  url: "/php/enrollCourse.php", //PHP file you want to access
		  type: 'POST',
		  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
		  dataType: "json", //Tells AJAX to expect JSON data to be returned
		  data: JSON.stringify({'course_id' : course_id, 'user_id': user_id}), //The data to send. Needs to turned into JSON compatible data
		  success: function(data) { //Data is the returned variable with echo.
			  $('#viewCourses_error').html("");
			  $('#viewCourses_error').css('opacity', '1');
			  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
			  if(recv === -2) {
				$('#viewCourses_error').css('color', '#ffa800');
				$('#viewCourses_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
				$('#viewCourses_error').fadeTo(1000, 0.5);	
			  }
			  else if(recv === -1) {
				$('#viewCourses_error').css('color', '#ffa800');
				$('#viewCourses_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspAlready enrolled!</p>');
				$('#viewCourses_error').fadeTo(1000, 0.5);	
			  }
			  else if(recv === -3) {
				window.location.replace("http://localhost:8080/index.php"); 
			  }
			  else if(recv === 1) {
				//Removes row and notifies user that he/she is enrolled
				row.remove();
				dt.draw();
				$('#viewCourses_error').append('<p><i class="fa fa-check" style="color: green"></i>&nbspYou have enrolled and are now awaiting teacher confirmation!</p>');  
				$('#viewCourses_error').fadeTo(1000, 0.5);
			  }
			  else{
				$('#viewCourses_error').css('color', '#ffa800');
				$('#viewCourses_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
				$('#viewCourses_error').fadeTo(1000, 0.5);
			  }
		  },
		  error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		  }
		}); // end ajax call
        //var idx = $.inArray( tr.attr('id'), detailRows );
 
        /*if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
			console.log(tr.attr('id'));
            row.child.hide();
 
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
 
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }*/
    } );
 
    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );
} );