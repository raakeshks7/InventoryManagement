<?php
include('../config.php');

$query="SELECT Order_Id, outlet_name as OutletName, Merchant_Name as MerchantName, 
        COUNT(Order_ID) as ItemCount, SUM(orders_fact_table.Dollar_Amount*orders_fact_table.`Item_Count`) as OrderAmount, cal.CYear as CalendarYear
        FROM orders_fact_table, merchant_dimension, `calendar_dimension` cal, `outlet_dimension` as outlet 
        WHERE orders_fact_table.Calendar_Key = cal.Calendar_Key 
        AND orders_fact_table.Outlet_Key = outlet.Outlet_Key
        AND orders_fact_table.Merchant_Key = merchant_dimension.Mc_Key
        GROUP BY Order_ID";
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
