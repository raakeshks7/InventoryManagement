<?php
//Delete Condition
if(isset($_GET['delete_id']))
{
 include_once 'dbconfig.php';
 $query="DELETE FROM item WHERE Item_Id=".$_GET['delete_id'];
 $ps = $con->prepare($query);
 $ps->execute();
 header("Location: $_SERVER[PHP_SELF]");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Items</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="table.css" type="text/css"/>
<script type="text/javascript">
function edt_id(id)
{
 if(confirm('Sure to edit ?'))
 {
  window.location.href='item_update_o.php?edit_id='+id;
 }
}
function delete_id(id)
{
 if(confirm('Sure to Delete ?'))
 {
  window.location.href='item_o.php?delete_id='+id;
 }
}
</script>
</head>
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
<h3>Item Details</h3>
<?php
    echo "<table class=\"center\">";
	
    try {
                // Connect to the database.
                include_once 'dbconfig.php';
                
                //Prepare SQL Query based on Form Input
                $query = "SELECT Item_Id as 'Item Id',Item_Name as 'Item Name',Item_Price as 'Item Price', Item_Count as 'Item Count', Item_Category as 'Item Category',Outlet_Id as 'Outlet Id' from item";
                               
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetchAll(PDO::FETCH_ASSOC);
                
                // Construct the HTML table row by row.
                // Start with a header row.
                $doHeader = true;
                foreach ($data as $row) {

                    // The header row before the first data row.
                    if ($doHeader) {
                        print "<tr>\n";
                        foreach ($row as $name => $value) {
                            print "<th>$name</th>\n";
                        }
						print "<th colspan=2>Operations</th>";
                        print "</tr>\n";

                        $doHeader = false;
                    }
                        // Data row.
                        print "<tr>\n";
						$count=0;
						$a;
                        foreach ($row as $name => $value) {
							if($count==0)
							{
								$a=$value;
							}
							$count++;
                            print "<td>$value</td>\n";
				                     	
                        }
						$count=0;
					print "<td><a href=\"javascript:edt_id($a)\" class=\"btn btn-link\" role=\"button\">Update</a></td>";
					print "<td><a href =\"javascript:delete_id($a)\" class=\"btn btn-link\" role=\"button\"> Delete </a></td>";
					print "</tr>\n";
                }
            }
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }   
          
        echo "<br><tr><td colspan=9><a href=item_add_o.php class=\"btn btn-info\" role=\"button\">Add New</a></td></tr>";
		echo "</table>";
        ?>
		</div>
    </body>
</html>