/* Used to output a table of all students awaiting enrollment confirmation.
 * Used by viewWaitingStudents.php */

/* Formatting function for row details - modify as you need 
 * This is shown in the child row which is opened when the user expands the row */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.firstname+' '+d.lastname+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>School:</td>'+
            '<td>'+d.school+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Programme:</td>'+
            '<td>'+d.programme+'</td>'+
        '</tr>'+
    '</table>';
}
/* Loads the table. Note that almost all columns are invisible. They are used in the child rows when
 * expanding the row and I think they need to be here though */
$(document).ready(function() {
	var course_id = $("#waitingStudents_list").data("course");
    var table = $('#waitingStudents_list').DataTable( {
        "ajax": "php/getWaitingStudents.php?course="+course_id,
		"columnDefs": [
            { 
				"data": "username",
				"targets": 1
			},
            { 
				"data": "firstname", 
				"targets": 4, 
				"visible": false
			},
            { 
				"data": "lastname", 
				"targets": 5, 
				"visible": false 
			},            
			{ 
				"data": "school", 
				"targets": 6,
				"visible": false
			},			
			{ 
				"data": "programme", 
				"targets": 7,
				"visible": false
			},
			{
				"class": "details-control",
                "data":           null,
				"targets": [0,1,4,5,6,7]
			},
			{ //Expand row button
				"data": null,
				"defaultContent": "<i class='fa fa-plus-circle'></i>",
				"class": "details-control",
				"searchable": false,
				"targets": 0
			},			
			{ //Accept student button
				"data": null,
				"defaultContent": "<button class='acceptBtn tableButton'>Accept</button>",
				"class": "acceptBtn",
				"searchable": false,
				"targets": 2
			},			
			{ //Reject student button
				"data": null,
				"defaultContent": "<button class='rejectBtn tableButton'>Reject</button>",
				"class": "rejectBtn",
				"searchable": false,
				"targets": 3
			}

        ],
        "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#waitingStudents_list tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
		var row = table.row( tr );
		var rowData = table.row(tr).data();
		var id = rowData['DT_RowId'];
		var icon = $("#"+id+" i");
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
			icon.removeClass('fa-minus-circle').addClass('fa-plus-circle');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
			icon.removeClass('fa-plus-circle').addClass('fa-minus-circle');
        }
    } );
	
	/* When clicking accept button, the student is accepted into the course */
    $('#waitingStudents_list tbody').on( 'click', 'button.acceptBtn', function () {
        var tr = $(this).closest('tr');
		var button = $(this);
        var row = table.row( tr );
		var rowData = table.row(tr).data();
		var user_id = rowData['DT_RowId'];
		/* Row id has format "row-XX". Need to extract only the id */
		user_id = user_id.split("_").pop();
		var course_id = $('#waitingStudents_list').data('course');
		console.log(course_id+'\n'+user_id);
		$.ajax({
		  url: "/php/enrollAcceptReject.php", //PHP file you want to access
		  type: 'POST',
		  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
		  dataType: "json", //Tells AJAX to expect JSON data to be returned
		  data: JSON.stringify({'accept' : 1, 'user_id': user_id, 'course_id': course_id}), //The data to send. Needs to turned into JSON compatible data
		  success: function(data) { //Data is the returned variable with echo.
			  $('#viewWaitingStudents_error').html("");
			  $('#viewWaitingStudents_error').css('opacity', '1');
			  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
			  if(recv === -2) {
				$('#viewWaitingStudents_error').append('<p><a name="#viewWaitingStudents_msg"></a><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
				$('#viewWaitingStudents_error').fadeTo(1000, 0.5);
				scrollToAnchor('#viewWaitingStudents_msg');
			  } else if(recv === 1) {
				row.remove();
				table.draw();
				$('#viewWaitingStudents_error').append('<p><a name="#viewWaitingStudents_msg"></a><i class="fa fa-check" style="color: green"></i>&nbspUser has been accepted!</p>');  
				$('#viewWaitingStudents_error').fadeTo(1000, 0.5);
				scrollToAnchor('#viewWaitingStudents_msg');
			  }
			  else{
				$('#viewWaitingStudents_error').append('<p><a name="#viewWaitingStudents_msg"></a><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
				$('#viewWaitingStudents_error').fadeTo(1000, 0.5);
				scrollToAnchor('#viewWaitingStudents_msg');
			  }
		  },
		  error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		  }
		}); // end ajax call
    } );
	
	/* When clicking reject button, the student is rejected and can now reapply to course */
    $('#waitingStudents_list tbody').on( 'click', 'button.rejectBtn', function () {
        var tr = $(this).closest('tr');
		var button = $(this);
        var row = table.row( tr );
		var rowData = table.row(tr).data();
		var user_id = rowData['DT_RowId'];
		/* Row id has format "row-XX". Need to extract only the id */
		user_id = user_id.split("_").pop();
		var course_id = $('#waitingStudents_list').data('course');
		console.log(course_id+'\n'+user_id);
		$.ajax({
		  url: "/php/enrollAcceptReject.php", //PHP file you want to access
		  type: 'POST',
		  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
		  dataType: "json", //Tells AJAX to expect JSON data to be returned
		  data: JSON.stringify({'accept' : 0, 'user_id': user_id, 'course_id': course_id}), //The data to send. Needs to turned into JSON compatible data
		  success: function(data) { //Data is the returned variable with echo.
			  $('#viewWaitingStudents_error').html("");
			  $('#viewWaitingStudents_error').css('opacity', '1');
			  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
			  if(recv === -2) {
				$('#viewWaitingStudents_error').append('<p><a name="#viewWaitingStudents_msg"></a><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
				$('#viewWaitingStudents_error').fadeTo(1000, 0.5);
				scrollToAnchor('#viewWaitingStudents_msg');
			  } else if(recv === 1) {
				row.remove();
				table.draw();
				$('#viewWaitingStudents_error').append('<p><a name="#viewWaitingStudents_msg"></a><i class="fa fa-check" style="color: green"></i>&nbspUser has been rejected!</p>');  
				$('#viewWaitingStudents_error').fadeTo(1000, 0.5);
				scrollToAnchor('#viewWaitingStudents_msg');
			  }
			  else{
				$('#viewWaitingStudents_error').append('<p><a name="#viewWaitingStudents_msg"></a><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
				$('#viewWaitingStudents_error').fadeTo(1000, 0.5);
				scrollToAnchor('#viewWaitingStudents_msg');
			  }
		  },
		  error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		  }
		}); // end ajax call
    } );
	
	//Enables smooth scrolling down to the status message
	function scrollToAnchor(aid){
		var aTag = $("a[name='"+ aid +"']");
		$('html,body').animate({scrollTop: aTag.offset().top},'slow');
	}
} );