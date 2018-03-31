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
		<link href="css/organization-dash.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<?php echo $row["name"]; ?>
		</header>
		<main>
			<div class="container">
				t 1
			</div>
			<div class="container">
				<h3>Events<a href="register_event.php"><img style="vertical-align: middle; float: right" src="imgs/add.svg"></a></h3>
				<div class="event">fsfd</div>
			</div>
		</main>
	</body>
</html>