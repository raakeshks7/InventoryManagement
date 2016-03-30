<?php
include("fusioncharts.php");
$con=mysql_connect("localhost","root","root") or die("Failed to connect with database!!!!");
mysql_select_db("outlet_management", $con);
$sth = mysql_query("SELECT Zone_Name, Count(Outlet_Name) as Outlet_Count from outlet INNER JOIN zone ON outlet.Zone_Id = zone.Zone_Id group by Zone_Name");
 
$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(
 
    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Zone_Name', 'type' => 'string'),
    array('label' => 'Outlet_Count', 'type' => 'number')
 
);
 
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $r['Zone_Name']); 
 
    // Values of each slice
    $temp[] = array('v' => (int) $r['Outlet_Count']);
    $rows[] = array('c' => $temp);
}
 
$table['rows'] = $rows;
$jsonTable = json_encode($table);
//echo $jsonTable;
?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
   <!-- Tab Icons -->
    <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>
    <script src="js/fusioncharts.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
 
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
 
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
 
    function drawChart() {
 
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
           title: 'Number of Outlets by Zone',
          is3D: 'true',
          width: 600,
          height: 500
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
    
  </head>

  <body>
<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="">DATA CRUNCHERS</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-right" action="index.html" >;
                  <button type="submit" class="btn btn-info">Log Out</button>;
                </form>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

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
    <?php require 'testg.php';     ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">Dashboard <span class="sr-only">(current)</span></a></li>
            
                    <li>
                        <a href=outlet.php>Outlet Management</a>
                    </li>
                    <li>
                        <a href=zone.php>Zone Management</a>
                    </li>
                    <li>
                        <a href=orders.php>Place Order</a>
                    </li>
                    <li>
                        <a href=item_o.php>View/Edit Items</a>
                    </li>
                    <li>
                        <a href="View_Orders.html">View Orders</a>
                    </li>
                    <li>
                        <a href="View_Sales.html">View Sales</a>
                    </li>
          </ul>
<!--         <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul> --> 
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
          <div class='container'>
              <div id="first" style="padding-top: 1.5cm" >
              <p style="font-weight: bold;">Drill down column chart</p>
              <div id="chart-1"></div>
              </div>
              <div id="second">
              <div id="chart_div"></div>
              </div>
              <div id="clear"></div>
          </div>
          <div class='container'>
              <div id="first">
              <div id="chart-2" style="text-align:left"><!-- Fusion Charts will render here--></div>
              </div>
              <div id="second">
              <?php require 'haul_vs_merch.php';   ?></div>
              <div id="clear"></div>
          </div>
          <div class='container'>
              <div id="first">
              <?php  require 'hauling_outlet.php';   ?></div>
              <div id="second">
              
              <?php require 'Sales.php'; ?>

              </div>
              <div id="clear"></div>
          </div>          



          </div>

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="./js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>