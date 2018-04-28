<?php 
	include_once("db_connect.php");

	//code to prevent sql injection

	if(isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['security_question']) && isset($_POST['security_answer']))
	{
		$username = $_POST['email'];
		$mobile = $_POST['mobile'];
		$password = $_POST['password'];
		$security_question = $_POST['security_question'];
		$security_answer = $_POST['security_answer'];
	}
	$sql_query = "SELECT * FROM `users` WHERE username = '$username'" or die ("Error: " . mysqli_error());
	$results = mysqli_query($connection,$sql_query);
	if (mysqli_num_rows($results) === 0) 
	{
		if (isset($_POST['contributor'])) 
		{
	   		// contributor
	   		if(isset($_POST['full_name']) && isset($_POST['dob']))
	   		{
	   			$full_name = $_POST['full_name'];
	   			$dob = $_POST['dob'];
	   			$role = "contributor";
	   			$sql_query = "INSERT INTO `contributors`(`id`, `username`, `name`, `mobile`, `dob`, `password`, `squestion`, `sanswer`) VALUES  (NULL, '$username','$full_name','$mobile','$dob','$password','$security_question','$security_answer')";
	   		}
	    } 
	    elseif(isset($_POST['volunteer']))
	    {
	    	// volunteer
	    	if(isset($_POST['full_name']) && isset($_POST['dob']) && isset($_POST['volunteer_pic'])  && isset($_POST['address']))
	    	{
	    		$full_name = $_POST['full_name'];
	   			$dob = $_POST['dob'];
	   			$volunteer_pic = $_POST['volunteer_pic'];
	   			$address = $_POST['address'];
	   			$role = "volunteer";
	   			$sql_query = "INSERT INTO `volunteers`(`id`, `username`, `name`, `mobile`, `dob`, `password`, `squestion`, `sanswer`, `image`, `address`) VALUES (NULL, '$username','$full_name','$mobile','$dob','$password','$security_question','$security_answer','$volunteer_pic','$address')";
	    	}
	    }
	    else
	    {
	    	// ngo 
	    	if(isset($_POST['ngo_name']) && isset($_POST['district']) && isset($_POST['address']))
	    	{
	    		$ngo_name = $_POST['ngo_name'];
	   			$district = $_POST['district'];
	   			$address = $_POST['address'];
	   			$role = "ngo";
	   			$sql_query = "INSERT INTO `ngos`(`id`, `username`, `name`, `mobile`, `district`, `password`, `squestion`, `sanswer`, `address`) VALUES (NULL,'$username','$ngo_name','$mobile','$district','$password','$security_question','$security_answer','$address')";

	    	}
	    }
	    $results = mysqli_query($connection,$sql_query) or die ("Error: " . mysqli_error());
		$sql_query = "INSERT INTO `users`(`username`, `password`, `role`) VALUES ('$username','$password','$role')";
		$results = mysqli_query($connection,$sql_query) or die ("Error: " . mysqli_error());
		mysqli_close($connection);
		if ($results) 
		{
			echo "<script>alert('Account Created!!!')</script>";
			header('Location: ../login.html');	
		}
		else
		{
			echo "<script>alert('Something went wrong. Please try again.')</script>";
			header('Location: ../signup.html');	
		}
	} 
	else 
	{
		echo "<script>alert('Email-Id already exists!!!')</script>";
		header('Location: ../signup.html');
	}	 
?>