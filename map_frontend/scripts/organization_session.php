<?php
	
	// Check if client is logged in
	// set $success to true if logged in false otherwise

	session_start();
	$success=isset($_SESSION["org_user"]);

?>