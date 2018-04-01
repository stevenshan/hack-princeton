<?php

  session_start();
  if ($success)
    echo $_SESSION["login_user"];
  else
    die("-1");

?>
