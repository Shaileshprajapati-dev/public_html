<?php 
	include("connection.php");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <style>
	#preloader{
		background: #E3F4FC url(loader.gif) no-repeat center center;
		background-size: 50%;
		height: 100vh;
		width: 100%;
		position: fixed;
		z-index: 100;
	}
  </style>
</head>
<body class="">
  <div class="wrapper ">
    <?php include("sidebar.php"); ?>
    <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <?php include("navbar.php") ?>
      <!--<div id="preloader" ></div>-->
      <!-- End Navbar -->
      <div class="content">
        <?php
        if(isset($_POST['add'])){
            $username = $_POST['username'];
            $pass = $_POST['password'];
            $password = password_hash($pass,PASSWORD_DEFAULT);
            $addq = mysqli_query($con,"INSERT INTO `users`(`username`, `password`) VALUES ('$username','$password')");
            if($addq){
                ?>
                <script>
                    location.replace('users.php');
                </script>
                <?php
            }
        }
        
        if(isset($_GET['del'])){
            $del = $_GET['del'];
            $delq = mysqli_query($con,"DELETE FROM users WHERE username = '$del'");
            if($delq){
                ?>
                <script>
                    location.replace('users.php');
                </script>
                <?php
            }
        }
        ?>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Add User
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="users.php" method="post" >
      <div class="modal-body">
        <div class="form-group" >
            <label>Username</label>
            <input type="text" name="username" class="form-control mb-2" >
        </div>
        <div class="form-group" >
            <label>Password</label>
            <input type="text" name="password" class="form-control mb-2" >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add" >Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
        <div class="table-responsive" >
            <table class="table table-hover table-stripped" >
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $usersq = mysqli_query($con,"SELECT * FROM users ORDER BY id ASC");
                while($user = mysqli_fetch_array($usersq)){
                ?>
                    <tr>
                        <td><?= $user['username']; ?></td>
                        <td>
                            <?php
                            if($_SESSION['user'] == $user['username']){
                            ?><a href="#" disabled class="btn btn-danger" >Delete</a><?php
                            }
                            else{
                            ?><a href="users.php?del=<?= $user['username']; ?>" class="btn btn-danger" >Delete</a><?php
                            }
                            ?>
                            </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>

</html>
