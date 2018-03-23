<?php
  require 'connection.php';
  require 'session.php';

  if(isset($_POST) && isset($_POST["id"]) && trim($_POST["id"]) != "" && isset($_POST["desc"]) && trim($_POST["desc"]) != ""){
  	$id = mysqli_real_escape_string($con,$_POST["id"]);
  	$task =  mysqli_real_escape_string($con,$_POST["desc"]);
  	$user = $_SESSION["userid"];
  	$query = "update note set task = '$task' WHERE `note`.`noteid` = $id AND `note`.`userid` = $user  ";
  	if(mysqli_query($con,$query)){  			
			header("Location: ../dashboard.php");
			exit();
  	}
  }

?>