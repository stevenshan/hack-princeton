<?php

  include("scripts/session.php");

  if (!$success)
    header('Location: home.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- <link rel="stylesheet" href="css/navbar-fixed-right.css"> -->
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jquery.cookie.js"></script>
  <script src="js/user.js"></script>
  <title>Explore</title>
</head>

<body>
  <!-- NAVIGATION/SIDEBAR -->
  <div class="wrapper">

    <nav id="sidebar">
      <div id="dismiss">
        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
          <img src="imgs/menu.png" width="40px">
        </button>
      </div>


      <div id="sidebar-content" class="sidebar-content">
      <div class="sidebar-header">
        <div id="welcome" class="nav navbar-nav pull-right">
          <a href="dashboard.php" class="navbar-brand welcome-name">Welcome, <script>document.write(name);</script></a>
          <p class="navbar-brand welcome-name">&nbsp;&nbsp; | &nbsp;&nbsp;</p>
          <a class="navbar-brand welcome-name" href="logout.php"><img src="imgs/exit_black.png" width="22px" alt="logout" style="opacity: 0.4"></a>
        </div>
      </div>

      <ul class="list-unstyled components">

        <li>
          <div id="infobox" class="">
            <h1 id="event-title" class="event-title"></h1>
            <hr id="event-divider"/>
            <div id="signup-button" class="centered-button">
              <button id="signup-button-button" type="button" class="btn btn-primary" disabled>Sign up</button>
            </div>

            <table id="event-table" class="event-info">
              <tr>
                <td>
                  <b>Organization</b>
                </td>
                <td id="event-org" class="event-info">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td>
                  <b>Description</b>
                </td>
                <td id="event-description" class="event-info">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td>
                  <b>Location</b>
                </td>
                <td id="event-loc" class="event-info">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td>
                  <b>Date</b>
                </td>
                <td id="event-date" class="event-info">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td>
                  <b>Start Time</b>
                </td>
                <td id="event-start" class="event-info">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td>
                  <b>End Time</b>
                </td>
                <td id="event-end" class="event-info">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td>
                  <b>No. of Volunteers</b>
                </td>
                <td id="num-people" class="event-info">
                  &nbsp;
                </td>
              </tr>

              <tr>
                <td>
                  <b>Friends</b>
                </td>
                <td id="event-friends" class="event-info">
                  &nbsp;
                </td>
              </tr>
            </table>
          </div>
        </li>
      </ul>
    </div>

      <div id="navbar-footer" class="navbar-header">
        <a class="navbar-brand centered-header" href="#">HackPrinceton Spring 2018</a>
      </div>


    </nav>
  </div> <!-- /wrapper -->


  <main>
    <div class="container" style="width: 100%; height: 100%; position: absolute; padding: 0; margin-left: 0px;">
      <input id="pac-input" class="controls" type="text" placeholder="Search for places...">
      <div id="map"></div>
    </div>

    <script type="text/javascript" src="js/explore.js"></script>
    <!-- API key: AIzaSyA4oufZ_wBBWQlZzWrNQ5SeQ2HmSvsuKbo -->
    <!-- &callback= -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4oufZ_wBBWQlZzWrNQ5SeQ2HmSvsuKbo&libraries=places&callback=initMap"></script>


  </div>

  </main>

</body>
</html>
