<?php

session_start();
error_reporting(0);
include("../../includes/config.php");
$amount1 = $_COOKIE["amount"];
$od_id1 = $_COOKIE["od_id"];
$rand = $_COOKIE["rand_num"];
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
            $date = date("Y-m-d");
            $con->query("INSERT INTO `online_recharge`(`USER`, `USER_ID`, `AMOUNT`, `STATUS`, `ORDER_ID`, `DATE`) VALUES('RETAILER' , '$my_id' , '$amount1' , 'Failed' ,'$od_id1' , '$date')");
            header("../index.php?msg=Failed Payment");
         }else{
            echo "<script>alert('Access Denied For You')
            </script>";
         }
}
?>
