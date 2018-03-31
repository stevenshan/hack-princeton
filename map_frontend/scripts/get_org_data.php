<?php

	// print data object of currently logged in user
	// prints "-1" if not logged in

	include("session.php");

	if (!$success || !isset($_GET["param"]) || $_GET["param"] == "")
	{
		echo "-1";
	}
	else if (!isset($_GET["id"]) || $_GET["id"] == "")
	{
		echo "-1";
	}
	else
	{
		include("config.php");

		$myid = $_SESSION["login_user"];
		$param = mysqli_real_escape_string($db, $_GET["param"]);
		$flag=false;
		if ($param == "users")
		{
			$param = "owner, users";
			$flag=true;
		}
		$id = mysqli_real_escape_string($db, $_GET["id"]);

		$sql = "SELECT $param FROM Organizations WHERE id='$id'";
		$result=mysqli_query($db, $sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count=mysqli_num_rows($result);

		if($count != 1)
		{
			echo "-1";
		}
		else
		{
			if ($flag)
			{
				if ($row["users"] == "")
				{
					echo $row["owner"];
				}
				else
				{
					echo $row["owner"] . "," . $row["users"];
				}
			}
			else
			{
				echo $row[$param];
			}
		}
	}

?>