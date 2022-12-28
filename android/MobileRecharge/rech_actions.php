<?php



    
    include("config.php");
    include("rech_function.php");
    date_default_timezone_set("Asia/Kolkata");
    // include("function.php");
//$firstname = mysqli_real_escape_string($con, $_POST['firstname']);



    $operator = $_POST['operator'];
   // $mobile = $_POST['mobile'];
$mobile= mysqli_real_escape_string($con, $_POST['mobile']);

    $amount =mysqli_real_escape_string($con, $_POST['amount']);
    $check_id     = $_POST['id'];
$id = mysqli_real_escape_string($con,htmlentities(trim($check_id)));
    $status = $_POST['TYPE'];
$circle = $_POST['circle'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    $old_time = strtotime("-1 minutes", strtotime($time));
    $rech_old_time =  date('g:i:s A', $old_time);
        $temp_arrayX = array();
        if(isset($mobile)){
                    $q3 = $con->query("SELECT * FROM switchOperator where LONGCODE='$operator'")->fetch_assoc();
        $op_name = $q3['PRODUCTNAME'];
        
        
    if(!empty($id) && $status == "masterdistributer"){
                 $rt_id = $id;
                 $q = $con->query("SELECT * FROM masterdistributer where ID='$rt_id'")->fetch_assoc();
                 $ms_ctof = $q['CUTTOFFAMOUNT'];
                 $ms_comm = $q['COMM_PACK'];
                 $ms_rcbal = $q['RCBAL'];
                 $rech = $con->query("select * from recharge_history where PERSON='MASTERDISTRIBUTER' and PERSON_ID='$rt_id' and DATE='$date' and NUMBER='$mobile'  and TIME>'$rech_old_time' LIMIT 1");
            }else if(!empty($id) && $status == "distributer"){
                 $rt_id = $id;
                 $q = $con->query("SELECT * FROM distributer where ID='$rt_id'")->fetch_assoc();
                 $ms_ctof = $q['CUTTOFFAMOUNT'];
                 $ms_comm = $q['COMM_PACK'];
                 $ms_rcbal = $q['RCBAL'];
                 $rech = $con->query("select * from recharge_history where PERSON='DISTRIBUTER' and PERSON_ID='$rt_id' and DATE='$date' and NUMBER='$mobile' and TIME > '$rech_old_time' LIMIT 1");
            }else if(!empty($id) && $status == "retailer"){
             $rt_id = $id;
             $q = $con->query("SELECT * FROM retailer where ID='$rt_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
                 $rech = $con->query("select * from recharge_history where PERSON='retailer' and PERSON_ID='$rt_id' and DATE='$date' and NUMBER='$mobile' and TIME>'$rech_old_time' LIMIT 1");
            }
            else if(!empty($id) && $status == "Api_users"){
             $rt_id = $id;
             $q = $con->query("SELECT * FROM Api_users where ID='$rt_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
                 $rech = $con->query("select * from recharge_history where PERSON='Api_users' and PERSON_ID='$rt_id' and DATE='$date' and NUMBER='$mobile' and TIME>'$rech_old_time' LIMIT 1");
            }
            else if(!empty($id) && $status == "admin"){
             $rt_id = $id;
             $q = $con->query("SELECT * FROM admin where ID='$rt_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
                 $rech = $con->query("select * from recharge_history where PERSON='ADMIN' and PERSON_ID='$rt_id' and DATE='$date' and NUMBER='$mobile' and TIME>'$rech_old_time' LIMIT 1");
            }
            
                if($amount < $ms_rcbal){
            
                     if(($ms_rcbal - $amount) < $ms_ctof){
                            // echo json_encode("Cutoff Limit");
                          array_push($temp_arrayX,array("result"=>"Cutoff Limit","id"=>"Cutoff Limit"));
                          echo json_encode($temp_arrayX);
                     }else{
                        $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
                      $serchApi = $serch['APICOMPANY'];
                      $op_name = $serch['PRODUCTNAME'];
                      $backup_api = $serch['BACKUP_API'];
                      if($rech->num_rows == 1){
                            $rech_data = $rech->fetch_assoc();
                            $rech_time = $rech_data['TIME'];
                            $endTime = strtotime("+1 minutes", strtotime($rech_time));
                            $rech_exp_time =  date('g:i:s A', $endTime);
                            $current_time = date("g:i:s A");
                            $time_diff = strtotime($rech_exp_time) - strtotime($current_time);
                            $time_in_min = intval($time_diff/60);
                              if($time_diff <= 0){
                                   if($serchApi == "MYRC"){
                                    myrc($mobile , $operator , $amount , $circle , $status , $id , $serchApi);
                                  }
                                  elseif($serchApi == "PAISACHARGE"){
                                      p_charge($mobile , $operator , $amount , $status , $id , $serchApi);
                                  } 
                                  elseif($serchApi == "MROBOTIC"){
                                      mrobo($mobile , $operator , $amount , $status , $id , $serchApi);
                                  } 
                                  elseif($serchApi == "Allindiatopup"){
                                      allind($mobile , $operator , $amount , $status , $id , $serchApi);
                                  }
                                 elseif($serchApi == "CRYUSH_RECHARGE"){
                                      crysh($mobile , $operator , $amount , $circle , $status , $id , $serchApi);
                                  }
                              }else{
                                    array_push($temp_arrayX,array("result"=>"You Can Recharge After $time_in_min Minutes.","id"=>"Time Limit"));
                                      echo json_encode($temp_arrayX);
                              }
                      }else{
                             if($serchApi == "MYRC"){
                                myrc($mobile , $operator , $amount , $circle , $status , $id , $serchApi);
                              }
                              elseif($serchApi == "PAISACHARGE"){
                                  p_charge($mobile , $operator , $amount , $status , $id , $status , $id , $serchApi);
                              } 
                              elseif($serchApi == "MROBOTIC"){
                                  mrobo($mobile , $operator , $amount , $status , $id , $serchApi);
                              } 
                              elseif($serchApi == "Allindiatopup"){
                                  allind($mobile , $operator , $amount , $status , $id , $serchApi);
                              }
                             elseif($serchApi == "CRYUSH_RECHARGE"){
                                  crysh($mobile , $operator , $amount , $circle , $status , $id , $serchApi);
                              }
                      }

                    }
                }
             else
             {
                      
            array_push($temp_arrayX,array("result"=>"Insufficient Amount","id"=>"Insufficient Amount"));
              echo json_encode($temp_arrayX);
             }
            
        }
        else{
              array_push($temp_arrayX,array("result"=>"Insufficient Amount","id"=>"Insufficient Amount"));
              echo json_encode($temp_arrayX);
        }
            
            
            
            
            
            
    
    
function recharge($api_name , $mobile , $operator , $amount , $backup_api , $op_name, $status, $id , $circle){
    global $con; // use connection in function 
  
              $temp_array = array();

                $myResult = "Failed";

    
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    
    //search api from db 
    $api = $con->query("SELECT * FROM `rechargeApi` WHERE NAME='$api_name' and `STATUS` ='Activate'")->fetch_assoc();
   
    $url_p = $api['APIURL']; // p defines to parameter
	
    $mobile_p = $api['MBPARAMETER'];
    $operator_p = $api['OPRAMETER'];
	
	
    $amount_p = $api['AMNTPARAMETER'];
    $format = $api['APITYPE'];
    $circle_p = $api['APITYPE'];
    $txn_p = $api['TXNIDPARAMETER'];
    $optional_p = $api['OPTNLPARAMETER'];
    $response_type_p = $api['APITYPE'];
    $hit_type_p = $api['APIHITTYPE'];
    
    //result parameters
    $rs_txn_id = $api['RESULT_TXN_PARA'];
    $rs_op_id = $api['RESULT_OP_ID_PARA'];
    $rs_status = $api['RESULT_ST_PARA'];
    $rs_error = $api['RESULT_ERROR_PARA'];
    $success_response = $api['SCSRESPONSE'];
    $pending_response = $api['PNDRESPONDE'];
    
    $rnd_str= substr(str_shuffle("WERTYUIOPsdfghjklmnbvczwedfrgtyhjuiFGHYJNBVb") , 1 ,6);
    $rnd_num = substr(mt_rand(999 , 1000000) , 0  , 5);
    $txn_id = $rnd_str.$rnd_num; // random number genrate for trans. ID
    //start curl request 
    $ch = curl_init();
    //api request url 
    $live_url = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&$txn_p=$txn_id&$optional_p=$circle";
	//$live_url = "$url_p&$mobile_p=$mobile&$amount_p=$amount&$operator_p=$operator&$txn_p=$txn_id&$optional_p=$circle";
    //curl setup
    curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //check api HIT type POST or GET
    if($hit_type_p == "POST"){
        curl_setopt($ch, CURLOPT_POST, TRUE);
    }else{
        curl_setopt($ch, CURLOPT_POST, FALSE);
    }
    
    //curl response 
    $response = curl_exec($ch);
    //curl close 
    curl_close ($ch);
    //insert into api hit all response
    $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live_url' , '$response')");
    
    //get api response type
    if($response_type_p == "JSON"){
        $result = json_decode($response);
    }else if($response_type_p == "XML"){
        $result = simplexml_load_string($response);
    }
    $status_r =  $result->$rs_status; // here r represent response 
    $error_r =  $result->$rs_error;
    $txn_id_r =  $result->$rs_txn_id;
    $operator_id_r =  $result->$rs_op_id;
    // check wheater status is success or pending
  if($status_r == $success_response ||$status_r == $pending_response || strtolower($status_r) == 'success' || strtolower($status_r) == 'pending'){
      
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
                  $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='$backup_api'")->fetch_assoc();
                  $backup_op_longcode = $backup_op['PRODUCTCODE'];
                  backup_api($api_name , $mobile , $backup_op_longcode , $amount , $op_name, $status, $id);
              }
              else{
                  
                  if($status=="admin" || $status=="Api_users"){
                      $owner =="ADMIN";
                      $owner_id = "1";
                  }
                  
                $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
                `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
                ,'$amount','$operator_id_r' ,'Failed','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
                
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
              }
        }
}
 
 
 
 
 
 //backupAPI
 
 
  function backup_api($api_name , $mobile , $backup_op_longcode , $amount , $op_name, $status, $id){
     global $con; // use connection in function 
    $temp_array = array();
    
    
     $myResult = "Failed";
    
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    
    //search api from db 
    $api = $con->query("SELECT * FROM `rechargeApi` WHERE NAME='$api_name' and `STATUS` ='Activate'")->fetch_assoc();
    
    $url_p = $api['APIURL']; // p defines to parameter
    $mobile_p = $api['MBPARAMETER'];
    $operator_p = $api['OPRAMETER'];
    $amount_p = $api['AMNTPARAMETER'];
    $format = $api['APITYPE'];
    $circle_p = $api['APITYPE'];
    $txn_p = $api['TXNIDPARAMETER'];
    $optional_p = $api['OPTNLPARAMETER'];
    $response_type_p = $api['APITYPE'];
    $hit_type_p = $api['APIHITTYPE'];
    
    //result parameters
    $rs_txn_id = $api['RESULT_TXN_PARA'];
    $rs_op_id = $api['RESULT_OP_ID_PARA'];
    $rs_status = $api['RESULT_ST_PARA'];
    $rs_error = $api['RESULT_ERROR_PARA'];
    $success_response = $api['SCSRESPONSE'];
    $pending_response = $api['PNDRESPONDE'];
    
    $txn_id = mt_rand(1000000 , 200000000); // random number genrate for trans. ID
    //start curl request 
    $ch = curl_init();
    //api request url 
    $live_url = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&$txn_p=$txn_id&$optional_p=$hit_type_p";
    //curl setup
    curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //check api HIT type POST or GET
    if($hit_type_p == "POST"){
    curl_setopt($ch, CURLOPT_POST, TRUE);
    }else{
    curl_setopt($ch, CURLOPT_POST, FALSE);
    }
    
    //curl response 
    $response = curl_exec($ch);
    //curl close 
    curl_close ($ch);
    //insert into api hit all response
    $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('BACKUP . $live_url' , '$response')");
    
    //get api response type
    if($response_type_p == "JSON"){
    $result = json_decode($response);
    }else if($response_type_p == "XML"){
    $result = simplexml_load_string($response);
    }
    $status_r =  $result->$rs_status; // here r represent response 
    $error_r =  $result->$rs_error;
    $txn_id_r =  $result->$rs_txn_id;
    $operator_id_r =  $result->$rs_op_id;
    // check wheater status is success or pending
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
            
                if($status=="admin" || $status=="Api_users"){
                      $owner =="ADMIN";
                      $owner_id = "1";
                  }
            
            
    $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
    `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
    ,'$amount','$operator_id_r' ,'Failed','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$bal' ,'Failed' , '0' , '$time')");
              array_push($temp_array,array("result"=>$myResult, "id"=>$operator_id_r));
              echo json_encode($temp_array);
        }
    }
 
 
 
 
 
 
 
 