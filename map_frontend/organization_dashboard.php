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
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/organization-dash.css" rel="stylesheet">
	</head>
	<body>
		<header>
		    <?php echo $row["name"]; ?> 
		    <a href="logout.php" title="Logout of organization account"><img style="vertical-align: middle; float: right" src="imgs/exit_white.png" width="22px" alt="logout" style="opacity: 1"></a>
       	</header>
		<main>
			<div class="container">
				t 1	
			</div>
			<div class="container" id="events-container">
				<h3>Events <span class="event_count">()</span><a href="register_event.php">New Event <img src="imgs/add_white.svg" width="20"></a></h3>
				<div class="events-message" id="empty-message">
					Your organization does not have any events. Click on "New Event" button to create a new one.
				</div>
			</div>
		</main>

		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/dashboard.js"></script>
	</body>
</html>
