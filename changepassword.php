<?php
 require './model/connection.php';
 require './model/session.php';

  if(isset($_POST)&& isset($_POST["cpassword"]) && isset($_POST["password"])){

      $cpassword =md5(mysqli_real_escape_string($con,$_POST["cpassword"]));
      $password =md5(mysqli_real_escape_string($con,$_POST["password"])); 
      $query = "update users set password = '$password' where userid = '".$_SESSION['userid']."'";
      
      if($cpassword == $password){
	      	if(mysqli_query($con,$query) ){

	        header("Location: ./model/logout.php");
	        exit();
	      }      
	      else{
	        $error = mysqli_error($con);
	      }
      }
      else{
      	$error = "Password did not match";
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
    <title><?php echo $_SESSION["name"];?> Notes</title>

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
    
    <header>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsednavigation" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Note Taker</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="collapsednavigation">

            <ul class="nav navbar-nav navbar-right">
              <li><a href="dashboard.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION["name"];?></a> </li>              
              <li class="active"><a href="changepassword.php"><span class=" glyphicon"></span>Change Password</a></li>            
              <li><a href="./model/logout.php"><span class="glyphicon"></span>Logout</a></li>
            </ul>
            
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>


    <div class="main">
      <div class="container">
          <div class="row">
            <div class="col-md-offset-3 col-md-6">
              
                <div class="center-block loginform">
                    <div class="panel panel-default">
                      <div class="panel-heading text-center">Change Password</div>
                      <div class="panel-body">
                      <?php if(isset($error)){ ?>
                      <div class="alert alert-danger">
                        <p><?php echo $error ;?><p>
                      </div>
                      <?php }?>
                      <form method="post" >
                        <div class="form-group">
                          <label for="username">Name:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION["name"]?>" placeholder="Enter the registered email address" readonly>
                        </div>
                        <div class="form-group">
                          <label for="pwd">New Password:</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter the Password" required>
                        </div>
                        <div class="form-group">
                          <label for="pwd">Confirm Password:</label>
                          <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re enter the Password" required>
                        </div>
                          <button class="btn btn-success btn-block" type="submit">Change Password</button>
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