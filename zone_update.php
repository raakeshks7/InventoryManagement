
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Zone Home</title>

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
                  <button type="submit" class="btn btn-info">Log Out</button>;
                </form>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<body style = "background-color:#eee">
    <!-- /navigation -->

      <div class="wrapper quick-links">
        <div class="container quick-links">
		<div class="container-fluid">
          <h4 class="page-titles">Zone Management</h4>
          <center>
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
  $zoneAddress = $_POST['zoneAddress'];
 // sql query for update data into database
 $query = "UPDATE zone SET Zone_Name='$zoneName',Zone_Address='$zoneAddress' WHERE Zone_Id=".$_GET['edit_id'];
 $ps = $con->prepare($query);
 $ps->execute(); 
header("Location: zone.php"); 
} 
?>
	
        <form method="post">
		   <fieldset>
            <legend>Update Zone</legend>
			 <p>
                <label>Zone Name:</label>
                <input name="zoneName" value="<?php echo $data['Zone_Name']; ?>" type="text" required/>
            </p>
			 <p>
                <label>Zone Address</label>
                <input name="zoneAddress" value="<?php echo $data['Zone_Address']; ?>" type="text" required/>
            </p>
            
			<p>
                <input type="Submit" name="btn-update" class="btn btn-info" value="Submit" />
            </p>
			 </fieldset>
    </form>

    </div>
        </div>
        
    
</div>


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