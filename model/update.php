<?php
	require 'connection.php';
	require 'session.php';
	if(isset($_GET) && isset($_GET['id']) && isset($_GET['status'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$userid=$_SESSION["userid"];
		switch ($_GET["status"]) {
			case 'c':
				$stat = 1;
				break;
			case 'i':
				$stat = 0;
				break;
			
			default:
				# code...
				break;
		}
		
		$query = "UPDATE `note` SET `complete` = '$stat' WHERE `note`.`noteid` = $id AND userid = $userid";
		if(mysqli_query($con,$query)){
			header("Location: ../dashboard.php");
			exit();
		}
	}

			header("Location: ../dashboard.php");
			exit();
?>