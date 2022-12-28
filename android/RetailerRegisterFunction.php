  <?php
  
  include("config.php");
  
// mail funtion
function SendMail($email,$message){

$subject = "Password Details";

// mail id to be changed to server mail id
$headers = 'From: recharges365.com' . "\r\n" .
  'Reply-To:  recharges365.com' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

// Send the email
if ($error == FALSE) {
  if(mail($email, $subject, $message, $headers)) {

    // echo "<script> alert('The email was sent.')</script>";
    
    }
    else {
    echo json_encode("The email fail to sent");
    $error = TRUE;
    }
}
}


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
         
// recharge365 portal api 

// function rech365($mobile , $operator , $amount ){
//               global $con;
//               date_default_timezone_set('Asia/Kolkata');
//                 $date = date("Y-m-d");
//                 $time = date("g:i:s A");  
//               $ch = curl_init();
//               $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
//               $serchApi = $serch['APICOMPANY'];
//                       $op_name = $serch['PRODUCTNAME'];
//               $backup_api = $serch['BACKUP_API'];
//               $query = "SELECT * FROM `rechargeApi` WHERE NAME='$serchApi' and `STATUS` ='Activate'";
//               $run = mysqli_query($con , $query);
//               $api = mysqli_fetch_array($run);
//               $order_id = mt_rand(1000000 , 200000000);
//               $url_p = $api['APIURL'];
//               $mobile_p = $api['MBPARAMETER'];
//               $operator_p = $api['OPRAMETER'];
//               $amount_p = $api['AMNTPARAMETER'];
//               $format = $api['APITYPE'];
//               $circle_p = $api['OPTNLPARAMETER'];
// 				 $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&order_id=$order_id";
//             //   $live = "https://mrobotics.in/api/recharge_get?api_token=1e61a883-3dc5-4da0-aee3-275912305619&mobile_no=8640000118&amount=10&company_id=2&order_id=$order_id&is_stv=false";
//                 // echo $live;
//           curl_setopt($ch, CURLOPT_URL, $live); //Using live here
//           curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//           curl_setopt($ch, CURLOPT_HEADER, FALSE);
//           curl_setopt($ch, CURLOPT_POST, FALSE);
        
//          $response = curl_exec($ch);
//       $con->query("INSERT INTO `apiHit`(`API`, `RESPONSE`) VALUES('$live' , '$response')");
//         //  echo $response;
//          curl_close ($ch);
//           $result = json_decode($response);
//           $status_r = $result->status;
//           $txn_id_r = $result->transaction_id;
//           $orderid_r = $result->order_id;
//           $msg = $result->msg;
//           $mobile_r = $result->mobile_no;
//           $amount_r = $result->amount;
//           $operator_id_r = $result->operator_id;
          
//   if($status_r == 'Success' || $status_r == 'success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
//           if(!empty($_SESSION['ms_id']) && isset($_SESSION['ms_id']) && $_SESSION['ms_id'] != "" ){
//               $ms_id = $_SESSION['ms_id'];
//               $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
//               $ms_admin = $ad_row['OWNER'];
//               $ms_admin_id = $ad_row['ADMIN_ID'];
//               $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
//              $ms_comm = $ad_row['COMM_PACK'];
//              $ms_rcbal = $ad_row['RCBAL'];
//              $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                 $prcent = $q2['PERCENTAGE'];
//                 $am = ($amount/100)*$prcent;
//                 $am2 = $amount-$am;
//                 $am3 = $ms_rcbal - $am2;
//               $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
//               ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'RECH365' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
//               $run3 = mysqli_query($con , $query3);
//               if($run3){
//                     $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
//                     if($q4){
//                         $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date') ");
//                       }
//               }
//                   echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//           }
//           else if(!empty($_SESSION['ds_id']) && isset($_SESSION['ds_id']) && $_SESSION['ds_id'] != "" ){
//               $ms_id = $_SESSION['ds_id'];
//               $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
//               $ms_admin = $ad_row['OWNER'];
//               $ms_admin_id = $ad_row['MS_ID'];
//               $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
//                  $ms_comm = $ad_row['COMM_PACK'];
//                  $ms_rcbal = $ad_row['RCBAL'];
//                  $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                     $prcent = $q2['PERCENTAGE'];
//                     $am = ($amount/100)*$prcent;
//                     $am2 = $amount-$am;
//                     $am3 = $ms_rcbal - $am2;
              
                        
//               $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
//               VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'RECH365' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
//               $run3 = mysqli_query($con , $query3);
//               if($run3){
//                     $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
//                     if($q4){
//                         if($ms_admin == "MASTERDISTRIBUTER"){
//                             //retailer owner comiision
//                             $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
//                             $rt_owner_comm = $rt_owner['COMM_PACK'];
//                             $rt_owner_rcbal = $rt_owner['RCBAL'];
//                             $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $comm_prcnt = $comm_pack['PERCENTAGE'];
//                             $ow_am = ($amount/100)*$comm_prcnt;
//                             $owner_cm = $ow_am - $am;
//                             $update_owner = $rt_owner_rcbal + $owner_cm;
//                             $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','DISTRIBUTER','$owner_cm' , '$op_name' , '$date') ");
//                         }
//                         $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date') ");
//                     }
//               }
//                   echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//           }
//           else   if(!empty($_SESSION['rt_id']) && isset($_SESSION['rt_id']) && $_SESSION['rt_id'] != "" ){
//               $ms_id = $_SESSION['rt_id'];
//               $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
//               $ms_admin = $ad_row['OWNER'];
//               $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
//              $ms_comm = $ad_row['COMM_PACK'];
//              $ms_rcbal = $ad_row['RCBAL'];
                      
//                  $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                 $prcent = $q2['PERCENTAGE'];
//                 $am = ($amount/100)*$prcent;
//                 $am2 = $amount-$am;
//                 $am3 = $ms_rcbal - $am2;
//              if($ms_admin == "MASTERDISTRIBUTER"){
//                       $ms_admin_id = $ad_row['MS_ID'];
//                   }elseif($ms_admin == "DISTRIBUTER"){
//                     $ms_admin_id = $ad_row['DISTRIBUTER'];
//                   }else{
//                       $ms_admin_id = 1;
//                   }
//               $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
//               VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' ,
//               'RECH365' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
//               $run3 = mysqli_query($con , $query3);
//               if($run3){
//                         $q4 = $con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'");
//                         if($q4){
//                              if($ms_admin == "MASTERDISTRIBUTER"){
//                             //retailer owner comiision
//                             $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
//                             $rt_owner_comm = $rt_owner['COMM_PACK'];
//                             $rt_owner_rcbal = $rt_owner['RCBAL'];
//                             $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $comm_prcnt = $comm_pack['PERCENTAGE'];
//                             $ow_am = ($amount/100)*$comm_prcnt;
//                             $owner_cm = $ow_am - $am;
//                             $update_owner = $rt_owner_rcbal + $owner_cm;
//                             $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','RETAILER','$owner_cm' , '$op_name' , '$date') ");
//                         }else  if($ms_admin == "DISTRIBUTER"){
//                              //retailer owner comiision
//                             $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
//                             $rt_owner_comm = $rt_owner['COMM_PACK'];
//                             $rt_owner_rcbal = $rt_owner['RCBAL'];
//                             $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $comm_prcnt = $comm_pack['PERCENTAGE'];
//                             $ow_am = ($amount/100)*$comm_prcnt;
//                             $owner_cm = $ow_am - $am;
//                             $update_owner = $rt_owner_rcbal + $owner_cm;
//                             $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('DISTRIBUTER','$ms_admin_id','RETAILER','$owner_cm' , '$op_name' , '$date') ");
//                             $ds_owner = $rt_owner['OWNER'];
//                             $ds_owner_id = $rt_owner['MS_ID'];
                            
//                             if($ds_owner == "MASTERDISTRIBUTER"){
//                             $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
//                             $ds_owner_comm = $dis_owner['COMM_PACK'];
//                             $ds_owner_rcbal = $dis_owner['RCBAL'];
//                             $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
//                             $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
//                             $ds_owner_cm = $ds_ow_am - $ow_am;
//                             $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                            
//                             $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','DISTRIBUTER','$ds_owner_cm' , '$op_name' , '$date') ");
//                             }
//                         }
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name' , '$date') ");
//                         }
//                   }
//                   echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//               }
//           else if(!empty($_SESSION["status"]) && isset($_SESSION["status"]) && $_SESSION["status"] != "" ){
//                   $rt_id = $_SESSION["status"]; 
//                     $rt_data = $con->query("select * from admin where ID='1'")->fetch_assoc();
//                     $rt_rcbal = $rt_data['RCBAL'];
//                     $am3 = $rt_rcbal - $amount;
//                   $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
//                   VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'RECH365' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
//                   $run3 = mysqli_query($con , $query3);
//                   if($run3){
//                         $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
//                         if($q4){
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('ADMIN','$rt_id','$prcent','$am' , '$op_name' , '$date') ");
//                         }
//               }
//                       echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//           }
 
//           }else{
//                  if(!empty($_SESSION['ms_id'])){
//                 $person = "MASTERDISTRIBUTER";
//                 $person_id = $_SESSION['ms_id'];
//                  $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
//                  $owner  = $person_row['OWNER'];
//                  $owner_id = $person_row['ADMIN_ID'];
                 
//             }else if(!empty($_SESSION['ds_id'])){
//                 $person = "DISTRIBUTER";
//                 $person_id = $_SESSION['ds_id'];
//                 $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
//                 $owner = $ad_row['OWNER'];
//                 $owner_id = $ad_row['MS_ID'];
//             }else if(!empty($_SESSION['rt_id'])){
//                 $person = "retailer";
//                 $person_id = $_SESSION['rt_id'];
//                 $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
//                   $owner = $ad_row['OWNER'];
//                   if($owner == "MASTERDISTRIBUTER"){
//                       $owner_id = $ad_row['MS_ID'];
//                   }elseif($owner == "DISTRIBUTER"){
//                     $owner_id = $ad_row['DISTRIBUTER'];
//                   }else{
//                       $owner_id = 1;
//                   }
//             }
            
//             $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
//             `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
//             ,'$amount','$operator_id_r' ,'Failed','$txn_id_r','$orderid_r' , 'RECH365' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");
//             echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//         }
// }



// // easypay Api Function
// function easypay($mobile , $operator , $amount ){
//               global $con;
//               date_default_timezone_set('Asia/Kolkata');
// $date = date("Y-m-d");
// $time = date("g:i:s A");  

//               $ch = curl_init();
//               $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
//               $serchApi = $serch['APICOMPANY'];
//                       $op_name = $serch['PRODUCTNAME'];
//               $backup_api = $serch['BACKUP_API'];
//               $query = "SELECT * FROM `rechargeApi` WHERE NAME='$serchApi' and `STATUS` ='Activate'";
//               $run = mysqli_query($con , $query);
//               $api = mysqli_fetch_array($run);
//               $order_id = mt_rand(1000000 , 200000000);
//               $url_p = $api['APIURL'];
//               $mobile_p = $api['MBPARAMETER'];
//               $operator_p = $api['OPRAMETER'];
//               $amount_p = $api['AMNTPARAMETER'];
//               $format = $api['APITYPE'];
//               $circle_p = $api['OPTNLPARAMETER'];
//               $live = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&reqid=$order_id&field1=&field2=";
//                 // echo $live;
        
//           curl_setopt($ch, CURLOPT_URL, $live); //Using live here
//           curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//           curl_setopt($ch, CURLOPT_HEADER, FALSE);
//           curl_setopt($ch, CURLOPT_POST, FALSE);
        
//          $response = curl_exec($ch);
//         //  echo $response . "<br><br>";
//       $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live' , '$response')");
//         //  echo $response;
//          curl_close ($ch);
//          $result = simplexml_load_string($response);
         
//      $status_r_code =  $result->ec;
//          $txn_id_r =  $result->reqid;
//          $t_status =  $result->TStatus;
//          $status_r =  $result->status;
	
//          $operator_id_r =  $result->field1;
//     if($status_r == 'Success' || $status_r == 'SUCCESS' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'PENDING' || $status_r == 'Sucess' || $status_r == ' Sucess '){
//           if(!empty($_SESSION['ms_id']) && isset($_SESSION['ms_id']) && $_SESSION['ms_id'] != "" ){
//               $ms_id = $_SESSION['ms_id'];
//               $ad_row = $con->query("SELECT * FROM masterdistributer where ID='$ms_id'")->fetch_assoc();
//               $ms_admin = $ad_row['OWNER'];
//               $ms_admin_id = $ad_row['MS_ID'];
//               $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
//                  $ms_comm = $ad_row['COMM_PACK'];
//                  $ms_rcbal = $ad_row['RCBAL'];
//                      $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                         $prcent = $q2['PERCENTAGE'];
//                         $am = ($amount/100)*$prcent;
//                         $am2 = $amount-$am;
//                         $am3 = $ms_rcbal - $am2;
                 
//               $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` 
//               ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
//               VALUES('$ms_admin','1','MASTERDISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'ALLINDIATOPUP' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
//               $run3 = mysqli_query($con , $query3);
//               if($run3){
//                         $q4 = $con->query("UPDATE masterdistributer set RCBAL='$am3' where ID='$ms_id'");
//                         if($q4){
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date') ");
//                             }
//                  }
//                   echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//           }
//           else if(!empty($_SESSION['ds_id']) && isset($_SESSION['ds_id']) && $_SESSION['ds_id'] != "" ){
//               $ms_id = $_SESSION['ds_id'];
//               $ad_row = $con->query("SELECT * FROM distributer where ID='$ms_id'")->fetch_assoc();
//               $ms_admin = $ad_row['OWNER'];
//               $ms_admin_id = $ad_row['MS_ID'];
//               $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
//                  $ms_comm = $ad_row['COMM_PACK'];
//                  $ms_rcbal = $ad_row['RCBAL'];
//                      $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                         $prcent = $q2['PERCENTAGE'];
//                         $am = ($amount/100)*$prcent;
//                         $am2 = $amount-$am;
//                         $am3 = $ms_rcbal - $am2;
                 
//               $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` 
//               ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) 
//               VALUES('$ms_admin','$ms_admin_id','DISTRIBUTER','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'ALLINDIATOPUP' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')";
//               $run3 = mysqli_query($con , $query3);
//               if($run3){
//                         $q4 = $con->query("UPDATE distributer set RCBAL='$am3' where ID='$ms_id'");
//                         if($q4){
//                           if($ms_admin == "MASTERDISTRIBUTER"){
//                             //retailer owner comiision
//                             $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
//                             $rt_owner_comm = $rt_owner['COMM_PACK'];
//                             $rt_owner_rcbal = $rt_owner['RCBAL'];
//                             $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $comm_prcnt = $comm_pack['PERCENTAGE'];
//                             $ow_am = ($amount/100)*$comm_prcnt;
//                             $owner_cm = $ow_am - $am;
//                             $update_owner = $rt_owner_rcbal + $owner_cm;
//                             $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','DISTRIBUTER','$owner_cm' , '$op_name' , '$date') ");
//                         }
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('DISTRIBUTER','$ms_id','$prcent','$am' , '$op_name' , '$date') ");
//                             }
//               }
//                   echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//           }
//           else   if(!empty($_SESSION['rt_id']) && isset($_SESSION['rt_id']) && $_SESSION['rt_id'] != "" ){
//               $ms_id = $_SESSION['rt_id'];
//               $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
//               $ms_admin = $ad_row['OWNER'];
//                 $ms_ctof = $ad_row['CUTTOFFAMOUNT'];
//                  $ms_comm = $ad_row['COMM_PACK'];
//                  $ms_rcbal = $ad_row['RCBAL'];
//                   if($ms_admin == "MASTERDISTRIBUTER"){
//                       $ms_admin_id = $ad_row['MS_ID'];
//                   }elseif($ms_admin == "DISTRIBUTER"){
//                     $ms_admin_id = $ad_row['DISTRIBUTER'];
//                   }else{
//                       $ms_admin_id = 1;
//                   }
//                       //retailer balance commision
//                      $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ms_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                     $prcent = $q2['PERCENTAGE'];
//                     $am = ($amount/100)*$prcent;
//                     $am2 = $amount-$am;
//                     $am3 = $ms_rcbal - $am2;
                    
//               $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`
//               ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','$ms_admin_id','retailer','$ms_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 
//               'ALLINDIATOPUP' , '$op_name' , '$date' , '$am3' ,'Debit' , '$am2' , '$time')";
//               $run3 = mysqli_query($con , $query3);
//               if($run3){
//                     if($con->query("UPDATE retailer set RCBAL='$am3' where ID='$ms_id'")){
//                         if($ms_admin == "MASTERDISTRIBUTER"){
//                             //retailer owner comiision
//                             $rt_owner = $con->query("select * from masterdistributer where ID='$ms_admin_id'")->fetch_assoc();
//                             $rt_owner_comm = $rt_owner['COMM_PACK'];
//                             $rt_owner_rcbal = $rt_owner['RCBAL'];
//                             $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $comm_prcnt = $comm_pack['PERCENTAGE'];
//                             $ow_am = ($amount/100)*$comm_prcnt;
//                             $owner_cm = $ow_am - $am;
//                             $update_owner = $rt_owner_rcbal + $owner_cm;
//                             $con->query("update masterdistributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ms_admin_id','RETAILER','$owner_cm' , '$op_name' , '$date') ");
//                         }else  if($ms_admin == "DISTRIBUTER"){
//                              //retailer owner comiision
//                             $rt_owner = $con->query("select * from distributer where ID='$ms_admin_id'")->fetch_assoc();
//                             $rt_owner_comm = $rt_owner['COMM_PACK'];
//                             $rt_owner_rcbal = $rt_owner['RCBAL'];
//                             $comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$rt_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $comm_prcnt = $comm_pack['PERCENTAGE'];
//                             $ow_am = ($amount/100)*$comm_prcnt;
//                             $owner_cm = $ow_am - $am;
//                             $update_owner = $rt_owner_rcbal + $owner_cm;
//                             $con->query("update distributer set RCBAL='$update_owner' where ID='$ms_admin_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('DISTRIBUTER','$ms_admin_id','RETAILER','$owner_cm' , '$op_name' , '$date') ");
//                             $ds_owner = $rt_owner['OWNER'];
//                             $ds_owner_id = $rt_owner['MS_ID'];
                            
//                             if($ds_owner == "MASTERDISTRIBUTER"){
//                             $dis_owner = $con->query("select * from masterdistributer where ID='$ds_owner_id'")->fetch_assoc();
//                             $ds_owner_comm = $dis_owner['COMM_PACK'];
//                             $ds_owner_rcbal = $dis_owner['RCBAL'];
//                             $ds_comm_pack = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$ds_owner_comm' and OP_NAME='$op_name'")->fetch_assoc();
//                             $ds_comm_prcnt = $ds_comm_pack['PERCENTAGE'];
//                             $ds_ow_am = ($amount/100)*$ds_comm_prcnt;
//                             $ds_owner_cm = $ds_ow_am - $ow_am;
//                             $update_ds_owner = $ds_owner_rcbal + $ds_owner_cm;
                            
//                             $con->query("update masterdistributer set RCBAL='$update_ds_owner' where ID='$ds_owner_id'");
//                             $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('MASTERDISTRIBUTER','$ds_owner_id','DISTRIBUTER','$ds_owner_cm' , '$op_name' , '$date') ");
//                             }
//                         }
//                         $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('RETAILER','$ms_id','$prcent','$am' , '$op_name' , '$date') ");
//                     }
//               }
//                   echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//           }
//           else if(!empty($_SESSION["status"]) && isset($_SESSION["status"]) && $_SESSION["status"] != "" ){
//                   $query3 = "INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE` ) 
//                   VALUES('ADMIN','1','ADMIN','1', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'ALLINDIATOPUP' , '$op_name' , '$date' )";
//                   $run3 = mysqli_query($con , $query3);
//                   if($run3){
//                             $rt_id = $_SESSION["status"]; 
//                             $rt_data = $con->query("select * from admin where ID='1'")->fetch_assoc();
//                             $rt_rcbal = $rt_data['RCBAL'];
//                       if($status_r == 'Success' || $status_r == 'PENDING' || $status_r == 'pending' || $status_r == 'Pending' || $status_r == 'Sucess'){
//                              $q2 = $con->query("SELECT * FROM apiMargin where OP_NAME='$op_name' and API='ALLINDIATOPUP'")->fetch_assoc();
//                                 $prcent = $q2['PERCENT'];
//                                 $am = ($amount/100)*$prcent;
//                                 $am2 = $amount-$am;
//                                 $am3 = $rt_rcbal - $am2;
//                                 $q4 = $con->query("UPDATE admin set RCBAL='$am3' where ID='$rt_id'");
//                                 if($q4){
//                                 $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('ADMIN','$rt_id','$prcent','$am' , '$op_name' , '$date') ");
//                                 }
//                       }
                         
//                   }
//                       echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
//               }
    
//         }else{
//              if(!empty($_SESSION['ms_id'])){
//                 $person = "MASTERDISTRIBUTER";
//                 $person_id = $_SESSION['ms_id'];
//                  $person_row = $con->query("SELECT * FROM masterdistributer where ID='$person_id'")->fetch_assoc();
//                  $owner  = $person_row['OWNER'];
//                  $owner_id = $person_row['ADMIN_ID'];
                 
//             }else if(!empty($_SESSION['ds_id'])){
//                 $person = "DISTRIBUTER";
//                 $person_id = $_SESSION['ds_id'];
//                 $ad_row = $con->query("SELECT * FROM distributer where ID='$person_id'")->fetch_assoc();
//                 $owner = $ad_row['OWNER'];
//                 $owner_id = $ad_row['MS_ID'];
//             }else if(!empty($_SESSION['rt_id'])){
//                 $person = "retailer";
//                 $person_id = $_SESSION['rt_id'];
//                 $ad_row = $con->query("SELECT * FROM retailer where ID='$ms_id'")->fetch_assoc();
//                   $owner = $ad_row['OWNER'];
//                   if($owner == "MASTERDISTRIBUTER"){
//                       $owner_id = $ad_row['MS_ID'];
//                   }elseif($owner == "DISTRIBUTER"){
//                     $owner_id = $ad_row['DISTRIBUTER'];
//                   }else{
//                       $owner_id = 1;
//                   }
//             }
            
//             $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
//             `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('$owner','$owner_id','$person','$person_id', '$mobile'
//             ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$orderid_r' , 'ALLINDIATOPUP' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");
            
//               if($backup_api == "MYRC"){
//               $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MYRC'")->fetch_assoc();
//               $backup_op_longcode = $backup_op['PRODUCTCODE'];
//                 backmyrc($mobile , $backup_op_longcode , $amount , $circle);
//               }
//               elseif($backup_api == "PAISACHARGE"){
//                   $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='PAISACHARGE'")->fetch_assoc();
//               $backup_op_longcode = $backup_op['PRODUCTCODE'];
//                   backp_charge($mobile , $backup_op_longcode , $amount);
//               } 
//               elseif($backup_api == "MROBOTIC"){
//                   $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='MROBOTIC'")->fetch_assoc();
//               $backup_op_longcode = $backup_op['PRODUCTCODE'];
//                   backmrobo($mobile , $backup_op_longcode , $amount);
//               } 
//               elseif($backup_api == "CRYUSH RECHARGE"){
//                   $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='CRYUSH_RECHARGE'")->fetch_assoc();
//               $backup_op_longcode = $backup_op['PRODUCTCODE'];
//                   backcryush($mobile , $backup_op_longcode , $amount);
//               }else{
//                 echo "<script>alert('".$status_r." ".$operator_id_r."')</script>";
                  
//               }
//         }
// }