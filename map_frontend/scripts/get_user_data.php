<?php

	// print data object of currently logged in user
	// prints "-1" if not logged in

	include("session.php");

	if (!$success)
	{
		echo "-1";
	}
	else if (!isset($_GET["param"]) || $_GET["param"] == "")
	{
		include("config.php");

		$myid = $_SESSION["login_user"];

		$sql = "SELECT * FROM Users WHERE id='$myid'";
		$result=mysqli_query($db, $sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count=mysqli_num_rows($result);

		if($count != 1)
		{
			echo "-1";
		}
		else
		{
			unset($row["password"]);
			foreach ($row as $key => $value) {
			    if (is_null($value)) {
				 $row[$key] = "";
			    }
			}
			echo json_encode($row);
		}
	}
	else
	{
		include("config.php");

		$myid = $_SESSION["login_user"];
		$param = mysqli_real_escape_string($db, $_GET["param"]);

		if ($param == "password")
		{
			echo "-1";
		}
		else
		{
			$sql = "SELECT $param FROM Users WHERE id='$myid'";
			$result=mysqli_query($db, $sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

			$count=mysqli_num_rows($result);

			if($count != 1)
			{
				echo "-1";
			}
			else
			{
				foreach ($row as $key => $value) {
				    if (is_null($value)) {
					 $row[$key] = "";
				    }
				}
				echo $row[$param];
			}
		}
	}

?>
