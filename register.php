<?php
 require './model/connection.php';
  session_start();
  if(isset($_SESSION["userid"])){
    header("Location: dashboard.php");
    exit();
  }

  if(isset($_POST)&& isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["cpassword"])){
          $username = mysqli_real_escape_string($con,$_POST["username"]);
          $fname = mysqli_real_escape_string($con,$_POST["fname"]);
          $lname = mysqli_real_escape_string($con,$_POST["lname"]);
          $password = mysqli_real_escape_string($con,$_POST["password"]); 
          $cpassword = mysqli_real_escape_string($con,$_POST["cpassword"]); 
              
          
      if($password == $cpassword){
              $query = "select * from users where email like '$username'";
              $result = mysqli_query($con,$query);
              $password = md5($password);
              if(mysqli_num_rows($result) < 1){

                  $query = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`) VALUES ('$fname', '$lname', '$username', '$password');";
                  if(mysqli_query($con,$query)){
                    setcookie("user",$username,time()+(60*60*24),"/");
                  header("Location: index.php");
                  exit();
                }      
                else{
                  $error = "Invalid Username or password";
                }
              }
              else {
                $error = "User Already Registered";

              }
              
      }
      else{
        $error = "Password don't match"; 
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
    <title>Note Taking</title>

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
              
                <div class="center-block registerform">
                    <div class="panel panel-default">
                      <div class="panel-heading text-center">Register</div>
                      <div class="panel-body">
                      <?php if(isset($error)){ ?>
                      <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p><?php echo $error ;?><p>
                      </div>
                      <?php }?>
                      <form method="post" >
                        <div class="form-group">
                          <label for="fname">First Name:</label>
                          <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                          <label for="lname">Last Name:</label>
                          <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                          <label for="username">Email address:</label>
                          <input type="email" class="form-control" id="username" name="username" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                          <label for="pwd">Password:</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                          <label for="cpwd"> Confirm Password:</label>
                          <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                        </div>
                          <label><a href="index.php">Already register ?Log me in</a></label>
                          <button class="btn btn-success btn-block" type="submit">Register</button>
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