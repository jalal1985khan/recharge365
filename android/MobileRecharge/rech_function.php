  <?php
session_start();
include("config.php");
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date("g:i:s A");
// SendMessage("8640000118", "work");
    function SendMessage($mobile, $message){
            $curl = curl_init();
                global $con;
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $time = date("g:i:s A"); 
          $s_api = $con->query("select * from smsApi where STATUS='Activate'")->fetch_assoc();
          $s_url = $s_api['APIURL'];
          $s_snder = $s_api['SENDERNAME'];
          $s_apikey = $s_api['APIKEY'];
          
          $live_url = "$s_url&message=$message&sendername=$s_snder&smstype=TRANS&numbers=$mobile&apikey=$s_apikey";
            // set our url with curl_setopt()
            curl_setopt($curl, CURLOPT_URL, $live_url);
            
            // return the transfer as a string, also with setopt()
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            
            // curl_exec() executes the started curl session
            // $output contains the output string
            $output = curl_exec($curl);
            if($output == FALSE){
                die('Failed'.curl_error($curl));
            }
            $outputObj = json_decode($output, true);
            // print_r($outputObj);
            // close curl resource to free up system resources
            // (deletes the variable made by curl_init)
            curl_close($curl);
                    // print_r($data);
          }
          
          
function myrc($mobile , $operator , $amount , $circle ,  $status , $id , $api_name){
              global $con;
              $ch = curl_init();
                $temp_array = array();
                $myResult = "Failed";
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
          
      if(strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if($status_r == $success_response || strtolower($status_r) == 'success'){
           $myResult = "Success";
           $status_r = "Success";
      }
      else if($status_r == $pending_response || strtolower($status_r) == 'pending'){
          $myResult = "Pending";
           $status_r = "Pending";
      }
      if(!empty($id) && $status=="masterdistributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['ADMIN_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
              '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                   //admin commsion
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                    $meraPercent = $meraPercent-$prcent;
                    $Myval = ($meraPercent/100)*$amount;
                    $finalOwnerBal = $ownerBalance+$Myval;
                    mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
          else if(!empty($id) && $status =="distributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['MS_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
              , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            //Changed CommPercent By SK SAMAR for correction
                            $masterDistriComm = $comm_prcnt-$prcent;
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComm','$owner_cm' , '$op_name','$date','$time','0','$update_owner','DISTRIBUTOR') ");
                             //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                        }else{
                             //ds admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                        }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="retailer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
             if($ms_admin == "MASTERDISTRIBUTER"){
                  $ms_admin_id = $ad_row['MS_ID'];
              }elseif($ms_admin == "DISTRIBUTER"){
                  $ms_admin_id = $ad_row['DISTRIBUTER'];
              }else{
                  $ms_admin_id = 1;
              }
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
               '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
               
             if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
              }
               
               
              if($query3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                        if($q4){
                       if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                            
                            $masterDistriCom = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                          
                        //   ms admin commision
                         //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$comm_prcnt;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                           
                           
                       }else  if($ms_admin == "DISTRIBUTER"){
                             //retailer owner comiision
                            $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            $distriCom = $comm_prcnt-$prcent;
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$distriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                            $ds_owner = $rt_owner['OWNER'];
                            $ds_owner_id = $rt_owner['MS_ID'];
                            
                            if($ds_owner == "MASTERDISTRIBUTER"){
                                $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                                $ds_owner_comm = $dis_owner['COMM_PACK'];
                                $ds_owner_rcbal = $dis_owner['RCBAL'];
                                $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                                $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                                $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                                $ds_owner_cm = $ds_ow_am - $ow_am;
                                $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                                $mcmm = $ds_comm_prcnt-$distriCom;
                            //Changes made as above by SK SAMAR
                                
                                $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$mcmm','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner','RETAILER') ");
                            
                                // ms admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$ds_comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                            }else{
                                 //ds admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                
                            }
                        }else{
                             //admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','RETAILER') ");
                        }
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                        }
                  }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                
                                   
                  
                  
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                  
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        
                            
                        }
                        
                        
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                        mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
 
  }else{
        if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }      
            
            
             if($backup_api != ""){
                 if($backup_api == "PAISACHARGE"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backp_charge($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  } 
                  elseif($backup_api == "MROBOTIC"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MROBOTIC'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backmrobo($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  } 
                  elseif($backup_api == "allindiatopup"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backallind($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  }
                  elseif($backup_api == "CRYUSH RECHARGE"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH RECHARGE'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backcryush($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  }
              }
              else{
                $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
                `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
                ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
                
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
    }

          
}

function mrobo($mobile , $operator , $amount , $status , $id , $api_name){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date("g:i:s A");  
                 $temp_array = array();
                $myResult = "Failed";
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
              
               if($operator == 4){
					if($amount == 10 || $amount == 20 || $amount == 30 || $amount == 50 ||  $amount == 100 || $amount == 110 ||  $amount == 180 ||  $amount == 190 ||  $amount == 210 ||  $amount == 220 ){
					 $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=false";
					}
					else{
					 $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=true";
					}
				}
				else{
					if($amount == 298 || $amount == 348 || $amount == 498 || $amount == 448){
					 $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=true";
					}
					else{
					 $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=false";
					}
				}
              
				// if($amount == 298 || $amount == 348 || $amount == 498 || $amount == 448){
				//  $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=true";
				// }else{
				//  $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id&is_stv=false";
				// }
            
            //   $live = "https://mrobotics.in/api/recharge_get?api_token=1e61a883-3dc5-4da0-aee3-275912305619&mobile_no=8640000118&amount=10&company_id=2&order_id=$order_id&is_stv=false";
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
        //   $status_r = "success";
            $txn_id_r = $result->order_id;
          $orderid_r = $result->response;
          $number_r = $result->mobile_no;
          $amount_r = $result->amount;
          $operator_id_r = $result->tnx_id;
          
       if(strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if(strtolower($status_r) == 'success'){
           $myResult = "Success";
           $status_r = "Success";
      }
      else if(strtolower($status_r) == 'pending'){
          $myResult = "Pending";
           $status_r = "Pending";
      }
      if(!empty($id) && $status=="masterdistributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['ADMIN_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
              '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                   //admin commsion
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                    $meraPercent = $meraPercent-$prcent;
                    $Myval = ($meraPercent/100)*$amount;
                    $finalOwnerBal = $ownerBalance+$Myval;
                    mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
          else if(!empty($id) && $status =="distributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['MS_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
              , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            //Changed CommPercent By SK SAMAR for correction
                            $masterDistriComm = $comm_prcnt-$prcent;
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComm','$owner_cm' , '$op_name','$date','$time','0','$update_owner','DISTRIBUTOR') ");
                             //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                        }else{
                             //ds admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                        }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="retailer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
             if($ms_admin == "MASTERDISTRIBUTER"){
                  $ms_admin_id = $ad_row['MS_ID'];
              }elseif($ms_admin == "DISTRIBUTER"){
                  $ms_admin_id = $ad_row['DISTRIBUTER'];
              }else{
                  $ms_admin_id = 1;
              }
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
               '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
               
             if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
              }
               
               
              if($query3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                        if($q4){
                       if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                            
                            $masterDistriCom = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                          
                        //   ms admin commision
                         //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$comm_prcnt;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                           
                           
                       }else  if($ms_admin == "DISTRIBUTER"){
                             //retailer owner comiision
                            $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            $distriCom = $comm_prcnt-$prcent;
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$distriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                            $ds_owner = $rt_owner['OWNER'];
                            $ds_owner_id = $rt_owner['MS_ID'];
                            
                            if($ds_owner == "MASTERDISTRIBUTER"){
                                $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                                $ds_owner_comm = $dis_owner['COMM_PACK'];
                                $ds_owner_rcbal = $dis_owner['RCBAL'];
                                $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                                $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                                $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                                $ds_owner_cm = $ds_ow_am - $ow_am;
                                $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                                $mcmm = $ds_comm_prcnt-$distriCom;
                            //Changes made as above by SK SAMAR
                                
                                $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$mcmm','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner','RETAILER') ");
                            
                                // ms admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$ds_comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                            }else{
                                 //ds admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                
                            }
                        }else{
                             //admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','RETAILER') ");
                        }
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                        }
                  }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                  
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        
                            
                        }
                        
                        
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                        mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
 
  }else{
        if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }      
            
            
             if($backup_api != ""){
                  if($backup_api == "MYRC"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
                  $backup_op_longcode = $backup_op['PRODUCTCODE'];
                    backmyrc($mobile , $backup_op_longcode , $amount , $circle , $status , $id ,$api_name);
                  }
                  elseif($backup_api == "PAISACHARGE"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
                  $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backp_charge($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  }
                  elseif($backup_api == "allindiatopup"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
                  $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backallind($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  }
                  elseif($backup_api == "CRYUSH RECHARGE"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH_RECHARGE'")->fetch_assoc();
                  $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backcryush($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  }
              }else{
                $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
                `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
                ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
                
              array_push($temp_array,array("result"=>"Failed", "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
}

}


function allind($mobile , $operator , $amount , $status , $id , $api_name){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date("g:i:s A");  
  $temp_array = array();
                $myResult = "Failed";
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
         $result = simplexml_load_string($response);
         
     $status_r_code =  $result->errorcode;
         $txn_id_r =  $result->TID;
         $t_status =  $result->TStatus;
		if($t_status == 0){
		$status_r = "Success";
		}else if($t_status == 1){
		$status_r = "Failed";
		}else if($t_status == 2){
		$status_r = "Pending";
		}else if($t_status == 3){
		$status_r = "Wait 15 mins";
		}
         $operator_id_r =  $result->OperatorTransactionID;
        if(strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if(strtolower($status_r) == 'success'){
           $myResult = "Success";
           $status_r = "Success";
      }
      else if(strtolower($status_r) == 'pending'){
          $myResult = "Pending";
           $status_r = "Pending";
      }
      if(!empty($id) && $status=="masterdistributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['ADMIN_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
              '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                   //admin commsion
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                    $meraPercent = $meraPercent-$prcent;
                    $Myval = ($meraPercent/100)*$amount;
                    $finalOwnerBal = $ownerBalance+$Myval;
                    mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
          else if(!empty($id) && $status =="distributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['MS_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
              , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            //Changed CommPercent By SK SAMAR for correction
                            $masterDistriComm = $comm_prcnt-$prcent;
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComm','$owner_cm' , '$op_name','$date','$time','0','$update_owner','DISTRIBUTOR') ");
                             //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                        }else{
                             //ds admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                        }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="retailer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
             if($ms_admin == "MASTERDISTRIBUTER"){
                  $ms_admin_id = $ad_row['MS_ID'];
              }elseif($ms_admin == "DISTRIBUTER"){
                  $ms_admin_id = $ad_row['DISTRIBUTER'];
              }else{
                  $ms_admin_id = 1;
              }
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
               '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
               
             if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
              }
               
               
              if($query3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                        if($q4){
                       if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                            
                            $masterDistriCom = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                          
                        //   ms admin commision
                         //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$comm_prcnt;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                           
                           
                       }else  if($ms_admin == "DISTRIBUTER"){
                             //retailer owner comiision
                            $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            $distriCom = $comm_prcnt-$prcent;
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$distriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                            $ds_owner = $rt_owner['OWNER'];
                            $ds_owner_id = $rt_owner['MS_ID'];
                            
                            if($ds_owner == "MASTERDISTRIBUTER"){
                                $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                                $ds_owner_comm = $dis_owner['COMM_PACK'];
                                $ds_owner_rcbal = $dis_owner['RCBAL'];
                                $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                                $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                                $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                                $ds_owner_cm = $ds_ow_am - $ow_am;
                                $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                                $mcmm = $ds_comm_prcnt-$distriCom;
                            //Changes made as above by SK SAMAR
                                
                                $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$mcmm','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner','RETAILER') ");
                            
                                // ms admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$ds_comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                            }else{
                                 //ds admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                
                            }
                        }else{
                             //admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','RETAILER') ");
                        }
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                        }
                  }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                
                                   
                  
                  
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                  
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        
                            
                        }
                        
                        
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                        mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
 
  }else{
        if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }      
            
            
             if($backup_api != ""){
              if($backup_api == "MYRC"){
               $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
                backmyrc($mobile , $backup_op_longcode , $amount , $circle , $status , $id ,$api_name);
              }
              elseif($backup_api == "PAISACHARGE"){
                   $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
                  backp_charge($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
              } 
              elseif($backup_api == "MROBOTIC"){
                   $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MROBOTIC'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
                  backmrobo($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
              } 
              elseif($backup_api == "CRYUSH RECHARGE"){
                   $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH_RECHARGE'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
                  backcryush($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
              }
             }else{
                $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
                `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
                ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
                
              array_push($temp_array,array("result"=>"Failed", "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
}

}

function crysh($mobile , $operator , $amount , $circle , $status , $id ,$api_name){
              global $con;
              $ch = curl_init();
              $temp_array = array();
                $myResult = "Failed";
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
          
          if(strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if($status_r == $success_response || strtolower($status_r) == 'success'){
           $myResult = "Success";
           $status_r = "Success";
      }
      else if($status_r == $pending_response || strtolower($status_r) == 'pending'){
          $myResult = "Pending";
           $status_r = "Pending";
      }
      if(!empty($id) && $status=="masterdistributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['ADMIN_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
              ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
              '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                   //admin commsion
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                    $meraPercent = $meraPercent-$prcent;
                    $Myval = ($meraPercent/100)*$amount;
                    $finalOwnerBal = $ownerBalance+$Myval;
                    mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
          else if(!empty($id) && $status =="distributer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_admin_id = $ad_row['MS_ID'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
              , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
              
              if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
              }
              
              
              if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                        if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            //Changed CommPercent By SK SAMAR for correction
                            $masterDistriComm = $comm_prcnt-$prcent;
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComm','$owner_cm' , '$op_name','$date','$time','0','$update_owner','DISTRIBUTOR') ");
                             //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                        }else{
                             //ds admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                        }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="retailer"){
              $ms_id = $id;
              $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
              $ms_admin = $ad_row['OWNER'];
              $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
              $ms_comm = $ad_row['COMM_PACK'];
              $ms_rcbal = $ad_row['RCBAL'];
              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
              $prcent = $q2['PERCENTAGE'];
              $am = ($amount/100)*$prcent;
              $am2 = $amount-$am;
              $am3 = $ms_rcbal - $am2;
             if($ms_admin == "MASTERDISTRIBUTER"){
                  $ms_admin_id = $ad_row['MS_ID'];
              }elseif($ms_admin == "DISTRIBUTER"){
                  $ms_admin_id = $ad_row['DISTRIBUTER'];
              }else{
                  $ms_admin_id = 1;
              }
              $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
              VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
               '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
               
             if($query3 && $myResult == "Pending"){
                  $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
              }
               
               
              if($query3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                        if($q4){
                       if($ms_admin == "MASTERDISTRIBUTER"){
                            //retailer owner comiision
                            $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                            
                            $masterDistriCom = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                          
                        //   ms admin commision
                         //ms admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$comm_prcnt;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                        
                           
                           
                       }else  if($ms_admin == "DISTRIBUTER"){
                             //retailer owner comiision
                            $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                            $rt_owner_comm = $rt_owner['COMM_PACK'];
                            $rt_owner_rcbal = $rt_owner['RCBAL'];
                            $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $comm_prcnt = $comm_pack['PERCENTAGE'];
                            $ow_am = ($amount/100)*$comm_prcnt;
                            $owner_cm = $ow_am - $am;
                            $update_owner = $rt_owner_rcbal + $owner_cm;
                            $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                            $distriCom = $comm_prcnt-$prcent;
                            //Changes made as above by SK SAMAR
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$distriCom','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                            $ds_owner = $rt_owner['OWNER'];
                            $ds_owner_id = $rt_owner['MS_ID'];
                            
                            if($ds_owner == "MASTERDISTRIBUTER"){
                                $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                                $ds_owner_comm = $dis_owner['COMM_PACK'];
                                $ds_owner_rcbal = $dis_owner['RCBAL'];
                                $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                                $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                                $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                                $ds_owner_cm = $ds_ow_am - $ow_am;
                                $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                                $mcmm = $ds_comm_prcnt-$distriCom;
                            //Changes made as above by SK SAMAR
                                
                                $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$mcmm','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner','RETAILER') ");
                            
                                // ms admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$ds_comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','MASTERDISTRIBUTER') ");
                            }else{
                                 //ds admin commsion
                                $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                                $meraPercent = (float)$mera['PERCENT'];
                                $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                                $ownerBalance = (float)$myOwner['RCBAL'];
                                $meraPercent = $meraPercent-$comm_prcnt;
                                $Myval = ($meraPercent/100)*$amount;
                                $finalOwnerBal = $ownerBalance+$Myval;
                                mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','DISTRIBUTER') ");
                
                            }
                        }else{
                             //admin commsion
                            $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                            $meraPercent = (float)$mera['PERCENT'];
                            $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                            $ownerBalance = (float)$myOwner['RCBAL'];
                            $meraPercent = $meraPercent-$prcent;
                            $Myval = ($meraPercent/100)*$amount;
                            $finalOwnerBal = $ownerBalance+$Myval;
                            mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','RETAILER') ");
                        }
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                        }
                  }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                
                                   
                  
                  
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $ex = $amount-$val;
                  
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
                    if($run3 && $myResult == "Pending"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
                    }
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        
                            
                        }
                        
                        
                    $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                        mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          
          
 
  }else{
        if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }      
            
            
             if($backup_api != ""){
                  if($backup_api == "PAISACHARGE"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      p_charge($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  } 
                  else if($backup_api == "MROBOTIC"){
                       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      backmrobo($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  } 
                  else if($backup_api == "allindiatopup"){
                      $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='allindiatopup'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                      back_allind($mobile , $backup_op_longcode , $amount , $status , $id ,$api_name);
                  }
                 elseif($backup_api == "MYRC"){
                                   $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
                      $backup_op_longcode = $backup_op['PRODUCTCODE'];
                        backmyrc($mobile , $backup_op_longcode , $amount , $circle , $status , $id ,$api_name);
                      }
             }else{
                $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
                `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
                ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
                
              array_push($temp_array,array("result"=>'Failed', "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
    }

}



function back_allind($mobile , $operator , $amount ,$status , $id ,$api_name){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$temp_array = array();
                $myResult = "Failed";
$time = date("g:i:s A");  
              $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='allindiatopup'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              $api_name = "BACKUP_ALLINDIA";
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
         $result = simplexml_load_string($response);
         
        // $status_r =  $result->errortext;
        //  $status_r =  'Success';
         $status_r_code =  $result->errorcode;
         $txn_id_r =  $result->TID;
         $t_status =  $result->TStatus;
		if($t_status == 0){
		$status_r = "Success";
		}else if($t_status == 1){
		$status_r = "Failed";
		}else if($t_status == 2){
		$status_r = "Pending";
		}else if($t_status == 3){
		$status = "Wait 15 mins";
		}
         $operator_id_r =  $result->OperatorTransactionID;
         
     if($status_r == $success_response ||$status_r == $pending_response || strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if($status_r == $success_response || strtolower($status_r) == 'success'){
           $myResult = "Success";
      }
      else if($status_r == $pending_response || strtolower($status_r) == 'pending'){
          $myResult = "Pending";
      }
        
        
        
        
        if(!empty($id) && $status =="masterdistributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['ADMIN_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
          ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
          '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                  }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else if(!empty($id) && $status =="distributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['MS_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
          , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
         
         
            if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$rt_id'");
    
            }
        
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                        
                        
                        
                        
                            $masterDistriComX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','DISTRIBUTER') ");
                    }
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else   if(!empty($id) && $status =="retailer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
         if($ms_admin == "MASTERDISTRIBUTER"){
              $ms_admin_id = $ad_row['MS_ID'];
          }elseif($ms_admin == "DISTRIBUTER"){
              $ms_admin_id = $ad_row['DISTRIBUTER'];
          }else{
              $ms_admin_id = 1;
          }
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
           '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
         if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$rt_id'");
    
            }
          
          
          if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                         if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                             $masterDistriComXI = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComXI','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                    }else  if($ms_admin == "DISTRIBUTER"){
                         //retailer owner comiision
                        $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                            $comm_prcntX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$comm_prcntX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                        $ds_owner = $rt_owner['OWNER'];
                        $ds_owner_id = $rt_owner['MS_ID'];
                        if($ds_owner == "MASTERDISTRIBUTER"){
                            $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                            $ds_owner_comm = $dis_owner['COMM_PACK'];
                            $ds_owner_rcbal = $dis_owner['RCBAL'];
                            $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                            $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                            $ds_owner_cm = $ds_ow_am - $ow_am;
                            $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                            
                            
                            
                            $comm_prcntX2 = $ds_comm_prcnt-$comm_prcntX;
                            
                            //Changes made as above by SK SAMAR

                            
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$comm_prcntX2','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner,'RETAILER') ");
                        }
                    }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name','$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    $ex = $amount-$val;
                
                                   
                  
                  
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
              if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
        
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $mx = $amount-$val;
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
            if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
                        
                     $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                           mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
        
        
    }else{
           if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            
            
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            
    $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
    `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
    ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
              array_push($temp_array,array("result"=>'Failed', "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
    }

          
function backmyrc($mobile , $operator , $amount , $circle , $status , $id ,$api_name){
              global $con;
              $ch = curl_init();
              $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='MYRC'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              $api_name = "BACKUP_MYRC";
              $temp_array = array();
                $myResult = "Failed";
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
                // echo $live;
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
          
     if($status_r == $success_response ||$status_r == $pending_response || strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if($status_r == $success_response || strtolower($status_r) == 'success'){
           $myResult = "Success";
      }
      else if($status_r == $pending_response || strtolower($status_r) == 'pending'){
          $myResult = "Pending";
      }
        
        
        
        
        if(!empty($id) && $status =="masterdistributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['ADMIN_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
          ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
          '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                  }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else if(!empty($id) && $status =="distributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['MS_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
          , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
         
         
            if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$rt_id'");
    
            }
        
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                        
                        
                        
                        
                            $masterDistriComX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','DISTRIBUTER') ");
                    }
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else   if(!empty($id) && $status =="retailer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
         if($ms_admin == "MASTERDISTRIBUTER"){
              $ms_admin_id = $ad_row['MS_ID'];
          }elseif($ms_admin == "DISTRIBUTER"){
              $ms_admin_id = $ad_row['DISTRIBUTER'];
          }else{
              $ms_admin_id = 1;
          }
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
           '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
         if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$rt_id'");
    
            }
          
          
          if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                         if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                             $masterDistriComXI = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComXI','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                    }else  if($ms_admin == "DISTRIBUTER"){
                         //retailer owner comiision
                        $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                            $comm_prcntX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$comm_prcntX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                        $ds_owner = $rt_owner['OWNER'];
                        $ds_owner_id = $rt_owner['MS_ID'];
                        if($ds_owner == "MASTERDISTRIBUTER"){
                            $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                            $ds_owner_comm = $dis_owner['COMM_PACK'];
                            $ds_owner_rcbal = $dis_owner['RCBAL'];
                            $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                            $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                            $ds_owner_cm = $ds_ow_am - $ow_am;
                            $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                            
                            
                            
                            $comm_prcntX2 = $ds_comm_prcnt-$comm_prcntX;
                            
                            //Changes made as above by SK SAMAR

                            
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$comm_prcntX2','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner,'RETAILER') ");
                        }
                    }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name','$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    $ex = $amount-$val;
                
                                   
                  
                  
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
              if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
        
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $mx = $amount-$val;
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
            if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
                        
                     $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                           mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
        
        
    }else{
           if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            
            
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            
    $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
    `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
    ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
    }




function backcrysh($mobile , $operator , $amount , $circle ,$status , $id ,$api_name){
              global $con;
              $ch = curl_init();
              $temp_array = array();
                $myResult = "Failed";
                          $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='CRYUSH_RECHARGE'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              $api_name = "BACKUP_CRYUSH";
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
          
    if($status_r == $success_response ||$status_r == $pending_response || strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if($status_r == $success_response || strtolower($status_r) == 'success'){
           $myResult = "Success";
      }
      else if($status_r == $pending_response || strtolower($status_r) == 'pending'){
          $myResult = "Pending";
      }
        
        
        
        
        if(!empty($id) && $status =="masterdistributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['ADMIN_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
          ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
          '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                  }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else if(!empty($id) && $status =="distributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['MS_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
          , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
         
         
            if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$rt_id'");
    
            }
        
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                        
                        
                        
                        
                            $masterDistriComX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','DISTRIBUTER') ");
                    }
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else   if(!empty($id) && $status =="retailer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
         if($ms_admin == "MASTERDISTRIBUTER"){
              $ms_admin_id = $ad_row['MS_ID'];
          }elseif($ms_admin == "DISTRIBUTER"){
              $ms_admin_id = $ad_row['DISTRIBUTER'];
          }else{
              $ms_admin_id = 1;
          }
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
           '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
         if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$rt_id'");
    
            }
          
          
          if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                         if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                             $masterDistriComXI = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComXI','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                    }else  if($ms_admin == "DISTRIBUTER"){
                         //retailer owner comiision
                        $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                            $comm_prcntX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$comm_prcntX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                        $ds_owner = $rt_owner['OWNER'];
                        $ds_owner_id = $rt_owner['MS_ID'];
                        if($ds_owner == "MASTERDISTRIBUTER"){
                            $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                            $ds_owner_comm = $dis_owner['COMM_PACK'];
                            $ds_owner_rcbal = $dis_owner['RCBAL'];
                            $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                            $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                            $ds_owner_cm = $ds_ow_am - $ow_am;
                            $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                            
                            
                            
                            $comm_prcntX2 = $ds_comm_prcnt-$comm_prcntX;
                            
                            //Changes made as above by SK SAMAR

                            
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$comm_prcntX2','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner,'RETAILER') ");
                        }
                    }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name','$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    $ex = $amount-$val;
                
                                   
                  
                  
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
              if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
        
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $mx = $amount-$val;
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
            if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
                        
                     $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                           mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
        
        
    }else{
           if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            
            
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            
    $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
    `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
    ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
              array_push($temp_array,array("result"=>'Failed', "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
    }


function backmrobo($mobile , $operator , $amount , $status , $id ,$api_name ){
              global $con;
              date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $time = date("g:i:s A");  
$temp_array = array();
                $myResult = "Failed";
              $ch = curl_init();
               $serch = $con->query("SELECT * FROM operatorManager WHERE PRODUCTCODE='$operator' and SERVICEAPI='allindiatopup'")->fetch_assoc();
              $op_name = $serch['PRODUCTNAME'];
              $api_name = "BACKUP_MROBO";
              $query = "SELECT * FROM `rechargeApi` WHERE NAME='MROBOTIC' and `STATUS` ='Activate'";
              $run = mysqli_query($con , $query);
              $api = mysqli_fetch_array($run);
              $order_id = mt_rand(1000000 , 200000000);
              $api_name = "BACKUP_MROBO";
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
          
    if($status_r == $success_response ||$status_r == $pending_response || strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
      if($status_r == $success_response || strtolower($status_r) == 'success'){
           $myResult = "Success";
      }
      else if($status_r == $pending_response || strtolower($status_r) == 'pending'){
          $myResult = "Pending";
      }
        
        
        
        
        if(!empty($id) && $status =="masterdistributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['ADMIN_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
          ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r',
          '$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
              if($myResult == "Pending"){
                  $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
              }
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                  }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else if(!empty($id) && $status =="distributer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_admin_id = $ad_row['MS_ID'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' 
          , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')");
         
         
            if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$rt_id'");
    
            }
        
          if($query3 && $myResult == "Success"){
                $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
                if($q4){
                    if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                        
                        
                        
                        
                            $masterDistriComX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','DISTRIBUTER') ");
                    }
                    $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date','$time','$am2','$am3','Recharge') ");
                }
          }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
        else   if(!empty($id) && $status =="retailer"){
          $ms_id = $id;
          $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
          $ms_admin = $ad_row['OWNER'];
          $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
          $ms_comm = $ad_row['COMM_PACK'];
          $ms_rcbal = $ad_row['RCBAL'];
          $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
          $prcent = $q2['PERCENTAGE'];
          $am = ($amount/100)*$prcent;
          $am2 = $amount-$am;
          $am3 = $ms_rcbal - $am2;
         if($ms_admin == "MASTERDISTRIBUTER"){
              $ms_admin_id = $ad_row['MS_ID'];
          }elseif($ms_admin == "DISTRIBUTER"){
              $ms_admin_id = $ad_row['DISTRIBUTER'];
          }else{
              $ms_admin_id = 1;
          }
          $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
          VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' ,
           '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
          
         if($query3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$rt_id'");
    
            }
          
          
          if($query3 && $myResult == "Success"){
                    $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
                    if($q4){
                         if($ms_admin == "MASTERDISTRIBUTER"){
                        //retailer owner comiision
                        $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                             $masterDistriComXI = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','$masterDistriComXI','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                    }else  if($ms_admin == "DISTRIBUTER"){
                         //retailer owner comiision
                        $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
                        $rt_owner_comm = $rt_owner['COMM_PACK'];
                        $rt_owner_rcbal = $rt_owner['RCBAL'];
                        $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                        $comm_prcnt = $comm_pack['PERCENTAGE'];
                        $ow_am = ($amount/100)*$comm_prcnt;
                        $owner_cm = $ow_am - $am;
                        $update_owner = $rt_owner_rcbal + $owner_cm;
                        $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
                        
                        
                        
                            $comm_prcntX = $comm_prcnt-$prcent;
                            
                            //Changes made as above by SK SAMAR
                        
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('DISTRIBUTER','$ms_admin_id','$comm_prcntX','$owner_cm' , '$op_name' , '$date','$time','0','$update_owner','RETAILER') ");
                        $ds_owner = $rt_owner['OWNER'];
                        $ds_owner_id = $rt_owner['MS_ID'];
                        if($ds_owner == "MASTERDISTRIBUTER"){
                            $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
                            $ds_owner_comm = $dis_owner['COMM_PACK'];
                            $ds_owner_rcbal = $dis_owner['RCBAL'];
                            $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
                            $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
                            $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
                            $ds_owner_cm = $ds_ow_am - $ow_am;
                            $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                            $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
                            
                            
                            
                            $comm_prcntX2 = $ds_comm_prcnt-$comm_prcntX;
                            
                            //Changes made as above by SK SAMAR

                            
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','$comm_prcntX2','$ds_owner_cm' , '$op_name' , '$date','$time','0','$update_ds_owner,'RETAILER') ");
                        }
                    }
                        $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`,`TIME`,`DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name','$date','$time','$am2','$am3','Recharge') ");
                    }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
          else if(!empty($id) && $status =="admin"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from admin where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                
                    $info = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' AND OP_NAME = '$op_name'")->fetch_assoc();
                    $percentage = (float)$info['PERCENT'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    $ex = $amount-$val;
                
                                   
                  
                  
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
              if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              
              
          }
        
                    else if(!empty($id) && $status =="Api_users"){
                  $rt_id = $id; 
                  $rt_data = $con->query("select * from Api_users where ID='$rt_id'")->fetch_assoc();
                  $rt_rcbal = $rt_data['RCBAL'];
                  $comm_pack = $rt_data['COMM_PACK'];
                  
                    $data2 = $con->query("SELECT * FROM `operator_comm` WHERE PACKAGE_ID='$comm_pack' and OP_NAME='$op_name'")->fetch_assoc();
                    $percentage = (float)$data2['PERCENTAGE'];
                    $val = ($percentage/100)*$amount;
                    $am3 = $rt_rcbal - $amount;
                    $am3 = $am3+$val;
                    
                    $mx = $amount-$val;
                 
                  
                  $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
                  VALUES('ADMIN','1','Api_users','$rt_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
                  $run3 = mysqli_query($con , $query3);
                  
            if($run3 && $myResult == "Pending"){
               $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
    
            }
                  
                  
                  
                  if($run3 && $myResult == "Success"){
                        $q4 = $con->query("UPDATE Api_users set RCBAL='$am3' where ID='$rt_id'");
                        if($q4){
                            $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('API_USER','$rt_id','$percentage','$val' , '$op_name' , '$date','$time','$ex','$am3','Recharge') ");
                        }
                        
                     $mera = $con->query("SELECT * FROM `apiMargin` WHERE API='$api_name' and OP_NAME='$op_name'")->fetch_assoc();
                    $meraPercent = (float)$mera['PERCENT'];
                        
                    $myOwner = $con->query("SELECT * FROM `admin` WHERE ID='1'")->fetch_assoc();
                    $ownerBalance = (float)$myOwner['RCBAL'];
                        
                        $meraPercent = $meraPercent-$percentage;
                        $Myval = ($meraPercent/100)*$amount;
                        
                        $finalOwnerBal = $ownerBalance+$Myval;
                           mysqli_query($con,"UPDATE `admin` SET `RCBAL`='$finalOwnerBal' WHERE ID='1'");
                        
                                                $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`, `TIME`, `DEBIT_AMOUNT`,`CURRENT_BAL`,`COMM_TYPE`) VALUES('ADMIN','1','$meraPercent','$Myval' , '$op_name' , '$date','$time','0','$finalOwnerBal','API USER') ");
                        
              }
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
          }
        
        
    }else{
           if(!empty($id) && $status =="masterdistributer"){
                $person = "MASTERDISTRIBUTER";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
                 $owner  = $person_row['OWNER'];
                 $bal  = $person_row['RCBAL'];
                 $owner_id = $person_row['ADMIN_ID'];
            }
            
                else if(!empty($id) && $status =="Api_users"){
                $person = "Api_users";
                $person_id = $id;
                 $person_row = $con->query("SELECT * FROM Api_users where ID='$person_id'")->fetch_assoc();
                 $bal  = $person_row['RCBAL'];
                 $owner  = 'ADMIN';
                 $owner_id = '1';
            }
            
            
            
            
            else if(!empty($id) && $status =="distributer"){
                $person = "DISTRIBUTER";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                $owner = $ad_row['OWNER'];
                $owner_id = $ad_row['MS_ID'];
            }else if(!empty($id) && $status =="retailer"){
                $person = "retailer";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            else if(!empty($id) && $status =="admin"){
                $person = "admin";
                $person_id = $id;
                $ad_row = $con->query("SELECT * FROM admin where ID='$ms_id'")->fetch_assoc();
                $bal  = $ad_row['RCBAL'];
                  $owner = $ad_row['OWNER'];
                  if($owner == "MASTERDISTRIBUTER"){
                      $owner_id = $ad_row['MS_ID'];
                  }elseif($owner == "DISTRIBUTER"){
                    $owner_id = $ad_row['DISTRIBUTER'];
                  }else{
                      $owner_id = 1;
                  }
            }
            
            
    $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
    `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
    ,'$amount','$operator_id_r' ,'FAILED','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
              array_push($temp_array,array("result"=>'Failed', "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
}