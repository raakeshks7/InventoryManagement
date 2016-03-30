<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orders Home</title>

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
<script>
$(function () {
    $('#btnAdd').click(function () {
        var num = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
            newNum = new Number(num + 1), // the numeric ID of the new input field being added
            newElem = $('#testingDiv' + num).clone().attr('id', 'testingDiv' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value

        newElem.find('.test-select').attr('id', 'ID' + newNum + '_select').attr('name', 'ID' + newNum + '_select').val('');
        newElem.find('.test-textarea').val('');
         // insert the new element after the last "duplicatable" input field
        $('#testingDiv' + num).after(newElem);
        // enable the "remove" button
        $('#btnDel').attr('disabled', false);
        // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
        if (newNum == 5) $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit");
    });

    $('#btnDel').click(function () {
        // confirmation
        if (confirm("Are you sure you wish to remove this section of the form? Any information it contains will be lost!")) {
            var num = $('.clonedInput').length;
            // how many "duplicatable" input fields we currently have
            $('#testingDiv' + num).slideUp('slow', function () {
                $(this).remove();
                // if only one element remains, disable the "remove" button
                if (num - 1 === 1) $('#btnDel').attr('disabled', true);
                // enable the "add" button
                $('#btnAdd').attr('disabled', false).prop('value', "[ + ] add to this form");
            });
        }
        return false;
        // remove the last element

        // enable the "add" button
        $('#btnAdd').attr('disabled', false);
    });

    $('#btnDel').attr('disabled', true);
});
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
<body style = "background-color:#eee">
<center>
    <!-- /navigation -->

      <div class="wrapper quick-links">
        <div class="container quick-links">
		<div class="container-fluid">
          <h4 class="page-titles">Order Management</h4>
<?php require("dbconfig.php"); 

if(isset($_POST['submit']))
{
    $item_vals =array();
	$item_count =array();
	$outlet_name=$_POST['outletName'];
	$merchant_name=$_POST['merchantName'];
    foreach($_POST["item"] as $key => $text_field)
    {
       	$item_vals[]=$text_field;

    }
    foreach($_POST["count"] as $key => $text_field2)
    {
	$item_count[]=$text_field2;
    }
				
				//Get the Merchant Id based on merchant name
                $query = "SELECT Merchant_Id from merchant where Merchant_Name='$merchant_name'";
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetch(PDO::FETCH_ASSOC);
				$merchant_id;
				foreach ($data as $row) {
				$merchant_id=$row;
				}
				
				//Get outlet id based on outlet name
                $query = "SELECT Outlet_Id from outlet where Outlet_Name='$outlet_name'";
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetch(PDO::FETCH_ASSOC);
				$outlet_id;
				foreach ($data as $row) {
				$outlet_id=$row;
				}
	
				//Prepare SQL Query based on Form Input
				$query = "INSERT INTO orders(Outlet_Id,Merchant_Id,Order_Status,Timestamp) VALUES ('$outlet_id','$merchant_id','New',now())";
										
				// Query the database.
				$ps = $con->prepare($query);
				$ps->execute();
				
				$Order_Id;
				
				//Get the order id for most recently inserted record
				$query="select Order_Id from orders order by Timestamp desc limit 1";
				// Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetch(PDO::FETCH_ASSOC);
				foreach ($data as $row) {
				$Order_Id=$row;
				}
	
    //Insert ordered items list into 'contains' table	
	for ($i = 0; $i < count($item_vals); ++$i) {
    //Prepare SQL Query based on Form Input
    $query = "INSERT INTO contains(Item_Id,Order_Id,No_Of_Items) select Item_Id,'$Order_Id','$item_count[$i]' from item where Item_Name='$item_vals[$i]'";
	$ps = $con->prepare($query);
    $ps->execute();
    }
	echo "<h4><strong>" . count($_POST['item']) . "</strong> Items added to your order</h4>";
}

    ?>

<body>
<form action="#" method="post">
<fieldset>
            <legend>Place Order</legend>
	<p>
               <label>Outlet Name:</label>
               <select name="outletName" required>
				<option value="">Select Outlet</option>
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT Outlet_Name from outlet';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $row) {
				echo "<option>" . $row['Outlet_Name'] . "</option>";
				print_r($row);
				}
				?>
				</select>
    </p>
			
	<p>
               <label>Merchant Name:</label>
               <select name="merchantName" required> 
			   <option value="">Select Merchant</option>
				<?php 
				
				include_once 'dbconfig.php';
				
				//Prepare SQL Query based on Form Input
                $query = 'SELECT Merchant_Name from merchant';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $row) {
				echo "<option>" . $row['Merchant_Name'] . "</option>";
				print_r($row);
				}
				?>
				</select>
            </p>

    <!--
    ########################################## -->
    <!-- START CLONED SECTION -->
    <!-- ########################################## -->
	<p><strong>Add Items:</strong></p>
 <div id="testingDiv1" class="clonedInput">

        <select name="item[]" id="select" required>
            <option value="">Select Item</option>
              <?php
                require_once("dbconfig.php");
                $query = 'SELECT * from item';
  
                // Query the database.
                $ps = $con->prepare($query);
                $ps->execute();
                $data= $ps->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $row) {
				echo "<option>" . $row['Item_Name'] . "</option>";
				}
                ?>

              </select>

        &nbsp &nbsp &nbsp &nbsp &nbsp<input id="textarea" name="count[]" class="test-textarea" type="text" placeholder="Item Count" required></input></br>
	</br>
    </div>
    <!--/clonedInput-->
    <!-- ########################################## -->
    <!-- END CLONED SECTION -->
    <!-- ########################################## -->
    <!-- ADD - DELETE BUTTONS -->
    <div id="add-del-buttons">
        <input type="button" id="btnAdd" class="btn" value="[ + ] add to this form">
        <input type="button" id="btnDel" class="btn" value="[ - ] remove the section above">
    </div></br>
    <!-- /ADD - DELETE BUTTONS -->
    <input type="submit" name="submit"class="btn btn-info" value="Place Order"/>
	</fieldset>
</form>
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
