
<!DOCTYPE html>
<html>
<head>
        <title>Update Item</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="table.css" type="text/css"/>
				<script>
		function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
    </head>
<?php
include_once 'dbconfig.php';
if(isset($_GET['edit_id'])) 
{
 $query="SELECT * FROM item WHERE Item_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute();
 $data= $ps->fetch();

}
if(isset($_POST['btn-update']))
{
 // variables for input data
 $itemName = $_POST['itemName'];
 $itemCategory = $_POST['itemCategory']; 
  $itemPrice = $_POST['itemPrice'];
  $itemCount = $_POST['itemCount']; 
  $outletId = $_POST['outletId']; 
 // sql query for update data into database
 $query = "UPDATE item SET Item_Name='$itemName',Item_Category='$itemCategory',Item_Price='$itemPrice',Item_Count='$itemCount',Outlet_Id='$outletId' WHERE Item_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute(); 
header("Location: item_o.php"); 
} 
?>
  
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="dashboard.php">DATA CRUNCHERS</a>
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
    <body style = "background-color:#eee">
<center>
<div class='container'>
<br>
<br>
<br>
        <form method="post">
		   <fieldset>
            <legend>Update Item</legend>
            <p>
                <label>Item Name:</label>
                <input name="itemName" value="<?php echo $data['Item_Name']; ?>" type="text" />
            </p>
			<p>
               <label>Item Category:</label>
			    <input name="itemCategory" value="<?php echo $data['Item_Category']; ?>" type="text" />
			</p>
			<p>
			<label>Item Price:</label>
			    <input name="itemPrice" value="<?php echo $data['Item_Price']; ?>" onkeypress="return isNumber(event)" type="text" />
			</p>
			<p>
			<label>Item Count:</label>
			    <input name="itemCount" value="<?php echo $data['Item_Count']; ?>" onkeypress="return isNumber(event)" type="text" />
			</p>
			
               
            <p>
               <label>Outlet ID:</label>
			   
               <select name="outletId" >
				<option selected> <?php echo $data['Outlet_Id']; ?></option>
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT Outlet_Id from outlet';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data1= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data1 as $row) {
				if($row['Outlet_Id']!=$data['Outlet_Id'])
				echo "<option>" . $row['Outlet_Id'] . "</option>";
				
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