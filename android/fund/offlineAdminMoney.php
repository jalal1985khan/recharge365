<?php
    include("../../includes/config.php");
    $mobile = $_POST['usermobile'];
    $work = $_POST['work'];
    $id = $_POST['userid'];
    $status = $_POST['userstatus'];
    $amount = $_POST['amount'];
    $balType = $_POST['balType'];
    $password = $_POST['password'];
    $randstring = $_POST['transID'];  
    $pass_hash = md5($password);
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");

    
    
    if($status=="admin"){
        
        if($balType=="RCBAL"){
            
                $details = $con->query("select * from `admin` where MOBILE='$mobile' and PASSWORD='$pass_hash'")->fetch_assoc();
        $rcBal = $details['RCBAL'];
        
        if($work=="add"){
            
            $sum_bal  =(float)$rcBal+(float)$amount;
            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$sum_bal' WHERE MOBILE = '$mobile' AND PASSWORD = '$pass_hash'");

            if(mysqli_affected_rows($con)>0)
            {
                             $inser_history = $con->query("INSERT INTO `admin_offline_wallet`(`USER`, `USER_ID`, `AMOUNT`, `DATE`, `BEFORE_BAL`, `AFTER_BAL`, `BAL_TYPE`, `TIME`, `STATUS`)
                                                                                    VALUES ('admin','$id','$amount','$date','$rcBal','$sum_bal','RCBAL','$time','Credit')");                   
        
    
                    echo "Fund Added";
                
            }
	       else
	            {
	                echo "Fund Couldn't Add";
	            }
            
            
        }
        else if($work=="deduct"){
            
            $ded_bal  =(double)$rcBal-(double)$amount;
                        mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$ded_bal' WHERE MOBILE = '$mobile' AND PASSWORD = '$pass_hash'");
            
            if(mysqli_affected_rows($con)>0)
            {
                
                 $inser_history = $con->query("INSERT INTO `admin_offline_wallet`(`USER`, `USER_ID`, `AMOUNT`, `DATE`, `BEFORE_BAL`, `AFTER_BAL`, `BAL_TYPE`, `TIME`, `STATUS`)
                                                                                    VALUES ('admin','$id','$amount','$date','$rcBal','$ded_bal','RCBAL','$time','Debit')");                   

                
                echo "Fund deducted";
                
            }
	       else
	            {
	                echo "Fund Couldn't deduct";
	            }
            
        }    
            
            
        }
        
        else if($balType=="DMRBAL"){
            
                $details = $con->query("select * from `admin` where MOBILE='$mobile' and PASSWORD='$pass_hash'")->fetch_assoc();
        $dmrBal = $details['DMRBAL'];
        
        if($work=="add"){
            
            $sum_bal  =(float)$dmrBal+(float)$amount;
            mysqli_query($con,"UPDATE `admin` SET `DMRBAL`='$sum_bal' WHERE MOBILE = '$mobile' AND PASSWORD = '$pass_hash'");
            
            if(mysqli_affected_rows($con)>0)
            {
                
                
                 $inser_history = $con->query("INSERT INTO `admin_offline_wallet`(`USER`, `USER_ID`, `AMOUNT`, `DATE`, `BEFORE_BAL`, `AFTER_BAL`, `BAL_TYPE`, `TIME`, `STATUS`)
                                                                                    VALUES ('admin','$id','$amount','$date','$dmrBal','$sum_bal','DMRBAL','$time','Credit')");  
            
                
                echo "Fund Added";
                
            }
	       else
	            {
	                echo "Fund Couldn't Add";
	            }
            
            
        }
        else if($work=="deduct"){
            
            $ded_bal  =(double)$dmrBal-(double)$amount;
                        mysqli_query($con,"UPDATE `admin` SET `DMRBAL`='$ded_bal' WHERE MOBILE = '$mobile' AND PASSWORD = '$pass_hash'");
            
            if(mysqli_affected_rows($con)>0)
            {
                                                           $inser_history = $con->query("INSERT INTO `admin_offline_wallet`(`USER`, `USER_ID`, `AMOUNT`, `DATE`, `BEFORE_BAL`, `AFTER_BAL`, `BAL_TYPE`, `TIME`, `STATUS`)
                                                                                    VALUES ('admin','$id','$amount','$date','$dmrBal','$ded_bal','DMRBAL','$time','Debit')");

                
                echo "Fund deducted";
                
            }
	       else
	            {
	                echo "Fund Couldn't deduct";
	            }
            
        }    
            
            
        }
        
        
        
        
    }
    
    else{
        
        echo "Failed";
    }





?>