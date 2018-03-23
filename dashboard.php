<?php
  require './model/connection.php';
  require './model/session.php';

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
              <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION["name"];?></a> </li>              
              <li><a href="changepassword.php"><span class="glyphicon"></span>Change Password</a></li>            
              <li><a href="./model/logout.php"><span class="glyphicon"></span>Logout</a></li>
            </ul>
            
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="main">
      <div class="container">
          <div class="row">
            <div class="center-block">
                <div class="panel panel-default">
                  <div class="panel-heading text-center">Problem Statement Priority</div>
                  <div class="panel-body">

                  <?php
                    $userid = $_SESSION["userid"] ;

                    $query = "select * from submiss where teamid= $userid";
                    $result = mysqli_query($con,$query);
                    $number=mysqli_num_rows($result);
                    if(mysqli_num_rows($result) >= 1){  ?>
                      <h3>You Have Already Submitted your Options</h3><br>
                      <?php
                     }
                    else {
                    $query = "select * from statement";
                    $result = mysqli_query($con,$query);
                    $number=mysqli_num_rows($result);
                    $a=array()?>

                      <form method="post" class="form-inline" action="./model/insert.php" style="padding-top: 15px">
                          <input type="hidden" name="total" value="<?php echo $number?>">
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>Problem Statement</th>
                                  <th>Description</th>
                                  <th>Priority</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php while($row = mysqli_fetch_assoc($result)) {
                                        array_push($a,$row["id"]);
                                      ?>

                                      <tr>
                                          <td><?php echo $row["name"]; ?></td>
                                          <td><?php echo $row["descp"]; ?></td>
                                          <td><?php for ($i=1;$i<= $number;$i++){?>
                                                  <input type="radio" name="<?php echo $row["id"] ?>" value="<?php echo $i ?>" required> <?php echo $i ?><br>
                                              <?php } ?></td>
                                      </tr>
                                  <?php
                              } ?>
                              </tbody>
                          </table>
                          <input type="hidden" name="test" value = "<?php echo implode(",",$a); ?>">
                          <button class="btn btn-success" name="insert" value="insert" type="submit">Submit</button>
                          <button class="btn btn-danger " type="reset">Reset</button>
                      </form>
                              <?php }
                              ?>




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