<?php

	header("Access-Control-Allow-Origin: *");

	// get name associated with user id

	include("config.php");

	if (!isset($_GET["id"]))
	{
		echo "Guest";
	}
	else
	{

		$id= mysqli_real_escape_string($db, $_GET["id"]);

		$sql = "SELECT name FROM Users WHERE id='$id'";
		$result=mysqli_query($db, $sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count=mysqli_num_rows($result);

		if($count != 1)
		{
			echo "Guest";
		}
		else
		{
			foreach ($row as $key => $value) {
			    if (is_null($value)) {
				 $row[$key] = "";
			    }
			}
			echo $row["name"];
		}
	}

?>
