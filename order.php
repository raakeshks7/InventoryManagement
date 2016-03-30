<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart - Data from a database</title>
	  <link  rel="stylesheet" type="text/css" href="style.css" />

	<!--  Include the `fusioncharts.js` file. This file is needed to render the chart. Ensure that the path to this JS file is correct. Otherwise, it may lead to JavaScript errors. -->

      <script src="js/fusioncharts.js"></script>
   </head>
   <body>
   <?php require 'dbconn.php'; ?>
  	<?php

     	// Form the SQL query that returns the top 10 most populous countries
     	$strQuery = "SELECT outlet_name, count(Order_ID), outlet_name FROM orders_fact_table, `calendar_dimension` cal, `outlet_dimension` as outlet WHERE orders_fact_table.Calendar_Key = cal.Calendar_Key AND orders_fact_table.Outlet_Key = outlet.Outlet_Key GROUP BY outlet_name";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
                    "caption" => "Orders placed by Outlets",
                    "subcaption" => "2014-2015",
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

        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
                "label" => $row["outlet_name"],
                "value" => $row["count(Order_ID)"],
                "link" => "orderDrill.php?outlet_name=".$row["outlet_name"]
              	)
              	//print $row["outlet_name"];
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}

  	?>
    <?php require 'testg.php'; ?>
  	<div id="chart-1"><!-- Fusion Charts will render here--></div>
    <div></div>
    <div id="chart-2"><!-- Fusion Charts will render here--></div>
   </body>
</html>