<?php

	header("Access-Control-Allow-Origin: *");
	
	include("session.php");
	
	if ($success)
	{
		echo $_SESSION["login_user"];
	}
	else
	{
		die("-1");
	}

?>
