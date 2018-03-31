<?php
  include("scripts/organization_session.php");
  if (!$success)
  {
    header("location:/");
  }

  include("scripts/config.php");

  $orgid = $_SESSION["org_user"];

  $sql="SELECT * FROM Organizations WHERE id='$orgid'";
  $result=mysqli_query($db, $sql);
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

  $count=mysqli_num_rows($result);
?>
<html>
	<head>
		<title><?php echo $row["name"]; ?> Dashboard</title>
	</head>
	<body>
		test
	</body>
</html>