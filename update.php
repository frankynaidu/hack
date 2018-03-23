<?php
 require './model/connection.php';
 require './model/session.php';

  if(isset($_GET)&& isset($_GET["id"]) && trim($_GET["id"]) != ""){

      $id = mysqli_real_escape_string($con,$_GET["id"]);
      $user = $_SESSION["userid"];
      $query = "select * from note where noteid=$id AND userid = $user";
      $result = mysqli_query($con,$query);
      if(mysqli_num_rows($result) < 1){
          header("Location: index.php");
          exit();
      }
      $row = mysqli_fetch_assoc($result);

      
  }
  else{

          header("Location :dashboard.php");
          exit();
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
              <li><a href="changepassword.php"><span class=" glyphicon"></span>Change Password</a></li>            
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
                      <div class="panel-heading text-center">Update Notice</div>
                      <div class="panel-body">
                  
                      <form method="post" action="./model/updatelist" >
                        <input type="hidden" name="id" value="<?php echo $row["noteid"];?>">
                        <div class="form-group">
                          <label for="username">Name:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION["name"];?>" placeholder="Enter the registered email address" readonly>
                        </div>
                        <div class="form-group">
                          <label for="desc">Task:</label>
                          <textarea  class="form-control" id="desc" name="desc" placeholder="Enter the task" required><?php echo $row["task"];?></textarea>
                        </div>
                          <button class="btn btn-success btn-block" type="submit">Update</button>
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