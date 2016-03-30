<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
		
    </head>
    <body>
        <?php
        echo "<table style='border: solid 1px black;'>";
		$zoneName = filter_input(INPUT_GET, "zoneName");
		$zoneAddress = filter_input(INPUT_GET, "zoneAddress");
		try {
                include_once 'dbconfig.php';
                
                //Prepare SQL Query based on Form Input
                $query = "INSERT INTO zone(Zone_Name,Zone_Address) VALUES ('$zoneName','$zoneAddress')";
				                          
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
						
						
				header("Location: zone.php"); 
			}
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }        
        echo "</table>";
        ?>
    </body>
</html>