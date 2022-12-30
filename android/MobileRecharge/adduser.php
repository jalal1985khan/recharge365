<?php
include("../../includes/config.php");
require("../common/sendSMS.php");
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

	if($myTable == "MASTERDISTRIBUTOR"){
		//check for masterdistributer email validation
		$mdemail = "SELECT * FROM masterdistributer WHERE  EMAIL='$email'";
		$MDemailCheck = mysqli_fetch_array(mysqli_query($con,$mdemail));
		
		//check for masterdistributer email validation
		$mdmobile = "SELECT * FROM masterdistributer WHERE  MOBILE='$mobile'";
		$MDmobileCheck = mysqli_fetch_array(mysqli_query($con,$mdmobile));
		
		if(!isset($MDemailCheck) && !isset($MDmobileCheck) ){
		
			$MDsql = "INSERT INTO `masterdistributer`(`ID`, `OWNER`, `ADMIN_ID`, `IMAGE`, `NAME`, `MOBILE`, `EMAIL`, `MYKYC`, `SMSBAL`, `DMRBAL`, `RCBAL`, `COMM`, `STATUS`, `ADDRESS`, `STATE`, `CITY`, `CUTTOFFAMOUNT`, `COMM_PACK`, `PASSWORD`, `REGDATE`)
			VALUES ('','$byStatus','$byID','default.jpeg','$name','$mobile','$email','NA','0','0','0','0','Activate','$address','$state','$city','0','$packname','$pass_hash','$date')";
			$run = mysqli_query($con , $MDsql );
			if($run){
			echo 'User Added';    
			}
			else {
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



 

?>