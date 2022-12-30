<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_error" , 1);
include("../../includes/config.php");
include("../../includes/function.php");

// echo "work_page";
if(isset($_POST['send_otp'])){
    $ip = $_POST['ip'];
    $otp = mt_rand(9999 , 100000);
    $api_user = $con->query("select * from Api_users where ID='".$_SESSION['ap_id']."'")->fetch_assoc();
    $api_num = $api_user['MOBILE'];
    $api_email = $api_user['EMAIL'];

		//$message = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
 	//$message2 = "Dear User, Your Password is $password from www.recharges365.com";
		$message = "Dear%20User%20Your%20Password%20is%20$otp%20from%20www.recharges365.com";
 	$message2 = "Dear User, Your Password is $otp from www.recharges365.com";
    // echo $api_num;
    SendMessage($api_num , $message);
    SendMail($api_email , $message2);
    $_SESSION['otp'] = $otp;
}

if(isset($_POST['match_otp'])){
    $otp = $_POST['match_otp'];
    if($otp == $_SESSION['otp']){
        echo 200;
    }else{
        echo 404;
    }
    
}

?>