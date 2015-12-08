<?php
 /* Called by viewCourses.js. The script is basically the default Datatables example */
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'courses';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier - in this case object
// parameter names
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
    ),
    array( 'db' => 'code', 'dt' => 'code' ),
    array( 'db' => 'name',  'dt' => 'name' ),
    array( 'db' => 'description',   'dt' => 'description' )
);
$config = parse_ini_file('C:/config.ini'); 
$sql_details = array(
    'user' => $config['username'],
    'pass' => $config['password'],
    'db'   => $config['dbname'],
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
/*session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
getCourselist();
function getCourselist() {
	header('Content-Type: application/json; charset=UTF-8');
	$rows = db_select("SELECT code, name, description FROM courses");
	$a['data'] = $rows;
	//$a[] = array('data' => $rows);
	echo json_encode($rows);
}*/
?>