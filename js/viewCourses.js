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
        "serverSide": true,
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
				"targets": 3
			}

        ],
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
				button.text("Enrolled!");	
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