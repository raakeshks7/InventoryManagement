<?php
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