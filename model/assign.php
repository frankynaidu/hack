<?php
require 'connection.php';

if(isset($_GET)) {

    $query = "SELECT * FROM `statement` ";
    $result = mysqli_query($con,$query);
    $number = mysqli_num_rows($result);
    $test = array();
    if(mysqli_num_rows($result)  >= 1){
        while($row = mysqli_fetch_assoc($result)){
            $test[$row["id"]] = $row["max"];
        }
    }


//    $total = mysqli_real_escape_string($con, $_POST['total']);
    $query = "select * from submiss ORDER BY timestamp ASC";
    $teamassigned = array();
    $result = mysqli_query($con,$query);
    $number=mysqli_num_rows($result);
    $final = array();
    if(mysqli_num_rows($result)  >= 1){
        while($row = mysqli_fetch_assoc($result)){
            $team = $row["teamid"];
            $query = "SELECT * FROM request where teamid = $team ORDER BY priority ASC";
            $res = mysqli_query($con,$query);
            while($r = mysqli_fetch_assoc($res)){

                if(!in_array($r["teamid"],$teamassigned)){
                    if($test[$r["statementid"]] > 0){
                        array_push($teamassigned,$r["teamid"]);
                        $test[$r["statementid"]]--;
                        $final[$r["teamid"]] = $r["statementid"];
                        $que = "INSERT INTO `final` (`teamid`, `statementid`) VALUES ('".$r["teamid"]."', '".$r["statementid"]."')";
                        if(!mysqli_query($con,$que)){

                            exit();
                        }
//                        echo $que."<br/>";
                    }
                }
            }
        }
    }
}
//for($i=0;$i<count($final);$i++){
//
//}
//print_r($final)


?>