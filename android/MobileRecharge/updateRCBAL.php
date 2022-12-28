<?php
    
    include("config.php");
    
     $mobile = $_POST['MOBILE'];
     $email = $_POST['EMAIL'];
     $table = $_POST['TYPE'];
     $transaction_id = $_POST['TRANSACTIONID'];
     $status = $_POST['STATUS'];
     $id = $_POST['ID'];
     
     
    $balance_recharged = $_POST['RCBAL'];
     $balance_rech = (double)$balance_recharged;


    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
 
$query = $con->query("SELECT RCBAL FROM $table WHERE EMAIL = '$email' AND MOBILE = '$mobile'");
 $row = $query->fetch_assoc();
 
    $old_bal = $row['RCBAL'];
    $old_bal2 = (double)$old_bal;
    $sum_bal = $old_bal2+$balance_rech;

        if($status=="Success"){
            
            $update  = $con->query("UPDATE $table SET `RCBAL`=$sum_bal WHERE EMAIL = '$email' AND MOBILE = '$mobile'");
        }

    
        $inser_history = $con->query("INSERT INTO `online_recharge`(`USER`,`USER_ID`,`AMOUNT`,`STATUS`,`ORDER_ID`) 
    		VALUES ('$table','$id','$balance_rech','$status','$transaction_id')");
    

?>