<?php
	
	// Script to create a new organization using post data
	// sets $success to true if organization was successfully created

	$error="";
	$orgid=-1;

	include("config.php");
	session_start();
	$success=false;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	    $orgname=mysqli_real_escape_string($db,$_POST['name']);
	    $orgemail=mysqli_real_escape_string($db,$_POST['email']);
	    $orgpassword=mysqli_real_escape_string($db,$_POST['password']);

		$sql="INSERT INTO `Organizations`(`name`, `email`, `password`) " .
			 "VALUES ('$orgname', '$orgemail', '$orgpassword')";
	    $result=mysqli_query($db,$sql);

	    if ($result === false)
	    {
	    	$success = false;
	    	$error="Unable to register organization";
	    }
	    else
	    {
	    	$_SESSION["org_user"]=$db->insert_id;
	    	$success = true;
	    }
	}
?>