<?php 
	session_start();
	include_once("db_connect.php");
	//user inputs 
	$items = array("s_clothes" => "Clothes(S)",
					"l_clothes" => "Clothes(L)",
					"utensils" => "Utensils",
					"stationeries" => "Stationeries",
					"blankets" => "Blankets",
					"others" => "Others"
				 );
	$consignments = array();
	$keys = array_keys($items);
	for($i = 0; $i < count($keys); $i++)
	{

		if(isset($_POST[$keys[$i]]) && $_POST[$keys[$i]] > 0)
		{
			$quantity = $_POST[$keys[$i]];
			$item = $items[$keys[$i]];
			$temp = $keys[$i] . "_name";
			if(isset($_POST[$temp]))
			{
				$ngo_id = $_POST[$temp];
			}
			$arr = array();
			array_push($arr,$item,$quantity,$ngo_id);
			array_push($consignments,$arr);
		}
	}
	$_SESSION['cart'] = $consignments;
	header('Location: ../checkout.html');
?>