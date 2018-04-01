<?php

	header("Access-Control-Allow-Origin: *");
	
	include("session.php");
	if (!$success)
	{
		header("Location: /login.php");
	}

	if (!isset($_GET["id"]))
	{
		echo "-1";
	}
	else
	{
		include("config.php");
		$id = mysqli_real_escape_string($db, $_GET["id"]);
		$userid = $_SESSION["login_user"];
		$sql="SELECT users FROM Events WHERE id='$id'";
		$result=mysqli_query($db, $sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC)["users"];

		$units = explode(",", $row);
		$flag = true;
		foreach ($units as $unit)
		{
			if ($unit == $userid)
			{
				echo "-1";
				$flag = false;
			}
		}

		if ($flag)
		{
			if (strlen($row) != 0 && substr($row, -1) != ",")
			{
				$row = $row . ",";
			}
			$row = $row . $userid;
			$sql="UPDATE Events SET users='$row' WHERE id='$id'";
			mysqli_query($db, $sql);

			$sql="SELECT events FROM Users WHERE id='$userid'";
			$result=mysqli_query($db, $sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC)["events"];
			if (strlen($row) != 0 && substr($row, -1) != ",")
			{
				$row = $row . ",";
			}
			$row = $row . $id;
			$sql="UPDATE Users SET events='$row' WHERE id='$userid'";
			mysqli_query($db, $sql);
		}
	}

?>