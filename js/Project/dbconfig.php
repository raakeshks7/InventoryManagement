<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "datacrunchers";
$con = new PDO("mysql:host=$host;dbname=$dbname",$user, $password);
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>