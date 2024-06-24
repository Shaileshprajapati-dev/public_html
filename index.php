<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f5a5bc4a23.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
session_start();
include "connection.php";
if(isset($_SESSION['user'])){
    ?>
    <script>
        location.replace('home.php');
    </script>
    <?php
}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username == "" || $password == ""){
      $msg = "Username & Password required! _danger";
    }
    else{
      $userch = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
      if(mysqli_num_rows($userch) > 0){
        $urow = mysqli_fetch_assoc($userch);
        $dbpass = $urow['password'];
        $user_id = $urow['id'];
        $verify = password_verify($password,$dbpass);
        if($verify != 0){
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $user_id;
            $msg = "Logged in Successfully! _success";
            ?>
            <script>location.replace('home.php');</script>
            <?php
        }
        else{
          $msg = "Wrong Password! _danger";
        }
      }
      else{
        $msg = "User does not exsist! _danger";
      }
    }
}
?>
    <div class="container py-3">
        <div class="row mt-5 text-center">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body p-3">
                        <h3>Login</h3>
                        <form action="index.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Enter Username" class="form-control mb-2">
                                <div class="input-group mb-3">
                                <input type="password" id="pass" name="password" class="form-control" placeholder="Enter Password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button id="viewbtn" class="input-group-text" type="button" onclick="showpass();" id="basic-addon2">
                                        <i id="viewicon" class="fa-solid fa-eye-slash"></i>
                                    </button>
                                </div>
                                </div>
                                <input type="submit" name="login" value="Login" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</body>
<script>
    function showpass(){
        document.getElementById('pass').type="text";
        document.getElementById('viewicon').removeAttribute("class");
        document.getElementById('viewicon').setAttribute("class", "fa-solid fa-eye");
        document.getElementById('viewbtn').removeAttribute("onclick");
        document.getElementById('viewbtn').setAttribute("onclick", "hidepass()");
    }
    function hidepass(){
        document.getElementById('pass').type="password";
        document.getElementById('viewicon').removeAttribute("class");
        document.getElementById('viewicon').setAttribute("class", "fa-solid fa-eye-slash");
        document.getElementById('viewbtn').removeAttribute("onclick");
        document.getElementById('viewbtn').setAttribute("onclick", "showpass()");
    }
</script>
</html>