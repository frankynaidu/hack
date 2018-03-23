<?php
	require './model/connection.php';
	session_start();
	if (isset($_GET) && isset($_GET["name"]) && isset($_GET["token"])) {
		if (trim($_GET["name"]) == "" || trim($_GET["token"]) == "") {
			
			header("Location:index.php");
			exit();
		}
		$token=mysqli_real_escape_string($con,$_GET["token"]);
		$mail=mysqli_real_escape_string($con,$_GET["name"]);
		$query = "select * from users where email like '$mail' AND password like '$token'";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) > 0){
			$row= mysqli_fetch_assoc($result);
		    $_SESSION["userid"] = $row["userid"];
		    $_SESSION["name"] =$row["first_name"]." ".$row["last_name"];
		    setcookie("user",$mail,time()+(60*60*24*365),"/");
		    header("Location: changepassword.php");
		    exit();

		}


	}
	
		header("Location:index.php");
		exit();
?>