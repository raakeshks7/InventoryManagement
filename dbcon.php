<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "outlet_management";
$con = new PDO("mysql:host=$host;dbname=$dbname",$user, $password);
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>