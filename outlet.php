<?php
//Delete Condition
if(isset($_GET['delete_id']))
{
 include_once 'dbconfig.php';
 $query="DELETE FROM outlet WHERE Outlet_Id=".$_GET['delete_id'];
 $ps = $con->prepare($query);
 $ps->execute();
 header("Location: $_SERVER[PHP_SELF]");
}
?>
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
	<script type="text/javascript">
		function edt_id(id)
		{
		 if(confirm('Sure to edit ?'))
		 {
		  window.location.href='outlet_update.php?edit_id='+id;
		 }
		}
		function delete_id(id)
		{
		 if(confirm('Sure to Delete ?'))
		 {
		  window.location.href='outlet.php?delete_id='+id;
		 }
		}
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

<body style = "">
    <!-- /navigation -->

      <div class="wrapper quick-links">
        <div class="container quick-links">
		<div class="container-fluid">

          <h4 class="page-titles">Outlet Management</h4>
				
			<?php
			echo "<table class=\"table table-bordered\">";

			class Outlet{
				private $Outlet_Id;
				private $Outlet_Name;
				private $OwnerID;
				private $Zone_Id;
				
				public function getOutlet_Id()     { return $this->Outlet_Id; }
				public function getOutletName()     { return $this->Outlet_Name; }
				public function getOwnerID()     { return $this->OwnerID; }
				public function getZoneId()     { return $this->Zone_Id; }
				
			}
			try {
					 // Connect to the database.
					 include_once 'dbconfig.php';
						
					 //Prepare SQL Query based on Form Input
					$query = 'SELECT * from outlet';
					 

					// Fetch the database field names.
					$result = $con->query($query);
					$row = $result->fetch(PDO::FETCH_ASSOC);
					
					// Construct the header row of the HTML table.
					print "            <tr>\n";
					foreach ($row as $field => $value) {
							print "                <th>$field</th>\n";
					}
					print "<th colspan=2>Operations</th>\n";
					print "            </tr>\n";
					
					$ps = $con->prepare($query);
					// Fetch the matching database table rows.
					$ps->execute();
					$ps->setFetchMode(PDO::FETCH_CLASS, "Outlet");
					
					// Construct the HTML table row by row.
					function createTableRow(Outlet $p)
					{
						$count=0;
						$a;
						if($count==0)
						{
							$a=$p->getOutlet_Id();
						}
						$count++;
						print "        <tr>\n";
						print "            <td>" . $p->getOutlet_Id()     . "</td>\n";
						print "            <td>" . $p->getOutletName()  . "</td>\n";
						print "            <td>" . $p->getOwnerID()   . "</td>\n";
						print "            <td>" . $p->getZoneId() . "</td>\n";
						print "<td><a href=\"javascript:edt_id($a)\" class=\"btn-link\" role=\"button\" >Update</a></td>";
						print "<td><a href =\"javascript:delete_id($a)\" class=\"btn-link\" role=\"button\"> Delete </a></td>";
						print "        </tr>\n";
					}
					// Construct the HTML table row by row.
					while ($outlet = $ps->fetch()) {
						print "        <tr>\n";
						createTableRow($outlet);
						print "        </tr>\n";
					}
					}
					catch(PDOException $ex) {
						echo 'ERROR: '.$ex->getMessage();
					}        
				
				echo "<tr><td colspan=6><a href=outlet_add.php class=\"btn btn-info\" role=\"button\">Add New</a></td></tr>";
				echo "</table>";
				?>
	
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
