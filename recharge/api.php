<?php

session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);


include("../includes/config.php");

if(isset($_GET['apikey'])){
    $api_key = $_GET['apikey'];
    $mobile_no = $_GET['mobile_no'];
    $op_code = $_GET['operator'];
    $circle = $_GET['circle'];
    $amount = $_GET['amount'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();

    if($con->query("select * from Api_users where API_KEY='$api_key'")->num_rows == 1){
        $api_user_bal = $api_user['RCBAL'];
        $api_user_id = $api_user['ID'];
        $api_user_ip = $api_user['IP'];
        if($ip == $api_user_ip){
            if($api_user_bal > $amount){
                             $op = $con->query("select * from switchOperator where API_USER_CODE='$op_code'")->fetch_assoc();
                            $op_name = $op['PRODUCTNAME'];
                         $api_row = $con->query("select * from user_special_api where USER_TYPE='API_USER' and USER_ID='$api_user_id' and OP_NAME='$op_name'")->fetch_assoc();
                         $api_rows = $con->query("select * from user_special_api where USER_TYPE='API_USER' and USER_ID='$api_user_id' and OP_NAME='$op_name'")->num_rows;
                         if($api_row['API'] != "DEFAULT" && $api_rows == 1){
                             $serchApi = $api_row['API'];
                            //  echo $serchApi;
                            //  echo "SELECT * FROM operatorManager WHERE PRODUCTNAME='".$api_row['OP_NAME']."' and SERVICEAPI='$serchApi'";
                             $fetch_op = $con->query("SELECT * FROM operatorManager WHERE PRODUCTNAME='".$api_row['OP_NAME']."' and SERVICEAPI='$serchApi'")->fetch_assoc();
                             $fetch_op_code = $fetch_op['PRODUCTCODE'];
                              if(strtolower($serchApi) == "myrc"){
                                  backmyrc($mobile_no , $fetch_op_code , $amount , $circle , $api_key);
                              }
                              elseif(strtolower($serchApi) == "paisacharge"){
                                  backp_charge($mobile_no , $fetch_op_code , $amount , $api_key);
                              } 
                              elseif(strtolower($serchApi) == "mrobotic"){
                                  backmrobo($mobile_no , $fetch_op_code , $amount , $api_key);
                              } 
                              elseif(strtolower($serchApi) == "allindiatopup"){
                                  backallind($mobile_no , $fetch_op_code , $amount , $api_key);
                              }
                              elseif(strtolower($serchApi) == "cryush_recharge"){
                                  backcryush($mobile_no , $fetch_op_code , $amount , $circle);
                              }
                         }else{
                            //  echo "work2";
                            $op = $con->query("select * from switchOperator where API_USER_CODE='$op_code'")->fetch_assoc();
                            $op_lng_code = $op['LONGCODE'];
                            $serchApi = $op['APICOMPANY'];
                             if(strtolower($serchApi) == "myrc"){
                                myrc($mobile_no , $op_lng_code , $amount , $circle , $api_key);
                              }
                              elseif(strtolower($serchApi) == "paisacharge"){
                                  p_charge($mobile_no , $op_lng_code , $amount , $api_key);
                              } 
                              elseif(strtolower($serchApi) == "mrobotic"){
                                  mrobo($mobile_no , $op_lng_code , $amount , $api_key);
                              } 
                              elseif(strtolower($serchApi) == "allindiatopup"){
                                  allind($mobile_no , $op_lng_code , $amount , $api_key);
                              }
                              elseif(strtolower($serchApi) == "cryush_recharge"){
                                  crysh($mobile_no , $op_lng_code , $amount , $circle , $api_key);
                              }  
                         }
            }else{
                $api_response = json_encode(array("status" => "Failed" , "error"=>"Invaild Amount"));
            }
        }else{
                $ip_error = "Invaild IP ".$ip;
                $api_response = json_encode(array("status" => "Failed" , "error"=>$ip_error ));
        }
    }else{
            $api_response = json_encode(array("status" => "Failed" , "error"=>"Invaild Api Key"));
    }
            echo $api_response;
}


//function to call api
function myrc($mobile , $operator , $amount , $circle , $api_key){
              global $con;
              $ch = curl_init();
              $serch = $con->query("select * from switchOperator where LONGCODE='$operator'")->fetch_assoc();
              $serchApi = $serch['APICOMPANY'];
                $op_name = $serch['PRODUCTNAME'];
              $backup_api = $serch['BACKUP_API'];
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='$serchApi' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
                date_default_timezone_set('Asia/Kolkata');
                $date = date("Y-m-d");
                $time = date("g:i:s A");
              $live = "$url_p&$mobile_p=$mobile&$circle_p=$circle&$operator_p=$operator&$amount_p=$amount&orderid=$order_id&format=json";
              curl_setopt($ch, CURLOPT_URL, $live); //Using live here
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_HEADER, FALSE);
              curl_setopt($ch, CURLOPT_POST, TRUE);
         $response = curl_exec($ch);
      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live' , '$response')");
         curl_close ($ch);
          $result = json_decode($response);
          
          $status_r = $result->status;
        $txn_id_r = $result->txid;
          $operator_id_r = $result->opid;
          $number_r = $result->number;
          $amount_r = $result->amount;
          $orderid_r = $result->orderid;
          
            $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$number_r' ,'$amount_r','$orderid_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'MYRC' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                       
                      
                      //$con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                   
        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
 
                       
                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'MYRC' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");            
          if($backup_api == "PAISACHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backp_charge($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "MROBOTIC"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MROBOTIC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backmrobo($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "allindiatopup"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backallind($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "CRYUSH RECHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH RECHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backcryush($mobile , $backup_op_longcode , $amount);
          }
    }
}
function mrobo($mobile , $operator , $amount ,$api_key){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
              $date = date("Y-m-d"); $time = date("g:i:s A");  

              $ch = curl_init();
              $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
              $serchApi = $serch['APICOMPANY'];
                      $op_name = $serch['PRODUCTNAME'];
              $backup_api = $serch['BACKUP_API'];

              $query = "SELECT * FROM `rechargeApi` WHERE NAME='$serchApi' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
				if($amount == 298 || $amount == 348 || $amount == 498 || $amount == 448){
				 $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=true";
				}else{
				 $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=false";
				}
            
            //   $live = "https://mrobotics.in/api/recharge_get?api_token=1e61a883-3dc5-4da0-aee3-275912305619&mobile_no=8640000110&amount=10&company_id=2&order_id=$order_id&is_stv=false";
                // echo $live;
          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, FALSE);
        
         $response = curl_exec($ch);
      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live' , '$response')");
        //  echo $response;
         curl_close ($ch);
          $result = json_decode($response);
          $status_r = $result->status;
            $txn_id_r = $result->order_id;
          $orderid_r = $result->response;
          $number_r = $result->mobile_no;
          $amount_r = $result->amount;
          $operator_id_r = $result->tnx_id;

          
            $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$number_r' ,'$amount_r','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'MROBOTIC' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                      // $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                   
                       
                               $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'MROBOTIC' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");            
          if($backup_api == "PAISACHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backp_charge($mobile , $backup_op_longcode , $amount);
          }
          else if($backup_api == "MYRC"){
               $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
                backmyrc($mobile , $backup_op_longcode , $amount , $circle);
              }
          elseif($backup_api == "allindiatopup"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backallind($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "CRYUSH RECHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH RECHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backcryush($mobile , $backup_op_longcode , $amount);
          }
    }
}
function allind($mobile , $operator , $amount ,$api_key){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
                $date = date("Y-m-d");
                $time = date("g:i:s A");  

              $ch = curl_init();
              $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
              $serchApi = $serch['APICOMPANY'];
                      $op_name = $serch['PRODUCTNAME'];
              $backup_api = $serch['BACKUP_API'];
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='$serchApi' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
              $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount";
                // echo $live;
        
          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, TRUE);
        
         $response = curl_exec($ch);
        //  echo $response . "<br><br>";
      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live' , '$response')");
        //  echo $response;
         curl_close ($ch);
           $json = json_encode(simplexml_load_string($response));
         $result = json_decode($json);
         
     $status_code =  $result->errorcode;
         $txn_id_r =  $result->TID;
         $t_status =  $result->TStatus;
		if($t_status == 0){
		$status_r= "Success";
		}else if($t_status == 1){
		$status_r= "Failed";
		}else if($t_status == 2){
		$status_r= "Pending";
		}else if($t_status == 3){
		$status = "Wait 15 mins";
		}
         $operator_id_r =  $result->OperatorTransactionID;
         if(count( (array)$operator_id_r) == 0){
             $operator_id_r = "";
         }
            $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'ALLINDIA_TOPUP' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                    //   $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                   
                       
                               $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'ALLINDIA_TOPUP' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");            
          if($backup_api == "PAISACHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backp_charge($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "MROBOTIC"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MROBOTIC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backmrobo($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "MYRC"){
               $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
                backmyrc($mobile , $backup_op_longcode , $amount , $circle);
          }
          elseif($backup_api == "CRYUSH RECHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH RECHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backcryush($mobile , $backup_op_longcode , $amount);
          }
    }
}
function crysh($mobile , $operator , $amount , $circle , $api_key){
              global $con;
              $ch = curl_init();
              $serch = $con->query("select * from switchOperator where LONGCODE='$operator'")->fetch_assoc();
              $serchApi = $serch['APICOMPANY'];
                $op_name = $serch['PRODUCTNAME'];
              $backup_api = $serch['BACKUP_API'];
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='$serchApi' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              			$str = str_shuffle("12345678901234567890QWERTYUIOYVU234567890DFGUH");
				$order_id =  substr($str , 0 ,10);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
              
              $live = "$url_p&$mobile_p=$mobile&circle=$circle&$operator_p=$operator&$amount_p=$amount&usertx=$order_id&format=json";
                // echo $live;
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d");
        $time = date("g:i:s A"); 
          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, FALSE);
        
         $response = curl_exec($ch);
        //  echo $response;
      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live' , '$response')");
         curl_close ($ch);
          $result = json_decode($response);
          
          $status_r = $result->Status;
            $txn_id_r = $result->ApiTransID;
          $operator_id_r = $result->OperatorRef;
          $orderid_r = $order_id;
          
        $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$mobile' ,'$amount','$orderid_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'CYRUS_RECHARGE' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                    //   $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                  
                          $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'CYRUS_RECHARGE' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");            
          if($backup_api == "PAISACHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backp_charge($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "MROBOTIC"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MROBOTIC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backmrobo($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "MYRC"){
               $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
                backmyrc($mobile , $backup_op_longcode , $amount , $circle);
          }
          elseif($backup_api == "allindiatopup"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backallind($mobile , $backup_op_longcode , $amount);
          }
    }

          
}
function p_charge($mobile , $operator , $amount ,$api_key){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
                $date = date("Y-m-d");
                $time = date("g:i:s A");  
              $ch = curl_init();
              $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
              $serchApi = $serch['APICOMPANY'];
                $op_name = $serch['PRODUCTNAME'];
              $backup_api = $serch['BACKUP_API'];
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='$serchApi' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
              $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&TXNID=$order_id";
                // echo $live;
        
          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, TRUE);
        
         $response = curl_exec($ch);
      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live' , '$response')");
        //  echo $response;
         curl_close ($ch);
          $result = json_decode($response);
          
          $status_r = $result->status;
            $txn_id_r = $result->txid;
          $operator_id_r = $result->opid;
          $number_r = $result->number;
          $amount_r = $result->amount;
          $orderid_r = $result->orderid;
          
          $ms_id = $_SESSION['ms_id'];
          $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['ADMIN_ID'];
          
           $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$number_r' ,'$amount_r','$orderid_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'PAISA_CHARGE' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                       //$con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                   
                       
                               $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'PAISA_CHARGE' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");            
          if($backup_api == "PAISACHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backp_charge($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "MROBOTIC"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MROBOTIC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backmrobo($mobile , $backup_op_longcode , $amount);
          }
          elseif($backup_api == "MYRC"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backmyrc($mobile , $backup_op_longcode , $amount , $circle);
              }
          elseif($backup_api == "CRYUSH RECHARGE"){
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH RECHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backcryush($mobile , $backup_op_longcode , $amount);
          }
    }
}
function backallind($mobile , $operator , $amount ,$api_key){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $time = date("g:i:s A");  
              $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='allindiatopup'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='allindiatopup' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
              $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount";
                // echo $live;
        
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, TRUE);
        
         $response = curl_exec($ch);
        //  echo $response . "<br><br>";
        $url = $live ." BACKUP"; 
      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$url' , '$response')");
        //  echo $response;
         curl_close ($ch);
         $json = json_encode(simplexml_load_string($response));
         $result = json_decode($json);
        // $status_r=  $result->errortext;
        //  $status_r=  'Success';
         $status_code =  $result->errorcode;
         $txn_id_r =  $result->TID;
         $t_status =  $result->TStatus;
		if($t_status == 0){
		$status_r= "Success";
		}else if($t_status == 1){
		$status_r= "Failed";
		}else if($t_status == 2){
		$status_r= "Pending";
		}
         $operator_id_r =  $result->OperatorTransactionID;
          if(count( (array)$operator_id_r) == 0){
             $operator_id_r = "";
         }
         $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
            
           $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
           
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$mobile' ,'$amount','$orderid_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'BACKUP_ALLINDIA' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                    //   $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                  
                          $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                  
                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'BACKUP_ALLINDIA' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");
            }
       echo $api_response;
}

function backmyrc($mobile , $operator , $amount , $circle , $api_key){
              global $con;
              $ch = curl_init();
              $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='MYRC'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='MYRC' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
              
              $live = "$url_p&$mobile_p=$mobile&$circle_p=$circle&$operator_p=$operator&$amount_p=$amount&orderid=$order_id&format=json";
                date_default_timezone_set('Asia/Kolkata');
                $date = date("Y-m-d");
                $time = date("g:i:s A");  

          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, TRUE);
        
         $response = curl_exec($ch);
                 $url = $live ." BACKUP"; 
      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$url' , '$response')");
        //  echo $response;
         curl_close ($ch);
          $result = json_decode($response);
          
          $status_r = $result->status;
            $txn_id_r = $result->txid;
          $operator_id_r = $result->opid;
          $number_r = $result->number;
          $amount_r = $result->amount;
          $orderid_r = $result->orderid;
          
         $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$mobile' ,'$amount','$orderid_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'BACKUP_MYRC' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                   //    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                  
                          $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'BACKUP_MYRC' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");
            }

          
}
function backcryush($mobile , $operator , $amount , $circle , $api_key){
              global $con;
              $ch = curl_init();
              $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='CRYUSH_RECHARGE'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='CRYUSH_RECHARGE' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              			$str = str_shuffle("12345678901234567890QWERTYUIOYVU234567890DFGUH");
				$order_id =  substr($str , 0 ,10);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
              
              $live = "$url_p&$mobile_p=$mobile&circle=$circle&$operator_p=$operator&$amount_p=$amount&usertx=$order_id&format=json";
                // echo $live;
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $time = date("g:i:s A");  

          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, FALSE);
        
         $response = curl_exec($ch);
        //  echo $response;        $url = $live ." BACKUP"; 

      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$url' , '$response')");
         curl_close ($ch);
          $result = json_decode($response);
          
          $status_r = $result->Status;
            $txn_id_r = $result->ApiTransID;
          $operator_id_r = $result->OperatorRef;
          $orderid_r = $order_id;
          
             $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$mobile' ,'$amount','$orderid_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'BACKUP_CRYUSH' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                    //   $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                   
                       
                               $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                   }
                  }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'BACKUP_CRYUSH' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");
            }

        }
function backmrobo($mobile , $operator , $amount ,$api_key){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
                $date = date("Y-m-d");
                $time = date("g:i:s A");  
              $ch = curl_init();
               $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='allindiatopup'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='MROBOTIC' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $url_p = $api['APIURL'];
              $mobile_p = $api['MBPARAMETER'];
              $operator_p = $api['OPRAMETER'];
              $amount_p = $api['AMNTPARAMETER'];
              $format = $api['APITYPE'];
              $circle_p = $api['OPTNLPARAMETER'];
              $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=false";
            
            //   $live = "https://mrobotics.in/api/recharge_get?api_token=1e61a883-3dc5-4da0-aee3-275912305619&mobile_no=8640000118&amount=10&company_id=2&order_id=$order_id&is_stv=false";
                // echo $live;
          curl_setopt($ch, CURLOPT_URL, $live); //Using live here
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, FALSE);
        
         $response = curl_exec($ch);        $url = $live ." BACKUP"; 

      $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$url' , '$response')");
        //  echo $response;
         curl_close ($ch);
          $result = json_decode($response);
          $status_r = $result->status;
            $txn_id_r = $result->txid;
          $operator_id_r = $result->response;
          $number_r = $result->mobile_no;
          $amount_r = $result->amount;
          $orderid_r = $result->tnx_id;
          
          $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
            $api_user_id = $api_user['ID'];
            $api_user_bal = $api_user['RCBAL'];
            $api_user_comm = $api_user['COMM_PACK'];
            $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
            $prcent = $q2['PERCENTAGE'];
            $am = ($amount/100)*$prcent;
            $am2 = $amount-$am;
            $am3 = $api_user_bal - $am2;
        if($status_r == 'success' ||$status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
               $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "order_id" => $orderid_r , "msg"=>"Success Recharge"));
               echo $api_response;
           $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','Api_users','$api_user_id', '$mobile' ,'$amount','$orderid_r' ,'$status_r','$txn_id_r','$orderid_r' , 
              'BACKUP_MROBO' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
              $run3 = mysqli_query($con , $query3);
               if($run3){
                   if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
                      // $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
                   
                       
                               $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");

                   }
                }
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','Api_users','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'BACKUP_MROBO' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");
            }
    }
?>