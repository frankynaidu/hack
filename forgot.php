<?php
 require './model/connection.php'; 
 require './assets/phpmailer/PHPMailerAutoload.php';
 require './model/sendmail.php';
 

  if(isset($_POST)&& isset($_POST["username"])){

      $username = mysqli_real_escape_string($con,$_POST["username"]);
      $query = "select * from users where email like '$username'";
      $result = mysqli_query($con,$query);
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $name = $row["first_name"].' '.$row["last_name"];
        $to = $row["email"];
        $link= "localhost/notetaking/verify.php?name=$to&token=".$row['password'];
        $msg = "<h1> Welcome we have requested for password reset </h1><br><h3>Please visit <a href='$link'>$link</a> </h3>";
        if (sendmail($to,$name,$msg)){
          $success = "Check your mail";
        }
        else{
          $error = "Try Later";
        }

        
      }      
      else{
        $error = "UserName does not exits";
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
                      <?php if(isset($success)){ ?>
                      <div class="alert alert-success">
                        <p><?php echo $success ;?><p>
                      </div>
                      <?php }?>
                      <form method="post" >
                        <div class="form-group">
                          <label for="username">Email address:</label>
                          <input type="email" class="form-control" id="username" name="username"  placeholder="Enter the registered email address" required>
                        </div>
                          <label><a href="register.php">Don't have a account.Register here</a></label>
                          <button class="btn btn-success btn-block" type="submit">Request Password</button>
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