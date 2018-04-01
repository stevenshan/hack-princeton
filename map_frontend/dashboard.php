<?php
  include("scripts/session.php");
  if (!$success)
  {
    header("location:/");
  }

  include("scripts/config.php");

  $userid = $_SESSION["login_user"];

  $sql="SELECT * FROM Users WHERE id='$userid'";
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
		    Welcome <?php echo $row["name"]; ?>! 
		    <a href="logout.php" title="Logout"><img style="vertical-align: middle; float: right" src="imgs/exit_white.png" width="22px" alt="logout" style="opacity: 1"></a>
       	</header>
		<main>
			<div class="container">
				t 1	
			</div>
			<div class="container" id="events-container">
				<div class="events-message" id="empty-message">
					You have no signed up for any events yet. Go to the map to explore volunteer opportunities!
				</div>
				<input type="radio" name="eventsTense" id="futureTense" class="tenseInput">
				<input type="radio" name="eventsTense" id="everythingTense" class="tenseInput" checked>
				<input type="radio" name="eventsTense" id="pastTense" class="tenseInput">
				<h3>Events <span class="event_count">()</span>
					<label for="futureTense" class="tenseSelect" id="futureSelect">Future</label>
					<label for="everythingTense" class="tenseSelect" id="everythingSelect">All</label>
					<label for="pastTense" class="tenseSelect" id="pastSelect">Past</label>
				</h3>
			</div>
		</main>

		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/dashboard.js"></script>
		<script type="text/javascript" src="js/user_dashboard.js"></script>
	</body>
</html>
