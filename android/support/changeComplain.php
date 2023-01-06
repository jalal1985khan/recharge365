<?php

    include("../../includes/config.php");
    // $mobile = $_POST['mobile'];
    // $password = $_POST['password'];
    // $txnID = $_POST['txnID'];
    // $userMobile = $_POST['userMobile'];
    // $statusGiven = $_POST['status'];
    // $statusGiven = strtoupper($statusGiven);
    // $remarks = $_POST['remarks'];
    // $mn = $_POST['mn'];
    // $pass_hash = md5($password);
    // $date = date("Y-m-d");

    $rechargeAmount = $_POST['rechargeAmount'];
    $rechargeStatus = $_POST['rechargeStatus'];
    $amountLeft = $_POST['amountLeft'];
    $logo = $_POST['logo'];
    $dateTime = $_POST['dateTime'];
    $txnID = $_POST['txnID'];
    $operator = $_POST['operator'];
    $mn = $_POST['mn'];
    $opID = $_POST['status'];
    $userType = $_POST['userType'];
    $userNo = $_POST['userMobile'];
    $commAmount = $_POST['commAmount'];
    $remarks = $_POST['remarks'];





if($txnID!=""){

$sql = "INSERT INTO `rc_complaint`(`RC_AMOUNT`, `RC_STATUS`, `AMOUNT_LEFT`, `LOGO`, `DATE_TIME`, `TXN_ID`, `OPERATOR`, `MN`, `OP_ID`, `USER_TYPE`, `USER_NUMBER`, `COMM_AMOUNT`, `REMARK`) VALUES ('$rechargeAmount','$rechargeStatus','$amountLeft','$logo','$dateTime','$txnID','$operator','$userNo','$opID','$userType','$mn','$commAmount','$remarks')";
if(mysqli_query($con,$sql)){
echo "SUCCESS";
}
    else{
echo "SUCCESS";
    }
      



        
    }
    else{
                
        echo "FAILED";
        
    }

        

?>