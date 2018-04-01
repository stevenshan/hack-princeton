<?php
	include("session.php");
	if (!$success || !isset($_GET["query"]))
	{
		echo "-1";
	}
	else
	{
		$userid = $_SESSION["login_user"];
		$query = $_GET["query"];
		include("config.php");
		$sql="SELECT id,friends FROM Users WHERE name='$query' OR email='$query'";
        $result=mysqli_query($db, $sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $count=mysqli_num_rows($result);	
        if ($count > 1)
        {
        	echo "Need more specific query";
        }
        else if ($count == 0)
        {
        	echo "No users found";
        }
        else
        {
        	$friends=explode(",", $row["friends"]);
        	if ($row["friends"] == "")
        	{
        		$friends=[];
        	}

        	$flag = true;
        	foreach ($friends as $person)
        	{
        		if (substr($person, 0, 1) == "#")
        		{
        			if (substr($person, 1) == $userid)
        			{
        				echo "Already sent friend request";
        				$flag = false;
        			}
        		}
        		else if ($person == $userid)
        		{
        			echo "Already friends";
        			$flag = false;
        		}
        	}

        	if ($flag)
        	{
        		$targetid = $row["id"];
        		$mesg = $row["friends"];
        		if ($row["friends"] != "")
        		{
        			$mesg = $mesg . ",";
        		}
        		$mesg = $mesg . "#" . ((string)$userid);

	    		$sql="UPDATE `Users` SET `friends`='$mesg' WHERE id='$targetid'";
			    $result=mysqli_query($db, $sql);
			    echo "1Friend request sent";	
        	}
        }
	}
?>