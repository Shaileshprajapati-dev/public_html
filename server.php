<?php 
session_start();
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$config = array();
$setq = mysqli_query($con,"SELECT * FROM settings");
while($setrow = mysqli_fetch_array($setq)){
    $name_key = $setrow['key_name'];
    $value = $setrow['key_value'];
    $config[$name_key] = $value;
}

$mails = array();
$ccs = array();
$mailq = mysqli_query($con,"SELECT * FROM emails");
while($mailrow = mysqli_fetch_array($mailq)){
	$table = $mailrow['number'];
	$email = $mailrow['email'];
	$cc = $mailrow['cc'];
	$mails[$table] = $email;
	$ccs[$table] = $cc;
}


$email = $config['email'];
$name= $config['name'];


for($i=100; $i<151; $i++){
    $table = "new_".$i;
	$getdata = mysqli_query($con,"SELECT MAX(id) AS maxid FROM `$table`");
	$data = mysqli_fetch_assoc($getdata);
	$id = $data['maxid'];
	$gettemp = mysqli_query($con,"SELECT * FROM `$table` WHERE id = '$id'");
	$tempdata = mysqli_fetch_assoc($gettemp);
	$temp = $tempdata['temp'];
	$pid = $id -10;
	$status = $tempdata['status'];
	$delq = mysqli_query($con,"DELETE FROM `$table` WHERE id BETWEEN 0 AND $pid");
	?>
	<div class="col-lg-2" >
		<div class="card m-3"
		<?php
		if($temp < 1 ){
			echo "style='border: 5px solid green;'";
		}
		else if($temp > 0){
			echo "style='border: 5px solid red;'";
		}
		?>
		>
			<div class="card-body p-3 text-center">
				<h6><?= $i ?></h6>
			</div>
		</div>
	</div>
	<?php
  if($status == 0){
    
    require_once "PHPMailer/src/PHPMailer.php";
    require_once "PHPMailer/src/SMTP.php";
    require_once "PHPMailer/src/Exception.php";
    
    
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $config['host'];                        //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $config['username'];                    //SMTP username
        $mail->Password   = $config['password'];                    //SMTP password
        $mail->SMTPSecure = $config['mode'];                        //Enable implicit TLS encryption
        $mail->Port       = $config['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        $mail->setFrom($config['username'], $config['cname']);
    
        //Recipients
        if(!empty($mails[$table])){
            $mail->addAddress($mails[$table]);
        }
        else{
            $mail->addAddress($email,$name);
        }
        
        if(!empty($ccs[$i])){
            $mail->addCC($ccs[$i]);
        }
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $config['cname'].' Alert';
        $mail->Body    = '<h4>The table '.$i.' temperature is '. $temp. '</h4>';
        $mail->AltBody = 'The table '.$i.' temperature is '. $temp;
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    $upq = mysqli_query($con,"UPDATE `$table` SET status = 1 WHERE id = '$id'");
  }
}
