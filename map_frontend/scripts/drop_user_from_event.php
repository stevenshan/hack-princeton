<?php
	header("Access-Control-Allow-Origin: *");

	// print data object of currently logged in user
	// prints "-1" if not logged in
  include("session.php");

	if (!isset($_GET["id"]) || $_GET["id"] == "") {
		echo "-1";
  } else {
		include("config.php");

		$id = mysqli_real_escape_string($db, $_GET["id"]);
		$uid = $_SESSION["login_user"];

		$sql = "SELECT users FROM Events WHERE id='$id'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$count = mysqli_num_rows($result);

		if($count != 1) {
			echo "-1";
    } else {
			$user_list = explode($row["users"], ",");

      $new_user_list = array();
      foreach ($user_list as $user) {
        if ($user != $uid) {
          array_push($new_user_list, $user);
        }
      }

      $new_users = implode(",", $new_user_list);

      $sql_update = "UPDATE Events SET users=$new_users WHERE id='$id'";
  		$result = mysqli_query($db, $sql_update);
		}
	}

?>
