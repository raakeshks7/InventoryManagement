<!DOCTYPE html>
<html lang="en">

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
	<div class="loader"></div>

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
<center>
	<div class="wrapper quick-links">
        <div class="container quick-links">
		<div class="container-fluid">
          <h4 class="page-titles">Add Outlet</h4>
	
        <form action="outlet_add_db.php"
          method="get">
		   <fieldset>
            <legend>Add Outlet</legend>
            <p>
                <label>Outlet Name:</label>
                <input name="outletName" type="text" required/>
            </p>
			<p>
               <label>Owner ID:</label>
               <select name="ownerId" required> 
			   <option value="">Select Owner Id</option>
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT OwnerID from owner';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $row) {
				echo "<option>" . $row['OwnerID'] . "</option>";
				print_r($row);
				}
				?>
				</select>
            </p>
            <p>
               <label>Zone ID:</label>
               <select name="zoneId" required> 
			   <option value="">Select ZoneId</option>
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT Zone_Id from zone';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $row) {
				echo "<option>" . $row['Zone_Id'] . "</option>";
				print_r($row);
				}
				?>
				</select>
            </p>
			<p>
                <input type="Submit" class="btn btn-info" value="Submit" />
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

            