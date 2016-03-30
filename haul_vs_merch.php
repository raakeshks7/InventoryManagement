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
$strQuery3 = "SELECT Merchant_Name, count(Merchant_Name) FROM `merchant`, hauling_company where hauling_company.Merchant_Id = merchant.Merchant_Id group by Merchant_Name";
     	// Execute the query, or else return the error message.
     	$result3 = $dbhandle->query($strQuery3) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
     	
     	// If the query returns a valid response, prepare the JSON string
     	if ($result3) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData3 = array(
        	    
    "chart"=>array(
        "caption" => "Hauling companies used by Merchants",
        "paletteColors" =>"#0075c2,#1aaf5d,#f45b00,#8e0000",
        "bgColor" => "#ffffff",
        "showBorder" => "0",
        "use3DLighting" => "1",
        "showShadow"=> "0",
        "enableSmartLabels"=> "0",
        "startingAngle" => "310",
        "showLabels" => "0",
        "showPercentValues" => "1",
        "showLegend" => "1",
        "legendShadow" => "0",
        "legendBorderAlpha" => "0",
        "decimals" => "0",
        "captionFontSize" => "14",
        "subcaptionFontSize" => "14",
        "subcaptionFontBold"=> "0",
        "toolTipColor"=> "#ffffff",
        "toolTipBorderThickness" => "0",
        "toolTipBgColor" => "#000000",
        "toolTipBgAlpha" => "80",
        "toolTipBorderRadius" => "2",
        "toolTipPadding" => "5",
        "useDataPlotColorForLabels" => "1"
    ),
);
           

        	$arrData3["data"] = array();

	// Push the data into the array
        	while($row3 = mysqli_fetch_array($result3)) {
           	array_push($arrData3["data"], array(
              	"label" => $row3['Merchant_Name'],
              	"value" => $row3['count(Merchant_Name)']
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData3 = json_encode($arrData3);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$doChart3 = new FusionCharts("Doughnut3D", "Chart3" , 600, 300, "chart-3", "json", $jsonEncodedData3);

        	// Render the chart
        	$doChart3->render();

        	// Close the database connection
        	$dbhandle->close();
     	}

  	?>
<div id="chart-3"></div>
            
   </body>

</html>