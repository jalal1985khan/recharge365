<?php

        require("RetailerRegisterFunction.php");
       

           include("dbConnect.php");



    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");

    
	//$name = $_POST['FNAME'];
  $name = mysqli_real_escape_string($con,trim($_POST['FNAME']));
  //  $email = $_POSTEM['EMAIL'];
 // $email = mysqli_real_escape_string($con,trim($_POST['EMAIL']));


	$check_email = trim(htmlspecialchars($_POST['EMAIL']));
	$email = filter_var($check_email, FILTER_VALIDATE_EMAIL);






	//$mobile = $_POST['MOBILE'];
 $number = mysqli_real_escape_string($con,trim($_POST['MOBILE']));

	$mobile = filter_var($number, FILTER_VALIDATE_INT);





	$address = $_POST['ADDRESS'];
	$password = $password = mt_rand(100000 , 900000);
    $city = $_POST['city'];
    $state = $_POST['state'];


	$pass_hash = md5($password);
	
		if($address == '' || $email == '' || $mobile =='' || $name =='')
		{
	
		echo "please fill all values";

		}
		
		
		
		
		else{
		    
		    	$sql3 = "SELECT * FROM retailer WHERE  MOBILE='$mobile'";
		
		$checkmobile = mysqli_fetch_array(mysqli_query($con,$sql3));
		if(isset($checkmobile)){
			
						echo "mobile already exist";
						

		}
		    

		$sql = "SELECT * FROM retailer WHERE  EMAIL='$email'";

	        $check = mysqli_fetch_array(mysqli_query($con,$sql));

		if(isset($check)){

		echo "email already exist";

		}
		
		
		
		
		elseif(!isset($check) && !isset($checkmobile)){
		    
		    
		
            $sql9 = "INSERT INTO `retailer`(`OWNER`, `MS_ID`, `DISTRIBUTER`,`IMAGE`, `FNAME`, `MOBILE`, `RCBAL`, `DMRBAL`, `SMSBAL`, `REGDATE`, `CUTTOFFAMOUNT`, `COMM_PACK`, `STATUS`, `APIACCESS`, `EMAIL`, `ADDRESS`, `CITY`, `STATE`, `PASSWORD`) 
    		VALUES ('ADMIN','1' ,'' , 'default.jpeg' ,'$name' , '$mobile' , '0', '0', '0',  '$date', '','', 'Activate', '', '$email', '$address' , '$city' , '$state' , '$pass_hash') ";
    		
		
		

		if(mysqli_query($con,$sql9)){

            
          //  $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		//$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		
           		sendMessage($mobile,$message1);
           		sendMail($email,$message2);
           		echo "Sign Up Success";
	
	        }
		else{
				
			echo "oops! Please try again!";
			
		
		}
}
		
		
			
	       // mysqli_close($con);

		}
	?>
		