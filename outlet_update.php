
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Outlet Home</title>

    <!-- Tab Icons -->
    <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Loading Bar Script -->
    <script type=text/javascript src="scripts/loading_bar_1.9.1_jquery.min.js"></script>
    <script>
    $(window).load(function() {
    	$(".loader").fadeOut("slow");
    })
    </script>

</head>
<body>

    <!-- Navigation -->
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
                  <button type="submit" class="btn btn-success">Log Out</button>;
                </form>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<body style = "background-color:#eee">
    <!-- /navigation -->
<center>
      <div class="wrapper quick-links">
        <div class="container quick-links">
		<div class="container-fluid">
          <h4 class="page-titles">Outlet Management</h4>
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
  
        <form method="post">
		   <fieldset>
            <legend>Update Outlet</legend>
            <p>
                <label>Outlet Name:</label>
                <input name="outletName" value="<?php echo $data['Outlet_Name']; ?>" type="text" required />
            </p>
			<p>
               <label>Owner ID:</label>
			   
               <select name="ownerId" >
				<option selected> <?php echo $data['OwnerID']; ?></option>
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT OwnerID from owner';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data1= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data1 as $row) {
				if($row['OwnerID']!=$data['OwnerID'])
				echo "<option>" . $row['OwnerID'] . "</option>";
				
				}
				?>
				</select>
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
                <input type="Submit" name="btn-update" class="btn btn-info" value="Submit" />
            </p>
			 </fieldset>
    </form>
</div>
        </div>
        
    
</center>

    <!-- jQuery -->
    <script src="scripts/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="scripts/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="scripts/jquery.easing.min.js"></script>
    <script src="cripts/classie.js"></script>
    <script src="scripts/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="scripts/agency.js"></script>


</body>
</html>