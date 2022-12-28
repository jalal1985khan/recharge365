<?php 

session_start();
error_reporting(0);
require("../dashboard/includes/function.php");

include("../dashboard/includes/config.php");
$res = $con->query("SELECT * FROM `websetting` WHERE ID = 1");
$row = $res->fetch_assoc();
    
$weburl = $row['WEBURL'];
$webname = $row['WEBSITENAME'];

if(isset($_POST['register'])){

    
   // $firstname = $_POST['f_name'];
   // $lastname = $_POST['l_name'];
  //  $email = $_POST['email'];
  //  $mobile = $_POST['mobile'];
 //  $address = $_POST['address'];
 //   $city = $_POST['city'];
 //   $state = $_POST['state'];
  //  $password = mt_rand(100000 , 900000);
  //  $pass_hash = md5($password);
   // if($con === false){
   //	 die("ERROR: Could not connect. " . mysqli_connect_error());
   //	 echo "<script>alert('Not connected')</script>";
     }
    // else{
    	//$query1 = "select * FROM retailer WHERE MOBILE = '".$mobile. "' OR EMAIL = '".$email. "'";
    	//$result = mysqli_query($con, $query1);
    //	$row=mysqli_num_rows($result);
   //	if($row == 0){
    		$query2 = "INSERT INTO `retailer`(`OWNER`, `MS_ID`, `DISTRIBUTER`,`IMAGE`, `FNAME`, `MOBILE`, `RCBAL`, `DMRBAL`, `SMSBAL`, `REGDATE`, `CUTTOFFAMOUNT`, `COMM_PACK`, `STATUS`, `APIACCESS`, `EMAIL`, `ADDRESS`, `CITY`, `STATE`, `PASSWORD`) 
    		VALUES ('ADMIN','1' ,'' , 'default.jpeg' ,'$firstname' , '$mobile' , '0', '0', '0',  '$date', '$camount','', 'Activate', '$apiaccess', '$email', '$address' , '$city' , '$state' , '$pass_hash') ";
     	
     		//if($run_query = mysqli_query($con , $query2 )){
     		//$message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		//$message2 = "Dear user Your Password is $password from www.recharges365.com";
   	       // echo "<script> alert('Account Created') 
           	   //     location.replace('../login.php')
   	        </script>";
           		
           		//sendMessage($mobile,$message1);
           		//sendMail($email,$message2);
     		    
     		}else{
     		    
        		echo "<script>alert('Error')</script>";
     		}
     		
	}
	else{
		echo "<script>alert('User already exists')</script>";
	}
	}

   }
?>
