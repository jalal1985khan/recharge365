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
    $query = $con->query("SELECT * FROM `$FPersonTable` WHERE ID = '$FPersonID' AND MOBILE = '$FPersonMobile'");
    $row = $query->fetch_assoc();
    $old_bal = $row[$BalanceType];
    
    $rmoney =(double)$Amount;
    
    $omoney =(double)$old_bal;
    
    
    if($rmoney<=$omoney)
    {
        
        $SPersonOld_bal=="";
        $FPersonOldBalance = (double)$old_bal;
        $query2 = $con->query("SELECT * FROM `$SPersonTable` WHERE ID = '$SPersonID' AND MOBILE = '$SPersonMobile'");
        $row = $query2->fetch_assoc();
        $SPersonOld_bal = $row[$BalanceType];
        $SPersonOldBalance = (double)$SPersonOld_bal;
        $money = (double)$Amount;
        
        
                date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");

      if ($SPersonOld_bal=="") {
        echo json_encode("Failed");
      } 
      else {
            
        
          
            //Update Second person Balance 
             $sum_bal = $SPersonOldBalance+$money;
             $update  = $con->query("UPDATE $SPersonTable SET `$BalanceType`=$sum_bal WHERE ID = '$SPersonID' AND MOBILE = '$SPersonMobile'");
             
             //deduct First person Balance
             $FPersonOldBalance = (double)$old_bal;
             $sub_bal = $FPersonOldBalance-$money;
             $update  = $con->query("UPDATE $FPersonTable SET `$BalanceType`=$sub_bal WHERE ID = '$FPersonID' AND MOBILE = '$FPersonMobile'");
            
             
             $OWNER =   strtoupper($FPersonTable);
             $PERSON =  strtoupper($SPersonTable);
             
             $transId = rand(88999999,99999999999);
              


             $queryX1  = $con->query("INSERT INTO `user_offline_payment`(`OWNER`, `OWNER_ID`, `USER`, `USER_ID`, `AMOUNT`, `BAL_TYPE`, `BEFORE_BAL`, `AFTER_BAL`, `TYPE`, `TIME`, `DATE`, `MOBILE`,`TRANS_ID`,`PASSED_PERSON`,`PASSED_NUMBER`)
                                        VALUES ('$FPersonOwnerStatus','$FPersonOwnerID','$FPersonTable','$FPersonID','$Amount','$BalanceType','$FPersonOldBalance','$sub_bal','Debit','$time','$date','$FPersonMobile','$transId','$SPersonTable','$SPersonMobile')");
             
             
             
             
             
            $queryX2  = $con->query("INSERT INTO `user_offline_payment`(`OWNER`, `OWNER_ID`, `USER`, `USER_ID`, `AMOUNT`, `BAL_TYPE`, `BEFORE_BAL`, `AFTER_BAL`, `TYPE`, `TIME`, `DATE`, `MOBILE`,`TRANS_ID`,`PASSED_PERSON`,`PASSED_NUMBER`)
                                        VALUES ('$FPersonTable','$FPersonID','$SPersonTable','$SPersonID','$Amount','$BalanceType','$SPersonOldBalance','$sum_bal','Credit','$time','$date','$SPersonMobile','$transId','$FPersonTable','$FPersonMobile')");
             
             echo json_encode("Fund Added");
          
      }
        
    
    
    
    }
    else
    {
        echo json_encode("Insufficient Amount");
    }
    
    
    

?>
