<!DOCTYPE html>
<html>
    <head>
        <title>Add Zone</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Loading Bar Script -->
    <script type=text/javascript src="scripts/loading_bar_1.9.1_jquery.min.js"></script>
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
<center>
<br>
<br>
<br>
<br>
    <!-- /navigation -->
        <form action="item_add_db_o.php"
          method="get">
		   <fieldset>
            <legend>Add Item</legend>
			<p>
                <label>Item Name:</label>
                <input name="itemName" type="text" required/>
            </p>
            <p>
                <label>Item Category</label>
                <input name="itemCategory" type="text" required/>
            </p>
			<p>
                <label>Item Count:</label>
                <input name="itemCount" type="text" onkeypress="return isNumber(event)" required/>
            </p>
			<p>
                <label>Item Price:</label>
                <input name="itemPrice" type="text" onkeypress="return isNumber(event)" required/>
            </p>
			<p>
                <label>Outlet ID:</label>
               <select name="outletId" required> 
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT Outlet_Id from outlet';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $row) {
				echo "<option>" . $row['Outlet_Id'] . "</option>";
				print_r($row);
				}
				?>
				</select>
            </p>
			<p>
                <input type="Submit" value="Submit" />
            </p>
			 </fieldset>
    </form>

    </body>
</html>

            