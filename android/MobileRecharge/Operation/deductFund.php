<?php
include("config.php");

    
    $FPersonMobile = $_POST['FPersonMobile'];
    $FPersonTable = $_POST['FPersonStatus'];
    $FPersonID = $_POST['FPersonID'];
    $FPersonOwnerID = $_POST['FPersonOwnerID'];
    $FPersonOwnerStatus = $_POST['FPersonOwnerStatus'];
    
    $SPersonMobile = $_POST['SPersonMobile'];
    $SPersonTable = $_POST['SPersonStatus'];
    $SPersonID = $_POST['SPersonID'];
    $BalanceType = $_POST['BalanceType'];
    $Amount = $_POST['Amount'];
    
    
    
        date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    
    
    //check balance
    $query = $con->query("SELECT * FROM `$SPersonTable` WHERE ID = '$SPersonID' AND MOBILE = '$SPersonMobile'");
    $row = $query->fetch_assoc();
    $old_bal = $row[$BalanceType];
    
    
    
    if((double)$Amount<=(double)$old_bal)
    {
        
        $FPersonOld_bal=="";
        $SPersonOldBalance = (double)$old_bal;
        $query2 = $con->query("SELECT * FROM `$FPersonTable` WHERE ID = '$FPersonID' AND MOBILE = '$FPersonMobile'");
        $row = $query2->fetch_assoc();
        $FPersonOld_bal = $row[$BalanceType];
        $FPersonOldBalance = (double)$FPersonOld_bal;
        $money = (double)$Amount;
        
        
    
          
            //deduct Second person Balance 
             $sum_bal = $SPersonOldBalance-$money;
             $update  = $con->query("UPDATE $SPersonTable SET `$BalanceType`=$sum_bal WHERE ID = '$SPersonID' AND MOBILE = '$SPersonMobile'");
             
             //update first person Balance
             
             $sub_bal = $FPersonOldBalance+$money;
             $update  = $con->query("UPDATE $FPersonTable SET `$BalanceType`=$sub_bal WHERE ID = '$FPersonID' AND MOBILE = '$FPersonMobile'");
            
             
             $OWNER =   strtoupper($FPersonTable);
             $PERSON =  strtoupper($SPersonTable);
             
             $transId = rand(8899999,999999999999);
              

            //FirstPerson
             $queryX1  = $con->query("INSERT INTO `user_offline_payment`(`OWNER`, `OWNER_ID`, `USER`, `USER_ID`, `AMOUNT`, `BAL_TYPE`, `BEFORE_BAL`, `AFTER_BAL`, `TYPE`, `TIME`, `DATE`, `MOBILE`,`TRANS_ID`,`PASSED_PERSON`,`PASSED_NUMBER`)
                                        VALUES ('$FPersonOwnerStatus','$FPersonOwnerID','$FPersonTable','$FPersonID','$Amount','$BalanceType','$FPersonOldBalance','$sub_bal','Credit','$time','$date','$FPersonMobile','`$transId`','$SPersonTable','$SPersonMobile')");
             
             
             
             //SecondPerson
            $queryX2  = $con->query("INSERT INTO `user_offline_payment`(`OWNER`, `OWNER_ID`, `USER`, `USER_ID`, `AMOUNT`, `BAL_TYPE`, `BEFORE_BAL`, `AFTER_BAL`, `TYPE`, `TIME`, `DATE`, `MOBILE`,`TRANS_ID`,`PASSED_PERSON`,`PASSED_NUMBER`)
                                        VALUES ('$FPersonTable','$FPersonID','$SPersonTable','$SPersonID','$Amount','$BalanceType','$SPersonOldBalance','$sum_bal','Debit','$time','$date','$SPersonMobile','$transId','$FPersonTable','$FPersonMobile')");
             
             echo json_encode("Fund Deducted");
          
        
    
    
    
    }
    else
    {
        echo json_encode("Insufficient Amount");
    }
    
    
    

?>