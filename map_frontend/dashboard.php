<?php
  include("scripts/session.php");
  if (!$success)
  {
    header("location:/login.php");
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
		<link href="css/dashboard.css" rel="stylesheet">
		<link href="css/user-dash.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/loading-bar.css"/>
		<script type="text/javascript" src="js/loading-bar.js"></script>
	</head>
	<body>
		<header>
		    Welcome <?php echo $row["name"]; ?>! 
		    <a href="index.php" title="Map"><img src="imgs/map.png" width="27px" id="map-exit"></a>
		    <a href="logout.php" title="Logout"><img id="dash-exit" src="imgs/exit_white.png" width="22px" alt="logout"></a>
       	</header>
		<main>
			<div
			  class="ldBar"
			  data-stroke="data:ldbar/res,gradient(0,1,#f99,#ff9)"
			  data-stroke-width="30px"
			  data-value="50"
			  style="width: 100%; height: 100px; padding: 0; margin: 0 auto">  	
			</div>
			<div class="container" id="friends-container">
				<div id="friends-bar">
					<div id="friends-bar-left"></div>
					<div id="friends-bar-right">
						<form id="friend-search">
							<input type="text" placeholder="Search for friends" name="name" id="friend-name" required>	
						</form>
					</div>
				</div>
				<div class="events-message" id="friends-message">
					Use the search bar to find friends to volunteer with!
				</div>
			</div>
			<div class="container" id="events-container">
				<div class="events-message" id="empty-message">
					You have not signed up for any events yet. Go to the map to explore volunteer opportunities!
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
