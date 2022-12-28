<?php
if(isset($_POST['submit_rech'])){
   // $operator = "DI";
	//$mobile = "62589195314
	
	$operator = strip_tags($_POST['operator']);
    $mobile = strip_tags($_POST['mobile']);
	
    $circle = strip_tags($_POST['circle']);
   
    $amount = strip_tags($_POST['amount']);
    $date=date("Y-m-d");
    $q3 = $con->query("SELECT * FROM switchOperator where LONGCODE='$operator'")->fetch_assoc();
    $op_name = $q3['PRODUCTNAME'];

    if($amount=='' || $mobile=='' || $amount < 9){
              header("location:../index.php?error=invaild_amount");
    }else{
           if(!empty($_SESSION['ms_id'])){
                $rt_id = $_SESSION['ms_id'];
                $user = "MASTERDISTRIBUTER";
                 $q = $con->query("SELECT * FROM masterdistributer where ID='$rt_id'")->fetch_assoc();
                 $ms_ctof = $q['CUTTOFFAMOUNT'];
                 $ms_comm = $q['COMM_PACK'];
                 $ms_rcbal = $q['RCBAL'];
            }else if(!empty($_SESSION['ds_id'])){
                 $rt_id = $_SESSION['ds_id'];
                 $user = "DISTRIBUTER";
                 $q = $con->query("SELECT * FROM distributer where ID='$rt_id'")->fetch_assoc();
                 $ms_ctof = $q['CUTTOFFAMOUNT'];
                 $ms_comm = $q['COMM_PACK'];
                 $ms_rcbal = $q['RCBAL'];
            }else if(!empty($_SESSION['rt_id'])){
             $rt_id = $_SESSION['rt_id'];
             $user = "RETAILER";
             $q = $con->query("SELECT * FROM retailer where ID='$rt_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
            }
                 if($amount < $ms_rcbal){
                     if(($ms_rcbal - $amount) < $ms_ctof){
                           header("location:../index.php?error=cuttoff_limit");
                     }else{
                         
                         $api_row = $con->query("select * from user_special_api where USER_TYPE='$user' and USER_ID='$rt_id' and OP_NAME='$op_name'")->fetch_assoc();
                         $api_rows = $con->query("select * from user_special_api where USER_TYPE='$user' and USER_ID='$rt_id' and OP_NAME='$op_name'")->num_rows;
                         if($api_row['API'] != "DEFAULT" && $api_rows == 1){
                             $serchApi = $api_row['API'];
                             $fetch_op = $con->query("SELECT * FROM operatorManager WHERE PRODUCTNAME='".$api_row['OP_NAME']."' and SERVICEAPI='$serchApi'")->fetch_assoc();
                             $fetch_op_code = $fetch_op['PRODUCTCODE'];
                             
                              if($serchApi == "MYRC"){
                                  backmyrc($mobile , $fetch_op_code , $amount , $circle);
                              }
                              elseif($serchApi == "PAISACHARGE"){
                                  backp_charge($mobile , $fetch_op_code , $amount);
                              } 
                              elseif($serchApi == "MROBOTIC"){
                                  backmrobo($mobile , $fetch_op_code , $amount);
                              } 
                              elseif($serchApi == "allindiatopup"){
                                  backallind($mobile , $fetch_op_code , $amount);
                              }
                              elseif($serchApi == "CRYUSH_RECHARGE"){
                                  backcryush($mobile , $fetch_op_code , $amount , $circle);
                              }
                         }else{
                            $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
                              $serchApi = $serch['APICOMPANY'];
                              if($serchApi == "MYRC"){
                                myrc($mobile , $operator , $amount , $circle);
                              }
                              elseif($serchApi == "PAISACHARGE"){
                                  p_charge($mobile , $operator , $amount);
                              } 
                              elseif($serchApi == "MROBOTIC"){
                                  mrobo($mobile , $operator , $amount);
                              } 
                              elseif($serchApi == "allindiatopup"){
                                  allind($mobile , $operator , $amount);
                              }
                             elseif($serchApi == "CRYUSH_RECHARGE"){
                                  crysh($mobile , $operator , $amount , $circle);
                              }
                         }
                         
                  }
             }else{
                 header("location:../index.php?error=invaild_user_amount");
            }
    }
    
}



?>