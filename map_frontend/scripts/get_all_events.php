<?php
	header("Access-Control-Allow-Origin: *");
	
	include("config.php");

	$sql = "SELECT id FROM Events";
	$result=mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	echo $row["id"];
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		echo ",".$row["id"];
	}
?>