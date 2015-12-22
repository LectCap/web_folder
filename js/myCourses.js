/* Belongs to myCourses.php. Used for generating tables and giving users links to course pages */
 /* DataTables jQuery plugin is used here to show the tables */
$(document).ready(function() {
    var dt = $('#myCourses_list').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "php/viewMyCourses.php",
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
				"data": "teacher",
				"targets": 3,
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
				"class": "details-control",
                //"orderable":      false,
                "data":           null,
				"targets": [0,1,2,3]
			},
			{
				"data": null,
				"defaultContent": "<button class='tableButton'>Visit</button>",
				"class": "details-control button",
				"targets": 4
			},
        ],
        "order": [[1, 'asc']]
    } );
 
    // Array to track the ids of the details displayed rows
    var detailRows = [];
/* When clicking a button, an enrollment request is sent to the server */
    $('#myCourses_list tbody').on( 'click', 'button', function () {
        var tr = $(this).closest('tr');
		var button = $(this);
        var row = dt.row( tr );
		var rowData = dt.row(tr).data();
		console.log(rowData);
		var course_id = rowData['DT_RowId'];
		/* Row id has format "row-XX". Need to extract only the id */
		var course_id = course_id.split("_").pop();
		var user_id = $('#myCourses_list').data('userid');
		console.log(course_id+'\n'+user_id);
		window.location.replace("http://localhost:8080/course.php?user="+user_id+"&course="+course_id); 
    } );
} );