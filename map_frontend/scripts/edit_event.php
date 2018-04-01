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
		    $eventid=mysqli_real_escape_string($db,$_POST['id']);

		    $raw_data["start"] = mysqli_real_escape_string($db, $_POST["start"]);
		    $raw_data["end"] = mysqli_real_escape_string($db, $_POST["end"]);
		    $raw_data["description"] = mysqli_real_escape_string($db, $_POST["description"]);
		    $raw_data["lat"] = mysqli_real_escape_string($db, $_POST["lat"]);
		    $raw_data["long"] = mysqli_real_escape_string($db, $_POST["long"]);
		    $raw_data["location"] = mysqli_real_escape_string($db, $_POST["location"]);
		    $raw_data["category"] = mysqli_real_escape_string($db, $_POST["tag"]);
		    $raw_data=json_encode($raw_data);
		    $data=mysqli_real_escape_string($db, $raw_data);

			$sql="UPDATE `Events` SET `name`='$eventname', `date`='$eventdate', `data`='$data' WHERE id='$eventid'";
		    $result=mysqli_query($db,$sql);

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