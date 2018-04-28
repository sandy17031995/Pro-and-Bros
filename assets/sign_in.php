<?php
	session_start();
	include_once("db_connect.php");
	//user inputs 
	$username = $_POST["username"];
	$password = $_POST["password"];

	// Code to prevent MySql Injection



	//validating inputs with database credentials
	$sql_query = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password' ";
	$results = mysqli_query($connection,$sql_query) or die ("Error : " . mysqli_error());
	if (mysqli_num_rows($results) > 0) 
	{
		$row = mysqli_fetch_array($results,MYSQLI_ASSOC);
		$_SESSION["username"] = $username;
		$_SESSION["role"] = $row["role"];
		if($_SESSION["role"] === "contributor"){
			$query = "SELECT * FROM `contributors` WHERE `username` = '$username'";
			$res = mysqli_query($connection,$query) or die ("Error : " . mysqli_error());
			$data = mysqli_fetch_array($res,MYSQLI_ASSOC);
			$_SESSION["id"] = $data["id"];
			header('Location: ../cart.html?login_success = 1');
		}	
	} 
	else 
	{
		echo "<script type='text/javascript'>alert('Email or password is incorrect!');</script>";
		header('Location: ../login.html');
	}	
	mysqli_close($connection); 
 ?>