<?php

    // Script to login using post data
    // sets $success to true if login was successful or
    // $error to a string otherwise

    include("config.php");
    session_start();
    $error="";
    $success=false;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 

        $myname=mysqli_real_escape_string($db,$_POST["name"]);
        $mypassword=mysqli_real_escape_string($db,$_POST["password"]); 

        $sql="SELECT id FROM Organizations WHERE name='$myname' and password='$mypassword'";
        $result=mysqli_query($db, $sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $count=mysqli_num_rows($result);

        if($count == 1) 
        {
            $_SESSION["org_user"]=$row["id"];
            $success=true;
        }
        else 
        {
            $error="Incorrect name or password";
        }
    }
?>