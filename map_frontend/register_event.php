<?php
  include("scripts/organization_session.php");
  if (!$success)
  {
    header("location:login_organization.php");
  }
  include("scripts/create_event.php");
  if ($success)
  {
    header("location:organization_dashboard.php");
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Event</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>

  <body>
    <div id="background"></div>
    <form class="form-signin" action="" method="post" id="event_form">
      <div class="text-center mb-4">
        <img class="mb-4" src="imgs\logo.svg" alt="" width="164" height="164">
        <!--<h1 class="h3 mb-3 font-weight-normal">Login</h1>-->
      </div>

      <?php
        if ($error != "")
        {
      ?>
      <div class="text-center mb-4 error-box">
        <?php echo "$error"; ?>
      </div>
      <?php
        }
      ?>
      <div style='text-align:center'><a style="float: left; vertical-align: middle" href="organization_dashboard.php" title="Back to Dashboard"><img width="30" src="imgs/back.svg"></a><h4> ADD AN EVENT</h4></div>
      <p> </p>
      <div class="form-label-group">
        <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" required autofocus>
        <label for="inputName">Name</label>
      </div>

      <div class="form-label-group">
        <input type="date" name="date" id="inputDate" class="form-control" placeholder="Password" required>
        <label for="inputDate">Date</label>
      </div>

      <div class="form-label-group">
        <input type="time" name="start" id="inputStart" class="form-control" placeholder="Start Time">
        <label for="inputStart">Start Time</label>
      </div>

      <div class="form-label-group">
        <input type="time" name="end" id="inputEnd" class="form-control" placeholder="End Time">
        <label for="inputEnd">End Time</label>
      </div>

      <div class="form-label-group">
        <textarea class="form-control" id="inputDesc" placeholder="Description" name="description"></textarea>
      </div>

      <div class="form-label-group">
        <input type="text" name="location" id="inputLocation" class="form-control" placeholder="Location" required>
        <label for="inputLocation">Location</label>
      </div>

      <select name="tag" required style="margin-bottom: 15px">
        <option value="ANI">Animals</option>
        <option value="ENV">Environments</option>
        <option value="EDU">Education and Literacy</option>
        <option value="CPU">Computers and Technology</option>
        <option value="MED">Health and Medicine</option>
        <option value="HOM">Homeless and Housing</option>
        <option value="CHD">Children and Youth</option>
      </select>

      <input type="hidden" name="lat" id="latinput" value="0.0">
      <input type="hidden" name="long" id="longinput" value="0.0">

      <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="return check_reg()">Create Event</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      function check_reg()
      {
        if ($("#inputLocation").val() == "")
        {
          return false;
        }
        $.getJSON( "https://maps.google.com/maps/api/geocode/json?address=" + $("#inputLocation").val() + "&key=AIzaSyA4oufZ_wBBWQlZzWrNQ5SeQ2HmSvsuKbo", function( data ) {
          if (data["results"].length != 0)
          {
            $("#latinput").val(data["results"][0]["geometry"]["location"]["lat"]);
            $("#longinput").val(data["results"][0]["geometry"]["location"]["lng"]);
            $("#event_form").submit();
          }
        });
        return false;
      }
    </script>
  </body>
</html>
