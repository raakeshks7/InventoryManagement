<?php

 /* Include the `includes/fusioncharts.php` file that contains functions to embed the charts.*/

   include("fusioncharts.php");

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

  /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
?>
<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart</title>
  	<link  rel="stylesheet" type="text/css" href="css/style.css" />

	  <!--  Include the `fusioncharts.js` file. This file is needed to render the chart. Ensure that the path to this JS file is correct. Otherwise, it may lead to JavaScript errors. -->

  	<script src="js/fusioncharts.js"></script>
   </head>
   <body>
  	<?php
  		
     	$year = $_GET["name"];


     	// Form the SQL query that returns the top 10 most populous cities in the selected country
     	$yQuery = "SELECT Month, count(Order_ID) FROM orders_fact_table, `calendar_dimension` cal, `outlet_dimension` as outlet WHERE orders_fact_table.Calendar_Key = cal.Calendar_Key AND orders_fact_table.Outlet_Key = outlet.Outlet_Key AND outlet.Outlet_Name = ? GROUP BY Month";

     	// Prepare the query statement
     	$yPrepStmt = $dbhandle->prepare($yQuery);

     	// If there is an error in the statement, exit with an error message
     	if($yPrepStmt === false) {
        	exit("Error while preparing the query to fetch data from City Table. ".$dbhandle->error);
     	}

     	// Bind the parameters to the query prepared
     	$yPrepStmt->bind_param("s", $year);

     	// Execute the query
     	$yPrepStmt->execute();

     	// Get the results from the query executed
     	$yResult = $yPrepStmt->get_result();

     	// If the query returns a valid response, prepare the JSON string
     	if ($yResult) {

        	

        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
                    "caption" => "Number of monthly orders placed by ".$year,
                    "paletteColors" => "#0075c2",
                    "bgColor" => "#ffffff",
                    "borderAlpha"=> "20",
                    "canvasBorderAlpha"=> "0",
                    "usePlotGradientColor"=> "0",
                    "plotBorderAlpha"=> "10",
                    "showXAxisLine"=> "1",
                    "xAxisLineColor" => "#999999",
                    "showValues"=> "0",
                    "divlineColor" => "#999999",
                    "divLineIsDashed" => "1",
                    "showAlternateHGridColor" => "0"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = $yResult->fetch_array()) {
                array_push($arrData["data"], array(
              	"label" => $row["Month"],
              	"value" => $row["count(Order_ID)"],
              	)
           	);
        	}

           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}
  	?>

  	<a href="order.php">Back</a>
  	<div id="chart-1"><!-- Fusion Charts will render here--></div>
   </body>
</html>