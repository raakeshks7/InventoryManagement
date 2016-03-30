<?php
include('../config.php');

$query="SELECT outlet.outlet_name as OutletName, item.item_name as ItemName, SUM(sales.Item_Count) as TotalItems,
        SUM(sales.Dollar_Amount*sales.`Item_Count`) as TotalSales, cal.CYear as CalendarYear, 
        cal.Quarter, cal.Month, cal.DayOfTheWeek
        FROM `sales_fact_table` sales ,`calendar_dimension` cal, `item_dimension` item,
        `outlet_dimension` outlet
        WHERE sales.Calendar_Key = cal.Calendar_Key
        AND sales.Item_Key = item.Item_Key
        AND sales.Outlet_Key = outlet.Outlet_Key
        GROUP BY outlet.outlet_name, item.item_name, cal.CYear";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}
# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;
?>
