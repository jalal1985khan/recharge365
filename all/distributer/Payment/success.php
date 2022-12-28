<?php

session_start();
error_reporting(0);

if(empty($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0){
 header("location:../login.php")   ;
}

include("../includes/config.php");

if(isset($_POST['merchant_amount'])){
 $amount = $_POST['merchant_amount'];
 $od_id = $_POST['merchant_order_id'];
$a = str_shuffle("aksdjhuqeibsandiuwfy32912681sa*&@!#%!&(!)*)!^@#8uyut79123t");

setcookie("rand_num" , $a);
setcookie("amount" , $amount);
setcookie("od_id" , $od_id);


}
$amount1 = $_COOKIE["amount"];
$od_id1 = $_COOKIE["od_id"];
$rand = $_COOKIE["rand_num"];
// echo $rand;
if(isset($_GET['username'])){
    $username = $_GET['username'];
    $user_id = $_GET['id'];
    $token = $_GET['token'];
}

if($username == "" || $user_id ==""){
        echo "<script> alert('Access Denied For You') 
        location.replace('../myaccount.php');
        </script>";
    }
    else if($token != $rand){
        echo "work";
            $my_id = $_SESSION['logged_in'];
            $q = $con->query("SELECT * FROM `my_users` where ID='$my_id'");
            $row = $q->fetch_assoc();
            $name = $row["USERNAME"];
             $my_amount = $row['WALLET_MONEY'];
            //  echo $amount1. "<br>";
             $insert = $con->query("INSERT INTO `trans`(`USER_ID`, `NAME`, `AMOUNT`, `M_ORDER_ID`) VALUES('$my_id' ,'$name','$amount1' , '$od_id1' )");
             if($insert){
                $up_bal = $my_amount + $amount1;
             $q = $con->query("UPDATE my_users SET WALLET_MONEY= '$up_bal' WHERE ID='$my_id'");
                    if($q){
                   header("location:../myaccount.php?msg=Payment Successfull.") ;
                   }
            }     
     }else{
        echo "<script>alert('Access Denied For You')
         location.replace('../myaccount.php');
        </script>";
     }
?>
