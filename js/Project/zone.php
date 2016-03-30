<?php
//Delete Condition
if(isset($_GET['delete_id']))
{
 include_once 'dbconfig.php';
 $query="DELETE FROM zone WHERE Zone_Id=".$_GET['delete_id'];
 $ps = $con->prepare($query);
 $ps->execute();
 header("Location: $_SERVER[PHP_SELF]");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="table.css" type="text/css"/>
<script type="text/javascript">
function edt_id(id)
{
 if(confirm('Sure to edit ?'))
 {
  window.location.href='zone_update.php?edit_id='+id;
 }
}
function delete_id(id)
{
 if(confirm('Sure to Delete ?'))
 {
  window.location.href='zone.php?delete_id='+id;
 }
}
</script>
</head>
<body>
<?php
    echo "<table class=\"center\">";
	echo "<caption>Zone Details</caption>";
    try {
                // Connect to the database.
                include_once 'dbconfig.php';
                
                //Prepare SQL Query based on Form Input
                $query = 'SELECT * from zone';
                               
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
					print "<td><a href=\"javascript:edt_id($a)\">Update</a></td>";
					print "<td><a href =\"javascript:delete_id($a)\"> Delete </a></td>";
					print "</tr>\n";
                }
            }
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }        
        echo "<tr><td colspan=5><a href=zone_add.php>Add New</a></td></tr>";
		echo "</table>";
        ?>
    </body>
</html>