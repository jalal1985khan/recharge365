<?php
    
    include("../../includes/config.php");
    $rechargeAmount = $_POST['rechargeAmount'];
    $rechargeStatus = $_POST['rechargeStatus'];
    $amountLeft = $_POST['amountLeft'];
    $logo = $_POST['logo'];
    $dateTime = $_POST['dateTime'];
    $txnID = $_POST['txnID'];
    $operator = $_POST['operator'];
    $mn = $_POST['mn'];
    $opID = $_POST['opID'];
    $userType = $_POST['userType'];
    $userNo = $_POST['userNo'];
    $commAmount = $_POST['commAmount'];
    $remarks = $_POST['remarks'];
    
    if($remarks!=""){
        $sql = "INSERT INTO `rc_complaint`(`RC_AMOUNT`, `RC_STATUS`, `AMOUNT_LEFT`, `LOGO`, `DATE_TIME`, `TXN_ID`, `OPERATOR`, `MN`, `OP_ID`, `USER_TYPE`, `USER_NUMBER`, `COMM_AMOUNT`, `REMARK`) VALUES ('$rechargeAmount','$rechargeStatus','$amountLeft','$logo','$dateTime','$txnID','$operator','$mn','$opID','$userType','$userNo','$commAmount','$remarks')";
        		if(mysqli_query($con,$sql)){
        		
        		        echo "Complain Added";
        		   
        		}
        		else{
           		        echo "Complain Couldn't Add";
        		    
        		}
        
    }



?>