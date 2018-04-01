<?php

	// Check if client is logged in
	// set $success to true if logged in false otherwise

	session_start();
	$success=isset($_SESSION["login_user"]);
	setcookie("uid", $_SESSION["login_user"], time() + (86400 * 30), "/");

	$sql = "SELECT name FROM Users WHERE id=" + $_SESSION["login_user"];
	$result=mysqli_query($db, $sql);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

	$count=mysqli_num_rows($result);

	if($count == 1)
		setcookie("username", $row["name"], time() + (86400 * 30), "/");

?>
