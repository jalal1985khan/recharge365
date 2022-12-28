<?php

session_start();
// error_reporting(0);
include("../config.php");

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
if(isset($_GET['user_id']) && isset($_GET['user_type'])){
    $user_id = $_GET['user_id'];
    $user_type = $_GET['usert_type'];
    $token = $_GET['token'];
    if($user_type == "RETAILER"){
        $user = $con->query("select * from retailer where ID='$user_id'")->fetch_assoc();
        $user_wallet = $user["RCBAL"];
        $add_bal = $user_wallet + $amount1;
        if($con->query("update retailer set RCBAL='$add_bal' where ID='$user_id'")){
            echo "<script> alert('Amount Added') 
                    location.replace('../../retailer/index.php');
                    </script>";
        }
    }elseif($user_type == "MASTERDISTRIBUTER"){
        $user = $con->query("select * from masterdistributer where ID='$user_id'")->fetch_assoc();
        $user_wallet = $user["RCBAL"];
        $add_bal = $user_wallet + $amount1;
        if($con->query("update masterdistributer set RCBAL='$add_bal' where ID='$user_id'")){
            echo "<script> alert('Amount Added') 
                    location.replace('../../masterdistributer/index.php');
                    </script>";
        }
    }elseif($user_type == "DISTRIBUTER"){
        $user = $con->query("select * from distributer where ID='$user_id'")->fetch_assoc();
        $user_wallet = $user["RCBAL"];
        $add_bal = $user_wallet + $amount1;
        if($con->query("update distributer set RCBAL='$add_bal' where ID='$user_id'")){
            echo "<script> alert('Amount Added') 
                    location.replace('../../distributer/index.php');
                    </script>";
        }
    }
}

if($username == "" || $user_id ==""){
        echo "<script> alert('Access Denied For You')
        location.replace('../../../login.php');
        </script>";
    }
    else if($token != $rand){
            $my_id = $_SESSION['rt_id'];
     }else{
        echo "<script>alert('Access Denied For You')
         location.replace('../../../login.php');
        </script>";
     }
?>
