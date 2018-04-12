<?php
  include("scripts/organization_session.php");
  if (!$success)
  {
    header("location:login_organization.php");
  }
  include("scripts/edit_event.php");
  if ($success || !isset($_GET["id"]))
  {
    header("location:organization_dashboard.php");
  }
  else
  {
    include("config.php");

    $id = mysqli_real_escape_string($db, $_GET["id"]);

    $sql = "SELECT * FROM Events WHERE id='$id'";
    $result=mysqli_query($db, $sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count=mysqli_num_rows($result);

    if($count != 1 || $row["organization"] != $_SESSION["org_user"])
    {
      header("location:/organization_dashboard.php");
    }
    else
    {
      $data = $row;
      $content = json_decode($data["data"]);
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Event</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>

  <body>
    <div id="background"></div>
    <form class="form-signin" action="" method="post" id="event_form">
      <div class="text-center mb-4">
        <img class="mb-4" src="imgs/logo.svg" alt="" width="164" height="164">
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
      <div style='text-align:center'><a style="float: left; vertical-align: middle" href="organization_dashboard.php" title="Back to Dashboard"><img width="30" src="imgs/back.svg"></a><h4> EDIT THIS EVENT</h4></div>
      <p> </p>
      <div class="form-label-group">
        <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" value="<?php echo $data["name"] ?>" required autofocus>
        <label for="inputName">Name</label>
      </div>

      <div class="form-label-group">
        <input type="date" name="date" id="inputDate" class="form-control" placeholder="Password" value="<?php echo $data["date"] ?>" required>
        <label for="inputDate">Date</label>
      </div>

      <div class="form-label-group">
        <input type="time" name="start" id="inputStart" class="form-control" placeholder="Start Time" value="<?php echo $content->start; ?>">
        <label for="inputStart">Start Time</label>
      </div>

      <div class="form-label-group">
        <input type="time" name="end" id="inputEnd" class="form-control" placeholder="End Time" value="<?php echo $content->end; ?>">
        <label for="inputEnd">End Time</label>
      </div>

      <div class="form-label-group">
        <textarea class="form-control" id="inputDesc" placeholder="Description" name="description"> <?php echo $content->description; ?></textarea>
      </div>

      <div class="form-label-group">
        <input type="text" name="location" id="inputLocation" class="form-control" placeholder="Location" required value="<?php echo $content->location; ?>">
        <label for="inputLocation">Location</label>
      </div>

      <select name="tag" required style="margin-bottom: 15px">
        <option value="ANI" <?php if ($content->category == "ANI") echo "selected";?>>Animals</option>
        <option value="ENV" <?php if ($content->category == "ENV") echo "selected";?>>Environments</option>
        <option value="EDU" <?php if ($content->category == "EDU") echo "selected";?>>Education and Literacy</option>
        <option value="CPU" <?php if ($content->category == "CPU") echo "selected";?>>Computers and Technology</option>
        <option value="MED" <?php if ($content->category == "MED") echo "selected";?>>Health and Medicine</option>
        <option value="HOM" <?php if ($content->category == "HOM") echo "selected";?>>Homeless and Housing</option>
        <option value="CHD" <?php if ($content->category == "CHD") echo "selected";?>>Children and Youth</option>
      </select>

      <input type="hidden" name="lat" id="latinput" value="0.0">
      <input type="hidden" name="long" id="longinput" value="0.0">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="return check_reg()">Save Changes</button>
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
