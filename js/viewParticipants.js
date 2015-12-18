/* Used to output a table of all participants in the course as well as handle the removal of participants.
 * Used by viewParticipants.php */

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
	var course_id = $("#viewParticipants_list").data("course");
	var thNr = $('#viewParticipants_list th').length;
	//Visible by teachers only - Contains remove button
	if(thNr == 8) {
		var add_table = $('#viewParticipants_list').DataTable( {
			"processing": true,
			"ajax": "php/getParticipants.php?course="+course_id,
			"columnDefs": [
				{ 
					"data": "username",
					"targets": 1
				},
				{ 
					"data": "teacher", 
					"targets": 2,
					// Inserts value 'Teacher' or 'Student' in 'Role' column depending on db value returned
					"createdCell": function (td, cellData, rowData, row, col) {
					  if ( cellData == 1 ) {
						$(td).html(cellData.replace(1, 'Teacher'));
					  }
					  else {
						$(td).html(cellData.replace(0, 'Student'));
					  }
					}
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
					"data": null,
					"targets": [0,1,2,4,5,6,7]
				},
				{ //Expand row button
					"data": null,
					"defaultContent": "<i class='fa fa-plus-circle'></i>",
					"class": "details-control",
					"searchable": false,
					"targets": 0
				},			
				{ //Remove student button
					"data": null,
					"defaultContent": "<button class='removeBtn'>Remove</button>",
					"class": "removeBtn",
					"searchable": false,
					"targets": 3
				}

			],
			"order": [[1, 'asc']]
		} );
	//Visible by students - Contains no remove button
	} else {
		var add_table = $('#viewParticipants_list').DataTable( {
			"processing": true,
			"ajax": "php/getParticipants.php?course="+course_id,
			"columnDefs": [
				{ 
					"data": "username",
					"targets": 1
				},
				{ 
					"data": "teacher", 
					"targets": 2,
					// Inserts value 'Teacher' or 'Student' in 'Role' column depending on db value returned
					"createdCell": function (td, cellData, rowData, row, col) {
					  if ( cellData == 1 ) {
						$(td).html(cellData.replace(1, 'Teacher'));
					  }
					  else {
						$(td).html(cellData.replace(0, 'Student'));
					  }
					}
				},
				{ 
					"data": "firstname", 
					"targets": 3, 
					"visible": false
				},
				{ 
					"data": "lastname", 
					"targets": 4, 
					"visible": false 
				},            
				{ 
					"data": "school", 
					"targets": 5,
					"visible": false
				},			
				{ 
					"data": "programme", 
					"targets": 6,
					"visible": false
				},
				{
					"class": "details-control",
					"data": null,
					"targets": [0,1,2,4,5,6]
				},
				{ //Expand row button
					"data": null,
					"defaultContent": "<i class='fa fa-plus-circle'></i>",
					"class": "details-control",
					"searchable": false,
					"targets": 0
				}
			],
			"order": [[1, 'asc']]
		} );		
	}
	
    // Add event listener for opening and closing details
    $('#viewParticipants_list tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
		var row = add_table.row( tr );
		var rowData = add_table.row(tr).data();
		var id = rowData['DT_RowId'];
		var icon = $("#"+id+" i");
        var row = add_table.row( tr );
 
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
	
	/* When clicking Add Student button, the student is added to the course */
    $('#viewParticipants_list tbody').on( 'click', 'button.removeBtn', function () {
		if(confirm("Do you really want to remove this person from the course?")) {
			var tr = $(this).closest('tr');
			var button = $(this);
			var row = add_table.row( tr );
			var rowData = add_table.row(tr).data();
			var user_id = rowData['DT_RowId'];
			/* Row id has format "row-XX". Need to extract only the id */
			user_id = user_id.split("_").pop();
			var course_id = $('#viewParticipants_list').data('course');
			console.log(course_id);
			console.log(user_id);
			$.ajax({
			  url: "/php/removeParticipant.php", //PHP file you want to access
			  type: 'POST',
			  contentType: "application/json; charset=utf-8", //Sets data you are sending as JSON
			  dataType: "json", //Tells AJAX to expect JSON data to be returned
			  data: JSON.stringify({'user_id': user_id, 'course_id': course_id}), //The data to send. Needs to turned into JSON compatible data
			  success: function(data) { //Data is the returned variable with echo.
				  $('#viewParticipants_error').html("");
				  $('#viewParticipants_error').css('opacity', '1');
				  var recv = data["code"]; //data["code"] is set in the PHP file with array('code' => -1) e.g.
				  if(recv === -2) {
					$('#viewParticipants_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspDatabase error! Please consult administrator</p>');
					$('#viewParticipants_error').fadeTo(1000, 0.5);	
				  } else if(recv === -1) {
					$('#viewParticipants_error').append('<p><i class="fa fa-check" style="color: red"></i>&nbspYou cannot remove yourself from this menu!<br/>&nbspIn order to exit the course do this through the main course page.</p>');  
					$('#viewParticipants_error').fadeTo(1000, 0.5);			
				  } else if(recv === 1) {
					row.remove();
					add_table.draw();
					$('#viewParticipants_error').append('<p><i class="fa fa-check" style="color: green"></i>&nbspUser has been removed from the course!</p>');  
					$('#viewParticipants_error').fadeTo(1000, 0.5);			
				  }
				  else{
					$('#viewParticipants_error').append('<p><i class="fa fa-times" style="color: red"></i>&nbspSomething went terribly wrong</p>');  
					$('#viewParticipants_error').fadeTo(1000, 0.5);
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