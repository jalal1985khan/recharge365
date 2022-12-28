<?php
session_start();
include("config.php");
error_reporting(E_ALL);
ini_set('display_errors' , 1);

 //myrc call back
if(isset($_GET['txid'])){
    $tx_id = $_GET['txid'];
    $status = $_GET['status'];
    $op_id = $_GET['opid'];
    
    //refund
    if($status == 'Failed' || $status =='Failure'){
     $recharge = $con->query("select * from recharge_history where ORDER_ID='$tx_id' and API_NAME='MYRC'")->fetch_assoc();
     $user_type = $recharge['PERSON'];
     $user_id = $recharge['PERSON_ID'];
     if($user_type == "MASTERDISTRIBUTER"){
         $q = $con->query("SELECT * FROM masterdistributer where ID='$rech_person_id'")->fetch_assoc();
         $ms_ctof = $q['CUTTOFFAMOUNT'];
         $ms_comm = $q['COMM_PACK'];
         $ms_rcbal = $q['RCBAL'];
           $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' , TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE ORDER_ID='$tx_id' and API_NAME='MYRC'");
            }
       }else if($user_type == "DISTRIBUTER"){
           $q = $con->query("SELECT * FROM distributer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
             $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE distributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' , TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE ORDER_ID='$tx_id' and API_NAME='MYRC'");
            }
                        
       }else if($user_type == "retailer"){
           $q = $con->query("SELECT * FROM retailer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE retailer set RCBAL='$am3' where ID='$rech_person_id'")){
              $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' , TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE ORDER_ID='$tx_id' and API_NAME='MYRC'");  
            }
       }
       
    }
    else{
        if($con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' WHERE ORDER_ID='$tx_id' and API_NAME='MYRC'")){
            echo "Updated";
        }
    }
}

//cryushrecharge
if(isset($_GET['APITransID'])){
    $api_trans = $_GET['APITransID'];
    $status = $_GET['Status'];
    $op_id = $_GET['OperatorRef'];
    $trans_id = $_GET['TransID'];
    $error_code = $_GET['ErrorCode'];
    // $amount = $_GET['Amount'];
    
    //refund 
    if($status == 'Failed' || $status =='Failure'){
     $recharge = $con->query("select * from recharge_history where TRANS_ID='$api_trans' and ORDER_ID='$trans_id' and API_NAME='CRYUSH_RECHARGE'")->fetch_assoc();
        $user_type = $recharge['PERSON'];
        $rech_person_id = $recharge['PERSON_ID'];
        $op_name = $recharge['OP'];
        $amount = $recharge['AMOUNT'];
     if($user_type == "MASTERDISTRIBUTER"){
         $q = $con->query("SELECT * FROM masterdistributer where ID='$rech_person_id'")->fetch_assoc();
         $ms_ctof = $q['CUTTOFFAMOUNT'];
         $ms_comm = $q['COMM_PACK'];
         $ms_rcbal = $q['RCBAL'];
           $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE TRANS_ID='$api_trans' and ORDER_ID='$trans_id' and API_NAME='CRYUSH_RECHARGE'");            }
       }else if($user_type == "DISTRIBUTER"){
           $q = $con->query("SELECT * FROM distributer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
             $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE distributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE TRANS_ID='$api_trans' and ORDER_ID='$trans_id' and API_NAME='CRYUSH_RECHARGE'");            }
                        
       }else if($user_type == "retailer"){
           $q = $con->query("SELECT * FROM retailer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
            //  echo $ms_rcbal;
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            //   print_r($q2);
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            // echo $am;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            // echo $am3;
            if($con->query("UPDATE retailer set RCBAL='$am3' where ID='$rech_person_id'")){
				$con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE TRANS_ID='$api_trans' and ORDER_ID='$trans_id' and API_NAME='CRYUSH_RECHARGE'");            }
           }
       
    }
    else{
     if($con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' WHERE TRANS_ID='$api_trans' and ORDER_ID='$trans_id' and API_NAME='CRYUSH_RECHARGE'")){
        echo "Updated";
        }
    }
    
    
}

//mrobotic
if(isset($_POST['lapu_id'])){
    $txn_id = $_POST['tnx_id'];
    $mobile = $_POST['mobile_no'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];
    $op_id = $_POST['response'];
    
        //refund 
    if($status == 'Failed' || $status =='Failure'){
     $recharge = $con->query("select * from recharge_history WHERE TRANS_ID='$api_trans' and NUMBER='$mobile' and AMOUNT='$amount' and API_NAME='MROBOTIC'")->fetch_assoc();
        $user_type = $recharge['PERSON'];
        $rech_person_id = $recharge['PERSON_ID'];
        $op_name = $recharge['OP'];
        $amount = $recharge['AMOUNT'];
     if($user_type == "MASTERDISTRIBUTER"){
         $q = $con->query("SELECT * FROM masterdistributer where ID='$rech_person_id'")->fetch_assoc();
         $ms_ctof = $q['CUTTOFFAMOUNT'];
         $ms_comm = $q['COMM_PACK'];
         $ms_rcbal = $q['RCBAL'];
           $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE TRANS_ID='$api_trans' and NUMBER='$mobile' and AMOUNT='$amount' and API_NAME='MROBOTIC'");            }
       }else if($user_type == "DISTRIBUTER"){
           $q = $con->query("SELECT * FROM distributer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
             $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE distributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE TRANS_ID='$api_trans' and NUMBER='$mobile' and AMOUNT='$amount' and API_NAME='MROBOTIC'");            }
                        
       }else if($user_type == "retailer"){
           $q = $con->query("SELECT * FROM retailer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
            //  echo $ms_rcbal;
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            //   print_r($q2);
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            // echo $am;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            // echo $am3;
            if($con->query("UPDATE retailer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2'WHERE TRANS_ID='$api_trans' and NUMBER='$mobile' and AMOUNT='$amount' and API_NAME='MROBOTIC'");            }
           }
       
    }
    else{
     if($con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' WHERE TRANS_ID='$api_trans' and NUMBER='$mobile' and AMOUNT='$amount' and API_NAME='MROBOTIC'")){
        echo "Updated";
        }
    }
}

//allinidatoppup
if(isset($_POST['Client_ID'])){
    $trans_id = $_POST['transid'];
    $status = $_POST['status'];
    $op_id = $_POST['optransid'];

        //refund 
    if($status == 'Failed' || $status =='Failure'){
     $recharge = $con->query("select * from recharge_history WHERE TRANS_ID='$trans_id' and API_NAME='ALLINDIATOPUP'")->fetch_assoc();
        $user_type = $recharge['PERSON'];
        $rech_person_id = $recharge['PERSON_ID'];
        $op_name = $recharge['OP'];
        $amount = $recharge['AMOUNT'];
     if($user_type == "MASTERDISTRIBUTER"){
         $q = $con->query("SELECT * FROM masterdistributer where ID='$rech_person_id'")->fetch_assoc();
         $ms_ctof = $q['CUTTOFFAMOUNT'];
         $ms_comm = $q['COMM_PACK'];
         $ms_rcbal = $q['RCBAL'];
           $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE TRANS_ID='$trans_id' and API_NAME='ALLINDIATOPUP'");            }
       }else if($user_type == "DISTRIBUTER"){
           $q = $con->query("SELECT * FROM distributer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
             $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            if($con->query("UPDATE distributer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2' WHERE TRANS_ID='$trans_id' and API_NAME='ALLINDIATOPUP'");            }
                        
       }else if($user_type == "retailer"){
           $q = $con->query("SELECT * FROM retailer where ID='$rech_person_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
            //  echo $ms_rcbal;
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
            //   print_r($q2);
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            // echo $am;
            $am2 = $amount-$am;
            $am3 = $ms_rcbal + $am2;
            // echo $am3;
            if($con->query("UPDATE retailer set RCBAL='$am3' where ID='$rech_person_id'")){
                $con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id', TRANS_TYPE='Credit' , REMAIN_BAL='$am3' , DEDUCT_BAL='$am2'WHERE TRANS_ID='$trans_id' and API_NAME='ALLINDIATOPUP'");            }
           }
       
    }
    else{
     if($con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' WHERE TRANS_ID='$trans_id' and API_NAME='ALLINDIATOPUP'")){
        echo "Updated";
        }
    }

    if($con->query("UPDATE recharge_history SET STATUS='$status' , OPERATOR_ID='$op_id' WHERE TRANS_ID='$trans_id' and API_NAME='ALLINDIATOPUP'")){
        echo "Updated";
    }
    
    
}





?>