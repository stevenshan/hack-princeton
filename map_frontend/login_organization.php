<?php
  include("scripts/organization_session.php");
  if ($success)
  {
    header("location:/organization_dashboard.php");
  }
  include("scripts/login_organization.php");
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

    <title>Organization Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>

  <body>
    <form class="form-signin" action="" method="post">
      <div class="text-center mb-4">
        <img class="mb-4" src="imgs/logo.svg" alt="" width="164" height="164">
        <!--<h1 class="h3 mb-3 font-weight-normal">Login</h1>-->
      </div>

      <div style='text-align:center'><h4> ORGANIZATION LOG IN </h4></div>
      <p> </p>
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
        <label for="inputName">Organization name or email</label>
      </div>

      <div class="form-label-group">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
 <p> </p>
 <p style='text-align:center'>Not signed up yet? &nbsp; <a href="register_organization.php">Register Here!</a></p>
      <p style='text-align:center'>Not a organization? &nbsp; <a href="login.php">Volunteer log in</a></p>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>
  </body>
</html>
