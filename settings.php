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
        $settq = mysqli_query($con,"SELECT * FROM settings");
        while($settings = mysqli_fetch_array($settq)){
            $setname = $settings['key_name'];
            $setvalue = $_POST[$setname];
            $upq = mysqli_query($con,"UPDATE settings SET key_value = '$setvalue' WHERE key_name = '$setname'");
        }
        ?>
        <script>
            location.replace('settings.php');
        </script>
        <?php
    }
    ?>
  <div class="wrapper ">
    <?php include("sidebar.php"); ?>
    <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <?php include("navbar.php") ?>
      <!--<div id="preloader" ></div>-->
      <!-- End Navbar -->
      <div class="content">
        <form class="row" action="settings.php" method="post" >
            <?php
            $getdata = mysqli_query($con,"SELECT * FROM settings");
            while($data = mysqli_fetch_array($getdata)){
                ?>
                <div class="col-lg-4" >
                    <div class="form-group" >
                        <?php
                        if($data['key_name'] == "cname"){
                        ?><lable>Company Name</lable><?php
                        }
                        else if($data['key_name'] == "email"){
                        ?><lable>Default Email</lable><?php
                        }
                        else if($data['key_name'] == "name"){
                        ?><lable>Default User</lable><?php
                        }
                        else if($data['key_name'] == "username"){
                        ?><lable>Mailer Email</lable><?php
                        }
                        else if($data['key_name'] == "password"){
                        ?><lable>Mailer Password</lable><?php
                        }
                        else if($data['key_name'] == "host"){
                        ?><lable>Mailer Host</lable><?php
                        }
                        else if($data['key_name'] == "port"){
                        ?><lable>Mailer Port</lable><?php
                        }
                        else if($data['key_name'] == "mode"){
                        ?><lable>Security Mode</lable><?php
                        }
                        else{
                        ?><label><?= $data['key_name'] ?></label><?php
                        }
                        ?>
                        
                        <input type="text" value="<?= $data['key_value'] ?>" class="form-control" name="<?= $data['key_name'] ?>" >
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-lg-4" >
                <div class="form-group" >
                    <input type="submit" name="save" value="Save" class="btn btn-primary mt-4" >
                </div>
            </div>
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
