<!DOCTYPE html>
<html>
    <head>
        <title>Add Outlet</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="outlet_add_db.php"
          method="get">
		   <fieldset>
            <legend>Add Outlet</legend>
            <p>
                <label>Outlet Name:</label>
                <input name="outletName" type="text" required/>
            </p>
            <p>
               <label>Zone ID:</label>
               <select name="zoneId" required> 
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
                <input type="Submit" value="Submit" />
            </p>
			 </fieldset>
    </form>

    </body>
</html>

            