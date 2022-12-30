<?php
include("../../includes/config.php");
include("../common/sendSMS.php");


function SendMessage($mobile, $message){
	$curl = curl_init();
	global $con;
	date_default_timezone_set('Asia/Kolkata');
	$date = date("Y-m-d");
	$time = date("g:i:s A"); 
	$s_api = $con->query("select * from smsApi where STATUS='Activate'")->fetch_assoc();
	$s_url = $s_api['APIURL'];
	$s_snder = $s_api['SENDERNAME'];
	$s_apikey = $s_api['APIKEY'];
	$live_url = "$s_url&message=$message&sendername=$s_snder&smstype=TRANS&numbers=$mobile&apikey=$s_apikey";
				// set our url with curl_setopt()
				curl_setopt($curl, CURLOPT_URL, $live_url);
				
				// return the transfer as a string, also with setopt()
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HTTPGET, 1);
				
				// curl_exec() executes the started curl session
				// $output contains the output string
				$output = curl_exec($curl);
				if($output == FALSE){
					die('Failed'.curl_error($curl));
				}
				$outputObj = json_decode($output, true);
				// print_r($outputObj);
				// close curl resource to free up system resources
				// (deletes the variable made by curl_init)
				curl_close($curl);
						// print_r($data);
			  }


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
// MASTER DISTRIBUTER CODE
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

		 $message1 = "$name%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
		 $message2 = "$name Your Password is $password from www.recharges365.com";
		 SendMessage($mobile,$message1);
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
// MASTER DISTRIBUTER CODE END HERE

		if($myTable == "RETAILER"){   
			//check for retailer email validation
			$retailemail = "SELECT * FROM retailer WHERE  EMAIL='$email'";
			$RemailCheck = mysqli_fetch_array(mysqli_query($con,$retailemail));
			
			//check for retailer email validation
			$retailmobile = "SELECT * FROM retailer WHERE  MOBILE='$mobile'";
			$RmobileCheck = mysqli_fetch_array(mysqli_query($con,$retailmobile ));
				
			if(!isset($RemailCheck) && !isset($RmobileCheck) ){
			
				
				$Rsql = "INSERT INTO `retailer`(`ID`, `OWNER`, `MS_ID`, `DISTRIBUTER`, `IMAGE`, `FNAME`, `MOBILE`, `MYKYC`, `RCBAL`, `DMRBAL`, `SMSBAL`, `REGDATE`, `CUTTOFFAMOUNT`, `COMM_PACK`, `STATUS`, `APIACCESS`, `EMAIL`, `ADDRESS`, `CITY`, `STATE`, `PASSWORD`)
				VALUES('','$byStatus','$byID','$byID','default.jpeg','$name','$mobile','NA','0','0','0','$date','0','$packname','Activate','','$email','$address','$city','$state','$pass_hash')";
				$run = mysqli_query($con , $Rsql );
				if($run){
				echo 'User Added';    
				}
				else {
				echo 'Something went wrong..';
					  }	
			 $message1 = "$name%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
			 $message2 = "$name Your Password is $password from www.recharges365.com";
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
// RETAILER CODE END HERE		
if($myTable == "DISTRIBUTOR"){

	//check for DISTRIBUTOR email validation
	$disemail = "SELECT * FROM distributer WHERE  EMAIL='$email'";
	$DemailCheck = mysqli_fetch_array(mysqli_query($con,$disemail));
	
		
	//check for DISTRIBUTOR email validation
	$dismobile = "SELECT * FROM distributer WHERE  MOBILE='$mobile'";
	$DmobileCheck = mysqli_fetch_array(mysqli_query($con,$dismobile));
	
	if(!isset($DemailCheck) && !isset($DmobileCheck) ){
	$Dsql =	 "INSERT INTO `distributer`(`ID`, `OWNER`, `MS_ID`, `NAME`, `IMAGE`, `MOBILE`, `EMAIL`, `MYKYC`, `SMSBAL`, `RCBAL`, `DMRBAL`, `COMM`, `STATUS`, `ADDRESS`, `STATE`, `CITY`, `CUTTOFFAMOUNT`, `COMM_PACK`, `PASSWORD`, `REGDATE`)
	VALUES('','$byStatus','$byID','$name','default.jpeg','$mobile','$email','NA','0','0','0','0','Activate','$address','$state','$city','0','$packname','$pass_hash','$date')";
	$run = mysqli_query($con , $Dsql );
	if($run){
	echo 'User Added';    
	}
	else {
	echo 'Something went wrong..';
	  }	
	 $message1 = "$name%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
	 $message2 = "$name Your Password is $password from www.recharges365.com";
	 sendMessage($mobile,$message1);
	 sendMail($email,$message2);
				  
	
	}
	else{
		if(isset($DemailCheck)){
		   echo   "Email already exist";
			}
		else if(isset($DmobileCheck)){
				echo  "Mobile already exist";        
			}
			else{
				echo 'Mobile already existEmail already exist';
			}
		
		
	}
	
	}
// DISTRIBUTER CODE END HERE


 

?>