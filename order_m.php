<?php
//Delete Condition
if(isset($_GET['delete_id']))
{
 include_once 'dbcon.php';
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
  window.location.href='order_m_update.php?edit_id='+id;
 }
}
function delete_id(id)
{
 if(confirm('Sure to Delete ?'))
 {
  window.location.href='order_m.php?delete_id='+id;
 }
}
</script>
</head>

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
<div class='jumbotron'>
<center>
<br>
<h3>ORDER DETAILS</h3> </center>
<br>
<?php
        $uname = filter_input(INPUT_GET, "username");
        $pwd  = filter_input(INPUT_GET, "password");
     
      echo  "<table class=\"center\">";
	
        
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
            $query = "SELECT O.Order_Id,Ot.Outlet_Name,O.Order_Status,O.Timestamp FROM orders O,Outlet ot 
                        WHERE ot.Outlet_Id=O.outlet_Id
                        AND O.Merchant_id = (SELECT Merchant_Id FROM merchant
                        WHERE username='$uname' AND pwd='$pwd') AND Merchant_Id='$Order_Id'";
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