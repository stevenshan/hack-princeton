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

		    $raw_data["start"] = mysqli_real_escape_string($db, $_POST["start"]);
		    $raw_data["end"] = mysqli_real_escape_string($db, $_POST["end"]);
		    $raw_data["description"] = mysqli_real_escape_string($db, $_POST["description"]);
		    $raw_data["lat"] = mysqli_real_escape_string($db, $_POST["lat"]);
		    $raw_data["long"] = mysqli_real_escape_string($db, $_POST["long"]);
		    $raw_data=json_encode($raw_data);
		    $data=mysqli_real_escape_string($db, $raw_data);

			$sql="INSERT INTO `Events`(`name`, `date`, `organization`, `data`) " .
				 "VALUES ('$eventname', '$eventdate', '$eventorg', '$data')";
		    $result=mysqli_query($db,$sql);

		    if ($result === false)
		    {
		    	$success = false;
		    	$error="Unable to register event";
		    }
		    else
		    {
		    	$last_id=$db->insert_id;
		    	$sql="SELECT events FROM `Organizations` WHERE id='$eventorg'";
		    	$result=mysqli_query($db,$sql);
		    	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		    	$new_events=$row["events"];
		    	if (strlen($new_events) == 0)
		    	{
		    		$new_events=$last_id;
		    	}
		    	else
		    	{
		    		$new_events=$new_events . "," . $last_id;
		    	}
		    	$sql="UPDATE `Organizations` SET events='$new_events' WHERE id='$eventorg'";
		    	mysqli_query($db,$sql);
		    	$success = true;
		    }
		}
	}
?>