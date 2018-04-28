<?php
	session_start();
	include_once("db_connect.php");
	$id = $_SESSION["id"]; 
	$cdate = date("Y/m/d");
	$sql_query = "INSERT INTO `orders`(`id`, `contributor_id`, `volunteer_id`, `order_date`) VALUES (NULL,'$id',NULL,'$cdate')";
	$results = mysqli_query($connection,$sql_query) or die ("Error: " . mysqli_error());
	$order_id = mysqli_insert_id($connection);
	$cart = $_SESSION['cart'];
	for($i = 0; $i < count($cart); $i++)
	{
		$item = $cart[$i][0];
		$quantity = $cart[$i][1];
		$ngo_id = $cart[$i][2];
		$sql_query = "INSERT INTO `consignments`(`id`, `item`, `quantity`, `ngo_id`, `order_id`) VALUES (NULL,'$item','$quantity','$ngo_id','$order_id')";
		$results = mysqli_query($connection,$sql_query) or die ("Error: " . mysqli_error());
	}
	mysqli_close($connection); 
 ?>