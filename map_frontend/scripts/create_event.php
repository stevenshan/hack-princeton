<?php

	$error="";
	$orgid=-1;

	include("organization_session.php");

	if (!$success)
	{
		$error="Must be logged in as organization to create event";
	}
	else
	{
		include("config.php");
		session_start();
		$success=false;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
		    $eventname=mysqli_real_escape_string($db,$_POST['name']);
		    $eventdate=mysqli_real_escape_string($db,$_POST['date']);
		    $eventorg=$_SESSION["org_user"];

			$sql="INSERT INTO `Events`(`name`, `date`, `organization`) " .
				 "VALUES ('$eventname', '$eventdate', '$eventorg')";
		    $result=mysqli_query($db,$sql);
		    echo mysqli_error($db);

		    if ($result === false)
		    {
		    	$success = false;
		    	$error="Unable to register event";
		    }
		    else
		    {
		    	$success = true;
		    }
		}
	}
?>