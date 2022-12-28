<?php

session_start();
error_reporting(0);
include("../../includes/config.php");

if(isset($_POST['merchant_amount'])){
 $amount = $_POST['merchant_amount'];
 $od_id = $_POST['merchant_order_id'];
    $a = str_shuffle("srtdcgvhbZSDXRCFGH345879023JNK");
    
    setcookie("rand_num" , $a);
    setcookie("amount" , $amount);
    setcookie("od_id" , $od_id);
}

$amount1 = $_COOKIE["amount"];
$od_id1 = $_COOKIE["od_id"];
$rand = $_COOKIE["rand_num"];

echo $amount1;
if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $token = $_GET['token'];
    
    if($user_id == ""){
        echo "<script> alert('Access Denied For You') 
        </script>";
    }
    else if($token == $rand){
            $my_id = $_SESSION['rt_id'];
            $q = $con->query("SELECT * FROM `retailer` where ID='$my_id'");
            $row = $q->fetch_assoc();
             $my_amount = $row['RCBAL'];
                $up_bal = $my_amount + $amount1;
             $q = $con->query("UPDATE retailer SET RCBAL= '$up_bal' WHERE ID='$my_id'");
                    if($q){
                        $date = date("Y-m-d");
                        $con->query("INSERT INTO `online_recharge`(`USER`, `USER_ID`, `AMOUNT`, `STATUS`, `ORDER_ID`, `DATE`) VALUES('RETAILER' , '$my_id' , '$amount1' , 'Success' ,'$od_id1' , '$date')");
                        header("../index.php?msg=Payment Successfull");
                   }
         }else{
            echo "<script>alert('Access Denied For You')
            location.replace('index.php');
            </script>";
         }
}
?>
