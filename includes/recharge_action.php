<?php

if(isset($_POST['submit_rech'])){
    $operator = $_POST['operator'];
    $circle = $_POST['circle'];
    $mobile = $_POST['mobile_num'];
    $amount = $_POST['amount'];
    $date=date("Y-m-d");
    $q3 = $con->query("SELECT * FROM switchOperator where LONGCODE='$operator'")->fetch_assoc();
    $op_name = $q3['PRODUCTNAME'];

    if($amount=='' || $mobile=='' || $amount < 9){
            header("location:../index.php?error=invaild_amount");
    }else{
           if(!empty($_SESSION['ms_id'])){
                $rt_id = $_SESSION['ms_id'];
                 $q = $con->query("SELECT * FROM masterdistributer where ID='$rt_id'")->fetch_assoc();
                 $ms_ctof = $q['CUTTOFFAMOUNT'];
                 $ms_comm = $q['COMM_PACK'];
                 $ms_rcbal = $q['RCBAL'];
            }else if(!empty($_SESSION['ds_id'])){
                 $rt_id = $_SESSION['ds_id'];
                 $q = $con->query("SELECT * FROM distributer where ID='$rt_id'")->fetch_assoc();
                 $ms_ctof = $q['CUTTOFFAMOUNT'];
                 $ms_comm = $q['COMM_PACK'];
                 $ms_rcbal = $q['RCBAL'];
            }else if(!empty($_SESSION['rt_id'])){
             $rt_id = $_SESSION['rt_id'];
             $q = $con->query("SELECT * FROM retailer where ID='$rt_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
            }else if(!empty($_SESSION["status"])){
             $rt_id = $_SESSION["status"];
             $q = $con->query("SELECT * FROM admin where ID='$rt_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
            }
          
                 if($amount < $ms_rcbal){
                     if(($ms_rcbal - $amount) < $ms_ctof){
                            echo "<script>alert('cuttoff_limit')</script>";
                     }else{
                        $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
                      $serchApi = $serch['APICOMPANY'];
                      $op_name = $serch['PRODUCTNAME'];
                      $backup_api = $serch['BACKUP_API'];
                      recharge($serchApi , $mobile , $operator , $amount , $backup_api , $op_name);
                    //   if($serchApi == "MYRC"){
                    //     myrc($mobile , $operator , $amount , $circle);
                    //   }
                    //   elseif($serchApi == "PAISACHARGE"){
                    //       p_charge($mobile , $operator , $amount);
                    //   } 
                    //   elseif($serchApi == "MROBOTIC"){
                    //       mrobo($mobile , $operator , $amount);
                    //   } 
                    //   elseif($serchApi == "allindiatopup"){
                    //       allind($mobile , $operator , $amount);
                    //   }
                    //  elseif($serchApi == "CRYUSH_RECHARGE"){
                    //       crysh($mobile , $operator , $amount , $circle);
                    //   }
                    //   elseif($serchApi == "Recharges365"){
                    //       rech365($mobile , $operator , $amount , $circle);
                    //   }
                    //   elseif($serchApi == "EasyPayService"){
                    //       easypay($mobile , $operator , $amount , $circle);
                    //   }  elseif($serchApi == "ROBITIC"){
                    //       robotic($mobile , $operator , $amount , $circle);
                    //   }
                  }
             }else{
                       echo "<script>alert('Invaild Amount')</script>";
             }
    }
    
}

?>