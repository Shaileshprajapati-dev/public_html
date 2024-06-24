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
    <?php
    if(isset($_POST['save'])){
        $settq = mysqli_query($con,"SELECT * FROM emails");
        while($settings = mysqli_fetch_array($settq)){
            $setname = $settings['number'];
            $emailvalue = $_POST['email'.$setname];
            $ccvalue = $_POST['cc'.$setname];
            $upq = mysqli_query($con,"UPDATE emails SET email = '$emailvalue', cc = '$ccvalue' WHERE number = '$setname'");
        }
        ?>
        <script>
            location.replace('emailsettings.php');
        </script>
        <?php
    }
    ?>
  <div class="wrapper ">
    <?php include("sidebar.php"); ?>
    <div class="main-panel" style="height: auto;">
      <!-- Navbar -->
      <?php include("navbar.php") ?>
      <!--<div id="preloader" ></div>-->
      <!-- End Navbar -->
      <div class="content">
        <form action="emailsettings.php" method="post" >
            <div class="row" >
                <div class="col-lg-10" ></div>
                <div class="col-lg-2" >
                    <div class="form-group text-end" >
                        <input type="submit" name="save" value="Save" class="btn btn-primary mt-4" >
                    </div>
                </div>
            </div>
            <?php
            $getdata = mysqli_query($con,"SELECT * FROM emails");
            while($data = mysqli_fetch_array($getdata)){
                ?>
                <div class="row" >
                    <div class="col-lg-4" >
                        <div class="form-group" >
                            <label>Table</label>
                            <input type="text" disabled class="form-control" name="table<?= $data['number'] ?>" value="<?= $data['number'] ?>" >
                        </div>
                    </div>
                    <div class="col-lg-4" >
                        <div class="form-group" >
                            <label>Email</label>
                            <input type="text" name="email<?= $data['number'] ?>" value="<?= $data['email'] ?>" class="form-control" >
                        </div>
                    </div>
                    <div class="col-lg-4" >
                        <div class="form-group" >
                            <label>CC</label>
                            <input type="text" name="cc<?= $data['number'] ?>" value="<?= $data['cc'] ?>" class="form-control" >
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </form>
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
