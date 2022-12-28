<?php
    
    include("config.php");
    
     $mobile = $_POST['MOBILE'];
     $email = $_POST['EMAIL'];
     $table = $_POST['TYPE'];
     $transaction_id = $_POST['TRANSACTIONID'];
     $status = $_POST['STATUS'];
     $id = $_POST['ID'];
     $amount_type=$_POST['AMOUNTTYPE'];
     $balance_recharged = $_POST['AMOUNT'];
     $owner_status = $_POST['OWNERSTATUS'];
     $owner_id = $_POST['OWNERID'];
    
    //  $mobile = "8240193509";
    //  $email = "barbhuiya785@gmail.com";
    //  $table = "masterdistributer";
    //  $transaction_id = "9931";
    //  $status = "Success";
    //  $id = "4";
    //  $amount_type = "RCBAL";
    //  $balance_recharged = "5";
    //  $owner_status = 'admin';
    //  $owner_id = '1';
    

    
    
     
     
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
     

         $balance_rech = (double)$balance_recharged;
         
         if($amount_type=='RCBAL'){
             
        $query = $con->query("SELECT RCBAL FROM $table WHERE ID = '$id' AND MOBILE = '$mobile'");
        $row = $query->fetch_assoc();
 
        $old_bal = $row['RCBAL'];

    
    $old_bal2 = (double)$old_bal;
    $sum_bal = $old_bal2+$balance_rech;

        if($status=="Success"){
                
            $update  = $con->query("UPDATE $table SET `RCBAL`='$sum_bal' WHERE ID='$id' AND MOBILE = '$mobile'");
            
            
            
            $inser_history = $con->query("INSERT INTO `online_upi_wallet`(`OWNER`, `OWNER_ID`, `USER`, `USER_ID`, `TRANS_ID`, `BEFORE_BAL`, `AFTER_BAL`, `AMOUNT`, `DATE`, `TIME`, `STATUS`, `BAL_TYPE`) VALUES ('$owner_status','$owner_id','$table','$id','$transaction_id','$old_bal','$sum_bal','$balance_recharged','$date','$time','$status','$amount_type')");   
    		
    		 if($table!="admin"){
    		 $q = $con->query("SELECT * FROM admin where ID='1'")->fetch_assoc();
             $ms_rcbal = $q['RCBAL'];
             $minus = (double)$ms_rcbal-(double)$balance_rech;
             $update  = $con->query("UPDATE `admin` SET `RCBAL`='$minus' WHERE ID='1'");
             
                         $inser_history = $con->query("INSERT INTO `admin_deduction`(`USER`, `USER_ID`, `USER_MOBILE`, `AMOUNT`, `USER_OLD_BAL`, `USER_NEW_BAL`, `MY_OLD_BAL`, `MY_NEW_BAL`, `DATE`, `TIME`, `BAL_TYPE`,`TRANS_ID`)
                         VALUES ('$table','$id','$mobile','$balance_rech','$old_bal','$sum_bal','$ms_rcbal','$minus','$date','$time','$amount_type','$transaction_id')");  
             
             
    		}
    		echo "Balance Added";
            
        }
        else{
            echo "Something Went Wrong";
        }
        

    
         }
         else if($amount_type=='DMRBAL'){
             
                     $query = $con->query("SELECT DMRBAL FROM $table WHERE ID = '$id' AND MOBILE = '$mobile'");
     $row = $query->fetch_assoc();
 
    $old_bal = $row['DMRBAL'];
    $old_bal2 = (double)$old_bal;
    $sum_bal = $old_bal2+$balance_rech;

        if($status=="Success"){
            
            $update  = $con->query("UPDATE $table SET `DMRBAL`='$sum_bal' WHERE ID = '$id' AND MOBILE = '$mobile'");
            
            $inser_history = $con->query("INSERT INTO `online_upi_wallet`(`OWNER`, `OWNER_ID`, `USER`, `USER_ID`, `TRANS_ID`, `BEFORE_BAL`, `AFTER_BAL`, `AMOUNT`, `DATE`, `TIME`, `STATUS`,`BAL_TYPE`) VALUES ('$owner_status','$owner_id','$table','$id','$transaction_id','$old_bal','$sum_bal','$balance_recharged','$date','$time','$status','$amount_type')");  
    		
    		    		if($table!="admin"){
    		 $q = $con->query("SELECT * FROM admin where ID='1'")->fetch_assoc();
             $ms_rcbal = $q['DMRBAL'];
             $minus = (double)$ms_rcbal-(double)$balance_rech;
             $update  = $con->query("UPDATE `admin` SET `DMRBAL`='$minus' WHERE ID='1'");
             
                         $inser_history = $con->query("INSERT INTO `admin_deduction`(`USER`, `USER_ID`, `USER_MOBILE`, `AMOUNT`, `USER_OLD_BAL`, `USER_NEW_BAL`, `MY_OLD_BAL`, `MY_NEW_BAL`, `DATE`, `TIME`, `BAL_TYPE`,`TRANS_ID`)
                         VALUES ('$table','$id','$mobile','$balance_rech','$old_bal','$sum_bal','$ms_rcbal','$minus','$date','$time','$amount_type','$transaction_id')");  
             
    		}
    		
    		    		echo "Balance Added";
        }
        
        else{
                        echo "Something Went Wrong";
            
        }

    

             
         }
         else{
             
             echo "Something Went Wrong";
         }
    

?>