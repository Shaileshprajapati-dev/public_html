<?php
session_start();
//if(!isset($_SESSION['user'])){
    ?>
    <!--<script>
        location.replace('index.php');
    </script>-->
    <?php
//}
?>
<div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <!-- <div class="logo-image-small">
            <img src="./assets/img/logo-small.png">
          </div> -->
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          <?= $config['cname'] ?>
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="">
            <a href="home.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="users.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Users</p>
            </a>
          </li>
          <li>
            <a href="emailsettings.php">
              <i class="nc-icon nc-email-85"></i>
              <p>Email Settings</p>
            </a>
          </li>
          <li>
            <a href="settings.php">
              <i class="nc-icon nc-settings"></i>
              <p>Website Settings</p>
            </a>
          </li>
          <li>
            <a href="logout.php">
              <i class="nc-icon nc-button-power"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>