<html>
   <head>
    <title>FusionCharts XT - Column 2D Chart - Data from a database</title>

    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->

    <script src="js/fusioncharts.js"></script>
  </head>

   <body>
  <?php require 'dbconn.php'; ?> 
  	<?php

     	// Form the SQL query that returns the top 10 most populous countries
     	$strQuery = "SELECT outlet.outlet_name as Outlet_Name, 
                    SUM(sales.Dollar_Amount*sales.`Item_Count`) as Total_Sales
                    FROM `sales_fact_table` sales ,`calendar_dimension` cal, `outlet_dimension` outlet
                    WHERE sales.Calendar_Key = cal.Calendar_Key
                    AND sales.Outlet_Key = outlet.Outlet_Key
                    GROUP BY outlet.outlet_name";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
                    "caption" => "Sales of all the Outlets",
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
                "label" => $row["Outlet_Name"],
                "value" => $row["Total_Sales"],
                "link" => "Sales_drill.php?outlet_name=".$row["Outlet_Name"]
              	)
              	//print $row["outlet_name"];
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$colChart = new FusionCharts("column2D", "Chart5" , 600, 300, "chart-5", "json", $jsonEncodedData);

        	// Render the chart
        	$colChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}

  	?>
  	<div id="chart-5"><!-- Fusion Charts will render here--></div>
   </body>
</html>