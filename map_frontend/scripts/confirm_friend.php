<?php
	include("session.php");
	if (!$success || !isset($_GET["friend"]) || !isset($_GET["reject"]))
	{
		echo "-1";
	}
	else
	{
		$userid = $_SESSION["login_user"];
		$friend = $_GET["friend"];
                $reject = $_GET["reject"];

		include("config.php");
		$sql="SELECT friends FROM `Users` WHERE id='$userid'";
                $result=mysqli_query($db, $sql);
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

                $count=mysqli_num_rows($result);	
                if ($count == 0)
                {
                        echo "User not found";
                }
                else
                {
                        $friends=explode(",", $row["friends"]);
                        if ($row["friends"] == "")
                        {
                                $friends=[];
                        }

                        $new_friends = "";
                        $flag = true;
                        $found = false;
                        foreach ($friends as $person)
                        {
                                if (substr($person, 0, 1) == "#")
                                {
                                        if (substr($person, 1) != $friend)
                                        {
                                                $new_friends = $new_friends . "," . $person;
                                        }
                                        else
                                        {
                                                $found = true;
                                        }
                                }
                                else if ($person != $friend)
                                {
                                        $new_friends = $new_friends . "," . $person;
                                }
                        }        

                        if (!$found)
                        {
                                echo "User has not requested friendship";
                                exit();
                        }

                        if ($reject != "true")
                        {
                                $new_friends = $friend . $new_friends;
                        }
                        else if (substr($new_friends, 0, 1) == ",")
                        {
                                $new_friends = substr($new_friends, 1);
                        }

                        $sql="UPDATE `Users` SET `friends`='$new_friends' WHERE id='$userid'";
                        mysqli_query($db, $sql);
                        $sql="SELECT friends FROM `Users` WHERE id='$friend'";
                        $result=mysqli_query($db, $sql);
                        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

                        $count=mysqli_num_rows($result);        
                        if ($count == 0)
                        {
                                echo "User not found";
                        }
                        else
                        {
                                $friends=explode(",", $row["friends"]);
                                if ($row["friends"] == "")
                                {
                                        $friends=[];
                                }

                                $new_friends = "";
                                $flag = true;
                                foreach ($friends as $person)
                                {
                                        if (substr($person, 0, 1) == "#")
                                        {
                                                if (substr($person, 1) != $userid)
                                                {
                                                        $new_friends = $new_friends . "," . $person;
                                                }
                                        }
                                        else if ($person != $userid)
                                        {
                                                $new_friends = $new_friends . "," . $person;
                                        }
                                }        

                                if ($reject != "true")
                                {
                                        $new_friends = $userid . $new_friends;
                                }
                                else if (substr($new_friends, 0, 1) == ",")
                                {
                                        $new_friends = substr($new_friends, 1);
                                }
                                $sql="UPDATE `Users` SET `friends`='$new_friends' WHERE id='$friend'";
                                mysqli_query($db, $sql);
                                echo "1Success";
                        }
                }
        }
?>