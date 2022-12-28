<?php

        $user = $_POST['user'];
        $distributer = $_POST['distributer'];
        $firstname = $_POST['name'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $address = $_POST['ADDRESS'];
        $packname = $_POST['PACKNAME'];
        $state = '';
        $city = '';
        include("config.php");
        include("function.php");
        $user = strtoupper($user);

    if( $user == "RETAILER"){
        $password = mt_rand(100000 , 900000);
            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
        $pass_hash = md5($password);
      $query = "SELECT * FROM `distributer` WHERE `MOBILE` = '$mobile' ";
        $query2 = $con->query("SELECT * FROM `masterdistributer` WHERE `MOBILE` = '$mobile' ")->num_rows;
        $query3 = $con->query("SELECT * FROM `retailer` WHERE `MOBILE` = '$mobile' ")->num_rows;
        $run = mysqli_query($con , $query );
        if(mysqli_num_rows($run) < 1 && $query2 != 1 && $query3 != 1) {
                $date = date("Y-m-d");
                if($distributer == ""){
                    $owner = "MASTERDISTRIBUTER";
                    $ms_id = $id;
                }else{
                    $owner = "DISTRIBUTER";
                    $ms_id = "";
                }
            	$query2 = "INSERT INTO `retailer`(`OWNER` , `MS_ID`,`DISTRIBUTER`, `FNAME`,`IMAGE`, `REGDATE` ,  `MOBILE`, `EMAIL`, `SMSBAL`, `RCBAL`, `DMRBAL`, `COMM_PACK`, `CUTTOFFAMOUNT`, `STATUS`, `APIACCESS`, `ADDRESS`, `CITY`,`STATE`,  `PASSWORD`) 
            	VALUES('$owner' , '$ms_id' , '$distributer' , '$firstname' ,'default.jpeg', '$date' , '$mobile' , '$email', '0', '0', '0',  '0', '10', 'Activate', '', '$address' , '$city' , '$state' , '$pass_hash') ";
                 		$run_query = mysqli_query($con , $query2 );
                if($run_query){
       		            SendMessage($mobile,$message);
       		            SendMail($email,$message2);
                    echo json_encode("Data Inserted");
                }else{
                    echo json_encode("Data not Inserted");
                } 
        }else{
                    echo json_encode("Mobile Number Already Exist");
        }
    }else{
          $password = mt_rand(100000 , 900000);
            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
     	
        $pass_hash = md5($password);
       $query = "SELECT * FROM `distributer` WHERE `MOBILE` = '$mobile' ";
        $query2 = $con->query("SELECT * FROM `masterdistributer` WHERE `MOBILE` = '$mobile' ")->num_rows;
        $query3 = $con->query("SELECT * FROM `retailer` WHERE `MOBILE` = '$mobile' ")->num_rows;
        $run = mysqli_query($con , $query );
        if(mysqli_num_rows($run) < 1 && $query2 != 1 && $query3 != 1) {
                $ms_id = $id;
                $date = date("Y-m-d");
                // echo "work".$ms_id."";
            	$query2 = "INSERT INTO `distributer`(`OWNER` ,`MS_ID` , `NAME`, `IMAGE` ,  `MOBILE`, `EMAIL`, `SMSBAL`, `RCBAL`, `DMRBAL`, `COMM`,  `STATUS`, `ADDRESS`, `STATE`, `CITY`, `CUTTOFFAMOUNT`, `PASSWORD` , `REGDATE`) 
            	VALUES ('MASTERDISTRIBUTER' , '$ms_id' , '$name' , 'default.jpeg' , '$mobile' , '$email', '0', '0', '0',  '0', 'Activate',  '$address', '$state' ,'$city','0' , '$pass_hash' , '$date') ";
            	
            	
                 		$run_query = mysqli_query($con , $query2);
                if($run_query){
       		            SendMessage($mobile,$message);
       		            SendMail($email,$message2);
                    echo json_encode("Data Inserted");
                }else{
                    echo json_encode("Data Not Inserted");
                } 
        }else{
                echo json_encode("Mobile Number Already Exist");
        }
    }
    
?>