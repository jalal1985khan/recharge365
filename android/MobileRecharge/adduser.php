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
	
	$result="Nothing";
	
	        $temp_array = array();
	if($byStatus == "" && $byID ==""){
	    $byStatus = $myStatus;
	    $byID = $myID;
	    
	}
		    
		    

		$sql = "SELECT * FROM retailer WHERE  EMAIL='$email'";

	        $check = mysqli_fetch_array(mysqli_query($con,$sql));

		if(isset($check)){

		$result =  "Email already exist";
	

		}
		
		
		
		else{
		    
		$sql3 = "SELECT * FROM retailer WHERE  MOBILE='$mobile'";
		
		$checkmobile = mysqli_fetch_array(mysqli_query($con,$sql3));
		if(isset($checkmobile)){
			
			$result = "Mobile already exist";
						
		}
		else
		{
		 
		 		$sql4 = "SELECT * FROM distributer WHERE  MOBILE='$mobile'";
		
		$checkmobile2 = mysqli_fetch_array(mysqli_query($con,$sql4));
		if(isset($checkmobile2)){
			
						$result = "Mobile already exist";
						

		}
		
		else {
		    
		    
		    
		    		$sql5 = "SELECT * FROM distributer WHERE  EMAIL='$email'";

	        $check2 = mysqli_fetch_array(mysqli_query($con,$sql5));

		if(isset($check2)){

			$result = "Email already exist";

		}
		
		
		else{
		    
		    
		    				$sql6 = "SELECT * FROM masterdistributer WHERE  MOBILE='$mobile'";
		
		$checkmobile3 = mysqli_fetch_array(mysqli_query($con,$sql6));
		if(isset($checkmobile3)){
			
						$result = "Mobile already exist";
						

		}
		else{
		    
		    		$sql7 = "SELECT * FROM masterdistributer WHERE  EMAIL='$email'";

	        $check3 = mysqli_fetch_array(mysqli_query($con,$sql7));

		if(isset($check3)){

		$result = "Email already exist";

		}
		
		
		else{
		    
		    				$sql8 = "SELECT * FROM Api_users WHERE  MOBILE='$mobile'";
		
		$checkmobile4 = mysqli_fetch_array(mysqli_query($con,$sql8));
		if(isset($checkmobile4)){
			
						$result = "Mobile already exist";
						

		}
	    
	    else{
	        
	        $sqlX = "SELECT * FROM Api_user WHERE  EMAIL='$email'";

	        $check4 = mysqli_fetch_array(mysqli_query($con,$sqlX));

		if(isset($check4)){

		$result = "Email already exist";

		}
		
		
		else {
		    
		    		if(!isset($check) && !isset($checkmobile) && !isset($check2) && !isset($checkmobile2) && !isset($check3) && !isset($checkmobile3) && !isset($check4) && !isset($checkmobile4)){
		    
		    
		    
		    if($myTable == "RETAILER"){
		        
		    $sql9 = "INSERT INTO `retailer`(`OWNER`, `MS_ID`, `DISTRIBUTER`,`IMAGE`, `FNAME`, `MOBILE`, `RCBAL`, `DMRBAL`, `SMSBAL`, `REGDATE`, `CUTTOFFAMOUNT`, `COMM_PACK`, `STATUS`, `APIACCESS`, `EMAIL`, `ADDRESS`, `CITY`, `STATE`, `PASSWORD`) 
    		VALUES ('$byStatus','$byID' ,'$byID' , 'default.jpeg' ,'$name' , '$mobile' , '0', '0', '0',  '$date', '','$packname', 'Activate', '', '$email', '$address' , '$city' , '$state' , '$pass_hash') ";    
		        
		    }
		    
		    		    if($myTable == "DISTRIBUTOR"){
		        
		                	$sql9 = "INSERT INTO `distributer`(`OWNER` ,`MS_ID` , `NAME`, `IMAGE` ,  `MOBILE`, `EMAIL`, `SMSBAL`, `RCBAL`, `DMRBAL`, `COMM`,  `STATUS`, `ADDRESS`, `STATE`, `CITY`, `CUTTOFFAMOUNT`, `PASSWORD` , `REGDATE`,`COMM_PACK`) 
            	VALUES ('$byStatus' , '$byID' , '$name' , 'default.jpeg' , '$mobile' , '$email', '0', '0', '0',  '0', 'Activate',  '$address', '$state' ,'$city','0' , '$pass_hash' , '$date','$packname') ";    
		        
		    }
		    
		    		    		    if($myTable == "MASTERDISTRIBUTOR"){
		        
		                	$sql9 = "INSERT INTO `masterdistributer`(`OWNER` ,`ADMIN_ID` , `NAME`, `IMAGE` ,  `MOBILE`, `EMAIL`, `SMSBAL`, `RCBAL`, `DMRBAL`, `COMM`,  `STATUS`, `ADDRESS`, `STATE`, `CITY`, `CUTTOFFAMOUNT`, `PASSWORD` , `REGDATE`,`COMM_PACK`) 
            	VALUES ('$byStatus' , '$byID' , '$name' , 'default.jpeg' , '$mobile' , '$email', '0', '0', '0',  '0', 'Activate',  '$address', '$state' ,'$city','0' , '$pass_hash' , '$date','$packname') ";     
		        
		    }
		    		    		    if($myTable == "APIUSER"){
 
    		                
    		
		    $sql9 = "INSERT INTO `Api_users`(`IMAGE`, `NAME`, `MOBILE`, `EMAIL`, `PASSWORD`, `RCBAL`, `DMRBAL`, `SMSBAL`, `COMM_PACK`, `API_KEY`, `OWNER`,`DATE`, `IP`, `STATE`,`ADDRESS`,`STATUS`) VALUES ('default.jpeg' ,'$name' , '$mobile', '$email','$pass_hash', '0', '0', '0', '$packname','','Admin', '000-00-00','','','$address','ACTIVE') ";    
		        
		    }
		    
		    
		    
    		
		
		

		    if(mysqli_query($con,$sql9)){
		        
		        
               $result = "User Added";
            
            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		
          		sendMessage($mobile,$message1);
          		sendMail($email,$message2);
          	
	
	        }
		else{
				
			$result = "Something went wrong..";
			
		
		}
    }
		    
		    
		}
	        
	        
	    }	
	
		    
		    
		}
		    
		    
		}
	        	    
		    
	
		}
		    
		    
		}
		    
		    
		}
		    
		    
		    
		    
		}
		
		

	
		
		
		
		
		
	
		echo $result;

?>