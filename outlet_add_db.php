<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
		
    </head>
    <body>
        <?php
        echo "<table style='border: solid 1px black;'>";
		$outletName = filter_input(INPUT_GET, "outletName");
		$zoneId  = filter_input(INPUT_GET, "zoneId");
        $ownerId  = filter_input(INPUT_GET, "ownerId");
		try {
                include_once 'dbconfig.php';
                
                //Prepare SQL Query based on Form Input
                $query = "INSERT INTO outlet(Outlet_Name, Zone_Id,ownerId) VALUES ('$outletName','$zoneId','$ownerId')";
				                          
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
						
						
				header("Location: outlet.php"); 
			}
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }        
        echo "</table>";
        ?>
    </body>
</html>