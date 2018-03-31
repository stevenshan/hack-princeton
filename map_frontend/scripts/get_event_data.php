<?php
	header("Access-Control-Allow-Origin: *");

	// print data object of currently logged in user
	// prints "-1" if not logged in

	if (!isset($_GET["id"]) || $_GET["id"] == "")
	{
		echo "-1";
	}
	else if (!isset($_GET["param"]) || $_GET["param"] == "")
	{
		include("config.php");

		$param = mysqli_real_escape_string($db, $_GET["param"]);
		$id = mysqli_real_escape_string($db, $_GET["id"]);

		$sql = "SELECT * FROM Events WHERE id='$id'";
		$result=mysqli_query($db, $sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count=mysqli_num_rows($result);

		if($count != 1)
		{
			echo "-1";
		}
		else
		{
			echo json_encode($row);
		}
	}
	else
	{
		include("config.php");

		$param = mysqli_real_escape_string($db, $_GET["param"]);
		$id = mysqli_real_escape_string($db, $_GET["id"]);

		$sql = "SELECT $param FROM Events WHERE id='$id'";
		$result=mysqli_query($db, $sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count=mysqli_num_rows($result);

		if($count != 1)
		{
			echo "-1";
		}
		else
		{
			echo $row[$param];
		}
	}

?>