
<!DOCTYPE html>
<html>
<head>
        <title>Add Outlet</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<?php
include_once 'dbconfig.php';
if(isset($_GET['edit_id'])) 
{
 $query="SELECT * FROM outlet WHERE Outlet_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute();
 $data= $ps->fetch();

}
if(isset($_POST['btn-update']))
{
 // variables for input data
 $outletName = $_POST['outletName'];
 $zoneId = $_POST['zoneId']; 
 // sql query for update data into database
 $query = "UPDATE outlet SET Outlet_Name='$outletName',Zone_Id='$zoneId' WHERE Outlet_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute(); 
header("Location: outlet.php"); 
} 
?>
  
    <body>
        <form method="post">
		   <fieldset>
            <legend>Add Outlet</legend>
            <p>
                <label>Outlet Name:</label>
                <input name="outletName" value="<?php echo $data['Outlet_Name']; ?>" type="text" />
            </p>
            <p>
               <label>Zone ID:</label>
			   
               <select name="zoneId" >
				<option selected> <?php echo $data['Zone_Id']; ?></option>
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT Zone_Id from zone';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data1= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data1 as $row) {
				if($row['Zone_Id']!=$data['Zone_Id'])
				echo "<option>" . $row['Zone_Id'] . "</option>";
				
				}
				?>
				</select>
            </p>
			<p>
                <input type="Submit" name="btn-update" value="Submit" />
            </p>
			 </fieldset>
    </form>

    </body>
</html>       