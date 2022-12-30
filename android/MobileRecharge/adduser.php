<?php
include("config.php");
require("RetailerRegisterFunction.php");
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

if($myTable == "RETAILER"){   
//check for retailer email validation
$retailemail = "SELECT * FROM retailer WHERE  EMAIL='$email'";
$RemailCheck = mysqli_fetch_array(mysqli_query($con,$retailemail));

//check for retailer email validation
$retailmobile = "SELECT * FROM retailer WHERE  MOBILE='$mobile'";
$RmobileCheck = mysqli_fetch_array(mysqli_query($con,$retailmobile ));
	
if(!isset($RemailCheck) && !isset($RmobileCheck) ){

$Rsql =	 "INSERT INTO retailer (OWNER, MS_ID, DISTRIBUTER, IMAGE, FNAME, MOBILE, MYKYC, RCBAL, DMRBAL, SMSBAL, REGDATE, CUTTOFFAMOUNT, COMM_PACK, STATUS, APIACCESS, EMAIL, ADDRESS, CITY, STATE, PASSWORD
)
 VALUES ('$byStatus','$byID' ,'$byID' , 'default.jpeg' ,'$name' , '$mobile' , '0', '0', '0','0', '$date', '','$packname', 'Activate', '', '$email', '$address' , '$city' , '$state' , '$pass_hash') "; 
	
if ($con->query($Rsql) === TRUE) {
  echo 'User Added';
} else {
  echo 'Something went wrong..';
}
 $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		
          		sendMessage($mobile,$message1);
          		sendMail($email,$message2);
          	
}
else{
    if(isset($RemailCheck)){
        echo   "Email already exist";
        }
else if(isset($RmobileCheck)){
                echo  "Mobile already exist";        
        }
else{
            echo 'Mobile already existEmail already exist';
        }
    
    
}
	
}
// retailer end here



if($myTable == "DISTRIBUTOR"){

//check for DISTRIBUTOR email validation
$disemail = "SELECT * FROM distributer WHERE  EMAIL='$email'";
$DemailCheck = mysqli_fetch_array(mysqli_query($con,$disemail));

	
//check for DISTRIBUTOR email validation
$dismobile = "SELECT * FROM distributer WHERE  MOBILE='$mobile'";
$DmobileCheck = mysqli_fetch_array(mysqli_query($con,$dismobile));

if(!isset($DemailCheck) && !isset($DmobileCheck) ){
 
$Dsql =	 "INSERT INTO distributer (ID,  OWNER , MS_ID , NAME, IMAGE , MOBILE , EMAIL, MYKYC , SMSBAL , RCBAL , DMRBAL , COMM, STATUS , ADDRESS , STATE , CITY , CUTTOFFAMOUNT ,COMM_PACK, PASSWORD , REGDATE) VALUES ('','$byStatus' , '$byID' , '$name' , 'default.jpeg' , '$mobile' , '$email', '0', '0', '0',  '0','0', 'Activate',  '$address', '$state' ,'$city','0' , '$packname','$pass_hash' , '$date') ";

if ($con->query($Dsql) === TRUE) {
    echo 'User Added';
  } else {
    echo 'Something went wrong..';
  }
 $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		
          		sendMessage($mobile,$message1);
          		sendMail($email,$message2);
          	

}
else{
    if(isset($DemailCheck)){
       echo   "Email already exist";
        }
    else if(isset($DmobileCheck)){
               // echo  "Mobile already exist";        
        }
        else{
            //echo 'Mobile already existEmail already exist';
        }
    
    
}

}
// distributer end here
if($myTable == "MASTERDISTRIBUTOR"){
//check for masterdistributer email validation
$mdemail = "SELECT * FROM masterdistributer WHERE  EMAIL='$email'";
$MDemailCheck = mysqli_fetch_array(mysqli_query($con,$mdemail));

//check for masterdistributer email validation
$mdmobile = "SELECT * FROM masterdistributer WHERE  MOBILE='$mobile'";
$MDmobileCheck = mysqli_fetch_array(mysqli_query($con,$mdmobile));

if(!isset($MDemailCheck) && !isset($MDmobileCheck) ){

$MDsql = "INSERT INTO masterdistributer (OWNER , ADMIN_ID , NAME , IMAGE, MOBILE , EMAIL , SMSBAL, RCBAL , DMRBAL, COMM, STATUS, ADDRESS, STATE, CITY, CUTTOFFAMOUNT, PASSWORD, REGDATE, COMM_PACK) VALUES ('$byStatus' , '$byID' , '$name' , 'default.jpeg' , '$mobile' , '$email', '0', '0', '0',  '0', 'Activate',  '$address', '$state' ,'$city','0' , '$pass_hash' , '$date','$packname') ";     

if ($con->query($MDsql) === TRUE) {
    echo 'User Added';
  } else {
    echo 'Something went wrong..';
  }
 $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		
          		sendMessage($mobile,$message1);
          		sendMail($email,$message2);
          	
}
else{
    if(isset($MDemailCheck)){
        echo   "Email already exist";
        }
    else if(isset($MDmobileCheck)){
                echo  "Mobile already exist";        
        }
        else{
            echo 'Mobile already existEmail already exist';
        }
    
    
}		
}	
// master distributer end here
if($myTable == "APIUSER"){
//check for Api_users email validation
$apiemail = "SELECT * FROM Api_users WHERE  EMAIL='$email'";
$APIemailCheck = mysqli_fetch_array(mysqli_query($con,$apiemail));

//check for Api_users email validation
$apimobile = "SELECT * FROM Api_users WHERE  MOBILE='$mobile'";
$APImobileCheck = mysqli_fetch_array(mysqli_query($con,$apimobile));

if(!isset($APIemailCheck) && !isset($APImobileCheck) ){

$APIsql = "INSERT INTO Api_users (IMAGE, NAME, MOBILE, EMAIL, PASSWORD, RCBAL, DMRBAL, SMSBAL, COMM_PACK, API_KEY, OWNER, DATE, IP, STATE, ADDRESS, STATUS`) VALUES ('default.jpeg' ,'$name' , '$mobile', '$email','$pass_hash', '0', '0', '0', '$packname','','Admin', '000-00-00','','','$address','ACTIVE') ";  

if ($con->query($APIsql) === TRUE) {
    echo 'User Added';
  } else {
    echo 'Something went wrong..';
  }
 $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		
          		sendMessage($mobile,$message1);
          		sendMail($email,$message2);
          	
}
else{
    if(isset($APIemailCheck)){
        echo   "Email already exist";
        }
    else if(isset($APImobileCheck)){
                echo  "Mobile already exist";        
        }
        else{
            echo 'Mobile already existEmail already exist';
        }
    
    
}	
	

}
?>