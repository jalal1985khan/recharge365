<?php

     require("RetailerRegisterFunction.php");
     include("dbConnect.php");

        $mobile = $_POST['mobile'];
        $password = mt_rand(100000 , 900000);
        $pass_hash = md5($password);
        
        
        $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE = '$mobile'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
            
            
                        $row = mysqli_fetch_assoc($result);
                        $email = $row['EMAIL'];
                        
            $message1 = "Dear%20User%%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		sendMessage($mobile,$message1);
           		sendMail($email,$message2);
           		
           		$change = $con->query("UPDATE `admin` SET `PASSWORD`= '$pass_hash' WHERE MOBILE = '$mobile' ");
                echo "Password Changed";       
                mysqli_close($con);
            }
             
                else{
        
        
        
    

       
       
        $mysql_qry = "SELECT * FROM `retailer` WHERE MOBILE = '$mobile'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
            
                        $row = mysqli_fetch_assoc($result);
                        $email = $row['EMAIL'];
                        
            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		sendMessage($mobile,$message1);
           		sendMail($email,$message2);
           		
           		$change = $con->query("UPDATE `retailer` SET `PASSWORD`= '$pass_hash' WHERE MOBILE = '$mobile' ");
                echo "Password Changed"; 
                mysqli_close($con);
            
            }
            else {
                            $mysql_qry = "SELECT * FROM `masterdistributer` WHERE MOBILE = '$mobile'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {  
                        
                        
                        $row = mysqli_fetch_assoc($result);
                        $email = $row['EMAIL'];
                        
            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		sendMessage($mobile,$message1);
           		sendMail($email,$message2);
           		
           		$change = $con->query("UPDATE `masterdistributer` SET `PASSWORD`= '$pass_hash' WHERE MOBILE = '$mobile' ");
                echo "Password Changed";   
                mysqli_close($con);
            
            }
            else {
                            $mysql_qry = "select * FROM distributer WHERE MOBILE = '$mobile'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {  
            
                        $row = mysqli_fetch_assoc($result);
                        $email = $row['EMAIL'];
                        
            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		sendMessage($mobile,$message1);
           		sendMail($email,$message2);
           		
           		$change = $con->query("UPDATE `distributer` SET `PASSWORD`= '$pass_hash' WHERE MOBILE = '$mobile' ");
                echo "Password Changed";   
                mysqli_close($con);
            
            }
            else {
                            $mysql_qry = "select * FROM Api_users WHERE MOBILE = '$mobile'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {  
            
                        $row = mysqli_fetch_assoc($result);
                        $email = $row['EMAIL'];
                        
            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		$message2 = "Dear User Your Password is $password from www.recharges365.com";
           		sendMessage($mobile,$message1);
           		sendMail($email,$message2);
           		
           		$change = $con->query("UPDATE `Api_users` SET `PASSWORD`= '$pass_hash' WHERE MOBILE = '$mobile' ");
                echo "Password Changed";   
                mysqli_close($con);
            
            }
            else {
                    echo "Registered Mobile not found";
                    mysqli_close($con);
                }
            }
        }
    }    
    
                }
        
        


?>