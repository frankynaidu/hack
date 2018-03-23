<?php
 require './model/connection.php';
  session_start();
  if(isset($_SESSION["userid"])){
    header("Location: dashboard.php");
    exit();
  }

  if(isset($_POST)&& isset($_POST["username"]) && isset($_POST["password"])){

      $username = mysqli_real_escape_string($con,$_POST["username"]);
      $password =mysqli_real_escape_string($con,$_POST["password"]);
      $query = "select * from team where teamid like '$username' AND pass like '$password'";
      echo $query;
      $result = mysqli_query($con,$query);
      if(mysqli_num_rows($result) >0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION["userid"] = $row["teamid"];
        $_SESSION["name"] =$row["name"];
        setcookie("user",$username,time()+(60*60*24*365),"/");
        header("Location: dashboard.php");
        exit();
      }      
      else{
        $error = "Invalid Username or password";
      }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>Note Taking </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    


    <div class="main">
      <div class="container">
          <div class="row">
            <div class="col-md-offset-3 col-md-6">
              
                <div class="center-block loginform">
                    <div class="panel panel-default">
                      <div class="panel-heading text-center">Login</div>
                      <div class="panel-body">
                      <?php if(isset($error)){ ?>
                      <div class="alert alert-danger">
                        <p><?php echo $error ;?><p>
                      </div>
                      <?php }?>

                      <?php $user = isset($_COOKIE['user'])?  $_COOKIE['user'] : "";?>
                      <form method="post" >
                        <div class="form-group">
                          <label for="username">Email address:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $user?>" placeholder="Enter the registered email address" required>
                        </div>
                        <div class="form-group">
                          <label for="pwd">Password:</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter the Password" required>
                        </div>

                          <label ><a href="register.php">Don't have a account.Register here</a></label><br>
                          <label><a href="forgot.php">Forgot Password</a></label>
                          <button class="btn btn-success btn-block" type="submit">Login</button>
                          <button class="btn btn-danger btn-block" type="reset">Reset</button>
                      </form>
                     
                      
                      </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
    
    <footer></footer>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>