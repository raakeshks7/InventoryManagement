
<!DOCTYPE html>
<html>
<head>
        <title>Update Zone</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<?php
include_once 'dbconfig.php';
if(isset($_GET['edit_id'])) 
{
 $query="SELECT * FROM zone WHERE Zone_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute();
 $data= $ps->fetch();

}
if(isset($_POST['btn-update']))
{
 // variables for input data
 $zoneName = $_POST['zoneName'];
 $zoneId = $_POST['zoneId']; 
  $zoneAddress = $_POST['zoneAddress'];
 // sql query for update data into database
 $query = "UPDATE zone SET Zone_Name='$zoneName',Zone_Id='$zoneId',Zone_Address='$zoneAddress' WHERE Zone_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute(); 
header("Location: zone.php"); 
} 
?>
	<body>
        <form method="post">
		   <fieldset>
            <legend>Add Outlet</legend>
            <p>
                <label>Zone Id:</label>
                <input name="zoneId" value="<?php echo $data['Zone_Id']; ?>" type="text" />
            </p>
			 <p>
                <label>Zone Name:</label>
                <input name="zoneName" value="<?php echo $data['Zone_Name']; ?>" type="text" />
            </p>
			 <p>
                <label>Zone Address</label>
                <input name="zoneAddress" value="<?php echo $data['Zone_Address']; ?>" type="text" />
            </p>
            
			<p>
                <input type="Submit" name="btn-update" value="Submit" />
            </p>
			 </fieldset>
    </form>

    </body>
</html>       