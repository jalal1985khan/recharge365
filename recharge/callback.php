<?php
session_start();
include("../includes/config.php");

function calltouser($get_st , $get_txn , $get_op){
    global $con;
    $user = $con->query("select * from Api_users where CALLBACK_URL<>'' ");
    while($dt = $user->fetch_assoc()){
         $cl_url = $dt['CALLBACK_URL']."?status=$get_st&op_id=$get_op&trans_id=$get_txn";
        //  $cl_url = "https://recharges365.com/recharge/callback.php?status=SU&op_id=BR0005Z5QZJD&trans_id=9832113";
        $ch = curl_init($cl_url);
        curl_setopt($ch, CURLOPT_URL, $cl_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPGET, 1);
        $result = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);
        // echo $result;
        $con->query("INSERT INTO `callback_history`(`US_ID`, `TRANS_ID`, `URL`, `ST`, `OP_ID`, `RESPONSE`) VALUES ('".$dt['ID']."','$get_txn',
        '$cl_url','$get_st','$get_op','$result')");
    }
}

$api = $con->query("select * from callback");

while($api_row = $api->fetch_assoc()){
    $api_id = $api_row['ID'];
    $st_para = $api_row['ST_PARA'];
    $txn_pr = $api_row['TXN_PARA'];
    $opid_pr = $api_row['OPID_PARA'];
    $optional_pr = $api_row['OPTIONAL_PARA'];
    $type = $api_row['TYPE'];
    if($type == "POST"){
        $get_st = $_POST[$st_para];
        $get_txn = $_POST[$txn_pr];
        $get_op = $_POST[$opid_pr];
        $optional  = $_POST[$optional_pr];
    }
    elseif($type == "GET"){
         $get_st = $_GET[$st_para];
        $get_txn = $_GET[$txn_pr];
        $get_op =  $_GET[$opid_pr];
        $optional =  $_GET[$optional_pr];
    }
	
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

	if($get_st != ""){
        $con->query("INSERT INTO `callback_recive`(`ST`, `TXN`, `OP_ID`, `OPTIONAL`, `TIME` , `API_ID`) VALUES ('$get_st','$get_txn','$get_op','$optional','$time' ,'$api_id')");
        if($con->query("UPDATE recharge_history SET STATUS='$get_st' , OPERATOR_ID='$get_op' where TRANS_ID='$get_txn'")){
            $time = date("H:g:s A");
            calltouser($get_st , $get_txn , $get_op);
        }
    }
    
    
}
?>