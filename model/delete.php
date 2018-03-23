<?php
	require 'connection.php';
	require 'session.php';
	if(isset($_GET) && isset($_GET['id']) ) {
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$user = $_SESSION["userid"];
		
		
		$query = "DELETE FROM `note` WHERE `note`.`noteid` = $id AND `note`.`userid` = $user";
		if(mysqli_query($con,$query)){
			header("Location: ../dashboard.php");
			exit();
		}
	}
	
			header("Location: ../dashboard.php");
			exit();

?>
