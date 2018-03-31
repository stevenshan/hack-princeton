<?php
  include("scripts/organization_session.php");
  if (!$success)
  {
    header("location:/");
  }
  include("scripts/create_event.php");
  if ($success)
  {
    header("location:/organization_dashboard.php");
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
    <form class="form-signin" action="" method="post">
      <div class="text-center mb-4">
        <img class="mb-4" src="icon.svg" alt="" width="72" height="72">
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

      <div class="form-label-group">
        <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" required autofocus>
        <label for="inputName">Name</label>
      </div>

      <div class="form-label-group">
        <input type="date" name="date" id="inputDate" class="form-control" placeholder="Password" required>
        <label for="inputDate">Date</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Create Event</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>
  </body>
</html>
