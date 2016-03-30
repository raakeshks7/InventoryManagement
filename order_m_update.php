
<!DOCTYPE html>
<html>
<head>
        <title>Add Outlet</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="table.css" type="text/css"/>
    </head>
<?php
include_once 'dbcon.php';
if(isset($_GET['edit_id'])) 
{
 $query="SELECT distinct(Order_Status) FROM orders WHERE Order_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute();
 $data= $ps->fetch();
}

if(isset($_POST['btn-update']))
{
 // variables for input data
 $Order_Status = $_POST['Order_Status'];
 // sql query for update data into database
 $query = "UPDATE orders SET Order_Status='$Order_Status' WHERE Order_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute(); 
header("Location: order_m_after_update.php?edit_id=".$_GET['edit_id']); 
} 
?>
  
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">DATA CRUNCHERS</a>
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
                  <button type="submit" class="btn btn-success">Log Out</button>;
                </form>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <body style = "background-color:#eee">
<div class='jumbotron' >
<center>
<br>
<h3><b>ORDER DETAILS</b></h3> 
<br>
        <form method="post">
		   <fieldset>
            <legend><b>Update Order</b></legend>
            <p>
               <label>Order Id:</label>
			   
               <select name="Order_Id" >
				<option selected> <?php ?></option>
				<?php 
				
				include_once 'dbcon.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT Order_Id from orders where Order_Id='.$_GET['edit_id'];
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data1= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data1 as $row) {
				if($row['Order_Id']!=$data['Order_Id'])
				echo "<option>" . $row['Order_Id'] . "</option>";
				
				}
				?>
				</select>
            </p>
			<p>
               <label>Order Status:</label>
			   
               <select name="Order_Status" >
				<option selected> <?php ?></option>
				<?php 
				
				include_once 'dbcon.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT distinct(Order_Status) from orders';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data1= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data1 as $row) {
				if($row['Order_Status']!=$data['Order_Status'])
				echo "<option>" . $row['Order_Status'] . "</option>";
				
				}
				?>
				</select>
            </p>
               			<p>
                <input type="Submit" name="btn-update"  value="Submit" />
            </p>
			 </fieldset>
    </form>
</center>
    </body>
</html>       