/* Belongs to course.php. Used for generating tables and giving users links to lectures */
 /* DataTables jQuery plugin is used here to show the table */
$(document).ready(function() {
	var course_id = $('#lectures_list').data('courseid');
	var user_id = $('#lectures_list').data('userid');
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
 
    // Array to track the ids of the details displayed rows
    var detailRows = [];
/* When clicking the Open button, the user is redirected to the lecture page */
    $('#lectures_list tbody').on( 'click', '.lectureLink', function () {
		var button = $(this);
		var lecture_id = button.data("lecture");
		var lectureLink = "./lecture.php?user="+user_id+"&course="+course_id+"&lecture_id="+lecture_id;
		window.location.replace(lectureLink); 
    } );
} );