<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
		
    </head>
    <body>
        <?php
        echo "<table style='border: solid 1px black;'>";
        $itemName  = filter_input(INPUT_GET, "itemName");
		$itemCategory = filter_input(INPUT_GET, "itemCategory");
		$itemCount = filter_input(INPUT_GET, "itemCount");
		$itemPrice = filter_input(INPUT_GET, "itemPrice");
		$outletId = filter_input(INPUT_GET, "outletId");
		try {
                include_once 'dbconfig.php';
                
                //Prepare SQL Query based on Form Input
                $query = "INSERT INTO Item(Item_Price,Item_Name,Item_Count,Item_Category,Outlet_Id) VALUES ('$itemPrice','$itemName','$itemCount','$itemCategory','$outletId')";
				                          
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
						
						
				header("Location: Item_o.php"); 
			}
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }        
        echo "</table>";
        ?>
    </body>
</html>