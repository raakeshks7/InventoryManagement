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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="table.css" type="text/css"/>
<script type="text/javascript">
function edit_id(id)
{
 if(confirm('Sure to edit ?'))
 {
  window.location.href='outlet_update.php?edit_id='+id;
 }
}
</script>
</head>
<body>
<div class='container'>
<?php
        $uname = filter_input(INPUT_GET, "username");
        $pwd  = filter_input(INPUT_GET, "password");
     echo "<th><form class=\"navbar-form navbar-right\" action=\"signin.php\" method=\"get\"> ";
                echo "<button type=\"submit\" class=\"btn btn-success\">Log Out</button>";
                echo "</form>";
      echo  "<table class=\"center\">";
	echo "<caption>ORDER DETAILS</caption>";
        
     class Orders{
		private $Order_Id;
		private $Outlet_Name;
		private $Order_Status;
		private $Timestamp;
		
		public function getOrder_Id()     { return $this->Order_Id; }
		public function getOutlet_Name()     { return $this->Outlet_Name; }
		public function getOrder_Status()     { return $this->Order_Status; }
		public function getTimestamp()     { return $this->Timestamp; }
		
	}
        
    try {
             // Connect to the database.
             include_once 'dbconfig.php';
               $Order_Id = $_GET['edit_id'];
         
             //Prepare SQL Query based on Form Input
            $query = "SELECT O.Order_Id,Ot.Outlet_Name,O.Order_Status,O.Timestamp 
                        FROM orders O,Outlet ot 
                        WHERE ot.Outlet_Id=O.outlet_Id
                        AND O.Merchant_id = (SELECT Merchant_Id FROM merchant
                        WHERE Merchant_Id='$Order_Id')";
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
            $ps->setFetchMode(PDO::FETCH_CLASS, "Orders");
            
            // Construct the HTML table row by row.
            function createTableRow(Orders  $p)
			{
				$count=0;
				$a;
				if($count==0)
				{
					$a=$p->getOrder_Id();
				}
				$count++;
				print "        <tr>\n";
				print "            <td>" . $p->getOrder_Id()     . "</td>\n";
				print "            <td>" . $p->getOutlet_Name()  . "</td>\n";
				print "            <td>" . $p->getOrder_Status()   . "</td>\n";
				print "            <td>" . $p->getTimestamp() . "</td>\n";
				print "<td><a href=\"javascript:edit_id($a)\" class=\"btn btn-info\" role=\"button\">Update</a></td>";
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
            echo "</table>";
            
                        
        ?>
	</div>
    </body>
</html>