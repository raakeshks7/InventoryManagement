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

//the SQL query to be executed
$query = "SELECT HC_Name , count(HC_Name) 
          FROM hauling_company inner join outlet 
          where hauling_company.Outlet_Id = outlet.Outlet_Id 
          group by HC_Name";
//storing the result of the executed query
$result = $dbhandle->query($query);
//initialize the array to store the processed data
$jsonArray = array();
//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
  //Converting the results into an associative array

$arrData = array(
              
    "chart"=>array(
        "caption"=> "Hauling Comapnies Used by Outlets",
        "xAxisName"=> "Zone",
        "yAxisName"=> "Outlet Count",
        "rotatevalues"=> "1",
        "theme"=> "zune"
   ),
   );

$arrData["data"] = array();
    while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row['HC_Name'],
                "value" => $row['count(HC_Name)']
                )
            );
          }
}
        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

          $jsonEncodedData = json_encode($arrData);

  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

          $doChart = new FusionCharts("Line", "Chart4" , 600, 300, "chart-4", "json", $jsonEncodedData);

          // Render the chart
          $doChart->render();

          // Close the database connection
          $dbhandle->close();

    ?>

<div id="chart-4"></div>
            
   </body>

</html>