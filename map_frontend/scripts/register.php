<?php
	
	// Script to create a new user using post data
	// sets $success to true if user was successfully created

	include("config.php");
	session_start();
	$success=false;
	$error="";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	    $myname=mysqli_real_escape_string($db,$_POST['name']);
	    $mypassword=mysqli_real_escape_string($db,$_POST['password']); 
	    $myemail=mysqli_real_escape_string($db,$_POST['email']); 

		$sql="INSERT INTO `Users`(`name`, `password`, `email`) " .
			 "VALUES ('$myname', '$mypassword', '$myemail')";
	    $result=mysqli_query($db,$sql);

	    if ($result === false)
	    {
	    	$success = false;
	    	$error="Unable to register user";
	    }
	    else
	    {
	    	$_SESSION["login_user"]=$db->insert_id;
	    	$success = true;
	    }
	}

?>