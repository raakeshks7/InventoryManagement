<!DOCTYPE html>
<html>
    <head>
        <title>Add Zone</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="zone_add_db.php"
          method="get">
		   <fieldset>
            <legend>Add Zone</legend>
			<p>
                <label>Zone Id:</label>
                <input name="zoneId" type="text" required/>
            </p>
            <p>
                <label>Zone Name:</label>
                <input name="zoneName" type="text" required/>
            </p>
            <p>
                <label>Zone Address:</label>
                <input name="zoneAddress" type="text" required/>
            </p>
			<p>
                <input type="Submit" value="Submit" />
            </p>
			 </fieldset>
    </form>

    </body>
</html>

            