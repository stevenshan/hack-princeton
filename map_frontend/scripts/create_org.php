<?php
	
	// Script to create a new organization using post data
	// sets $success to true if organization was successfully created

	$error="";
	$orgid=-1;

	// make sure user is logged in
	include("session.php");
	if (!$success)
	{
		$error="You must be logged in to create an organization";
	}
	else
	{
		include("config.php");
		session_start();
		$success=false;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
		    $orgname=mysqli_real_escape_string($db,$_POST['name']);
		    $orgowner=$_SESSION["login_user"];

			$sql="INSERT INTO `Organizations`(`name`, `owner`) " .
				 "VALUES ('$orgname', '$orgowner')";
		    $result=mysqli_query($db,$sql);

		    if ($result === false)
		    {
		    	$success = false;
		    	$error="Unable to register organization";
		    }
		    else
		    {
		    	$orgid=$db->insert_id;
		    	$sql="SELECT organizations FROM Users WHERE id='$orgowner'";
		    	$result=mysqli_query($db, $sql);
		    	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		    	$new_data=$row["organizations"];
		    	if ($new_data == "")
		    	{
		    		$new_data = $orgid;
		    	}
		    	else
		    	{
		    		$new_data = $new_data . "," . $orgid;
		    	}
		    	$sql = "UPDATE `Users` SET `organizations`='$new_data' WHERE id='$orgowner'";
		    	mysqli_query($db, $sql); 
		    	$success = true;
		    }
		}
	}
?>