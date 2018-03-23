<?php
	require 'connection.php';
	require 'session.php';
	if(isset($_POST) && trim($_POST['insert']) == "insert"){
        $total = mysqli_real_escape_string($con, $_POST['total']);
//        echo str_getcsv ($_POST(test));
        $key = str_getcsv ($_POST["test"]);
        for ($i=0;$i<$total;$i++){
            $prior = mysqli_real_escape_string($con, $_POST[$key[$i]]);
            $statement = mysqli_real_escape_string($con,$key[$i]);
            $teamid = mysqli_real_escape_string($con, $_SESSION["userid"]);
            $query = "INSERT INTO `request` (`teamid`, `statementid`, `priority`) VALUES ('$teamid', '$statement', '$prior')";
//            echo $query."<br/>";
            if(!mysqli_query($con,$query)){
			header("Location: ../dashboard.php");
			exit();
		}
        }
        $sub = "INSERT INTO `submiss` (`teamid`) VALUES ('$teamid')";
//        echo $sub."<br/>";
        		if(mysqli_query($con,$sub)){
			header("Location: ../dashboard.php");
			exit();
		}
//		$name = mysqli_real_escape_string($con, $_POST['desc']);
//		$userid= $_SESSION["userid"] ;
//		$query = "INSERT INTO `note` (`userid`, `task`, `complete`, `date`) VALUES ( $userid, '$name', '0', NOW()); ";
//		if(mysqli_query($con,$query)){
//			header("Location: ../dashboard.php");
//			exit();
//		}
	}
//		header("Location: ../dashboard.php");
//			exit();
echo "hi";
$str = json_encode($_POST);
echo $str;

?>