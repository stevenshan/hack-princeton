<?php
  include("scripts/organization_session.php");
  if ($success)
  {
    header("location:organization_dashboard.php");
  }
  include("scripts/create_org.php");
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

    <title>Organization Registration</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>

  <body>
    <div id="background"></div>
    <form class="form-signin" action="" method="post">
      <div class="text-center mb-4">
        <img class="mb-4" src="imgs/logo.svg" alt="" width="164" height="164">
        <!--<h1 class="h3 mb-3 font-weight-normal">Login</h1>-->
      </div>

      <div style='text-align:center'><h4> ORGANIZATION REGISTRATION </h4></div>
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
        <label for="inputName">Organization name</label>
      </div>

      <div class="form-label-group">
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">Organization email address</label>
      </div>

      <div class="form-label-group">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
      <p> </p>
      <p style='text-align:center'>Already have an account? &nbsp; <a href    ="login_organization.php">Log in here!</a></p>
      <p style='text-align:center'>Not an organization? &nbsp; <a href    ="register.php">Volunteer registration</a></p>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>
  </body>
</html>
