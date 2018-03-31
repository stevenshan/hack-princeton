<?php

	header("Access-Control-Allow-Origin: *");

	// print data object of currently logged in user
	// prints "-1" if not logged in

	$flag = true;
	if (!isset($_GET["id"]) || $_GET["id"] == "")
	{
		include("organization_session.php");
		if (!$success)
		{
			$flag = false;
			echo "-1";
		}
		else
		{
			$id=$_SESSION["org_user"];
		}
	}
	else
	{
		$id=$_GET["id"];
	}

	if ($flag)
	{
		if (!isset($_GET["param"]) || $_GET["param"] == "")
		{
			include("config.php");

			$id = mysqli_real_escape_string($db, $id);

			$sql = "SELECT * FROM Organizations WHERE id='$id'";
			$result=mysqli_query($db, $sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

			echo json_encode($row);
		}
		else 
		{
			include("config.php");

			$param = mysqli_real_escape_string($db, $_GET["param"]);
			$flag=false;
			if ($param == "users")
			{
				$param = "owner, users";
				$flag=true;
			}
			$id = mysqli_real_escape_string($db, $id);

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
	}

?>