<?php

/*Include the `fusioncharts.php` file that contains functions
	to embed the charts.
*/
  

/* 
   The following 4 code lines contain the database connection information. 
   Alternatively, you can move these code lines to a separate 
   file and include the file here. 
   You can also modify this code based on your database connection. 
 */

$hostdb = "localhost";  // MySQl host
$userdb = "root";  // MySQL username
$passdb = "root";  // MySQL password
$namedb = "cmpe226";  // MySQL database name
   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }

?>