<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart - Data from a database</title>

  	<!-- You need to include the following JS file to render the chart.
  	When you make your own charts, make sure that the path to this JS file is correct.
  	Else, you will get JavaScript errors. -->

  	<script src="js/fusioncharts.js"></script>
  </head>

   <body>
   <?php require 'reldbconn.php';?>
  	<?php

     	// Form the SQL query that returns the top 10 most populous countries
$strQuery = "SELECT merchant_name, count(Order_status) FROM orders, merchant where orders.merchant_Id = merchant.merchant_Id group by orders.Merchant_Id";
     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "Number of orders for a merchant",
			        "xAxisName" => "Merchant",
			        "yAxisName" => "Number of Orders",
			        "rotatevalues" => "0",
			        "theme" => "zune",
			        "decimals" => "0",
			        "numDivLines"=> "5",
			        "yAxisMaxvalue" => "8" ,
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
              	"label" => $row['merchant_name'],
              	"value" => $row['count(Order_status)']
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("column2D", "Chart2" , 600, 300, "chart-2", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}

  	?>


   </body>

</html>