<?php
	$hostname = "localhost";
	$username = "root";
	$password = "pravin@123";
	$dbname = "sts_db";
	$connection = mysqli_connect($hostname,$username,$password,$dbname);
	if(! $connection) {
      die('Could not connect with database: ' . mysqli_error());
   }

   //Write function to prevent sql injection

 ?>