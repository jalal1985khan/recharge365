<?php
include("../../includes/config.php");
//require("RetailerRegisterFunction.php");
date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    $name = $_POST['NAME'];
	$email = $_POST['EMAIL'];
	$mobile = $_POST['MOBILE'];
	$myTable = $_POST['MYTABLE'];
	$byID = $_POST['BYID'];
	$byStatus = $_POST['BYSTATUS'];
	$toStatus = $_POST['TOSTATUS'];
	$myID = $_POST['MYID'];
	$myStatus = $_POST['MYSTATUS'];
    $address = $_POST['ADDRESS'];
    $packname = $_POST['PACKNAME'];
    $password = $password = mt_rand(100000 , 900000);
	$pass_hash = md5($password);
    $temp_array = array();
	if($byStatus == "" && $byID ==""){
	    $byStatus = $myStatus;
	    $byID = $myID;	    
	}

$MDsql = "INSERT INTO `masterdistributer`(`ID`, `OWNER`, `ADMIN_ID`, `IMAGE`, `NAME`, `MOBILE`, `EMAIL`, `MYKYC`, `SMSBAL`, `DMRBAL`, `RCBAL`, `COMM`, `STATUS`, `ADDRESS`, `STATE`, `CITY`, `CUTTOFFAMOUNT`, `COMM_PACK`, `PASSWORD`, `REGDATE`)
VALUES ('','$byStatus','$byID','default.jpeg','$name','$mobile','$email','NA','0','0','0','0','Activate','$address','$state','$city','0','$packname','$pass_hash','$date')";
$run = mysqli_query($con , $MDsql );
if($run){
echo 'User Added';    
}
else {
echo 'Something went wrong..';
	  }
 

?>