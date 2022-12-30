<?php

include("../../includes/config.php");
    $id = $_POST['id'];
    $status = $_POST['status'];
    $password = $_POST['password'];
    $pass = md5($password);
    
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $ofMobile = $_POST['ofMobile'];
    
    
        $todayBalance=0;
        $usedBalance = 0;
        $currentBalance=0;
        $givenToday=0;
        $purchaseBalance=0;
        $pendingBalance=0;
        $refundBalance=0;
        $details = $con->query("select * from `$status` where ID='$id'")->fetch_assoc();
        $currentBalance = (int)$details['RCBAL'];
    
    if($ofMobile=""){
         
        $date = date("Y-m-d");
        $temp_array = array();
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $usedBalance = $usedBalance+(int)$row['AMOUNT'];    

            }    
        }
        
                $mysql_qry = "SELECT * FROM `amount_req` WHERE  DATE >= '$fromDate' and DATE <= '$toDate' AND USER_ID = '$id' AND USER ='$status' and STATUS = 'sender' and TYPE ='Debit'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $usedBalance = $usedBalance+(int)$row['AMOUNT'];
                    $givenToday = $givenToday+(int)$row['AMOUNT'];

            }    
        }
        
                        $mysql_qry = "SELECT * FROM `amount_req` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and USER_ID = '$id' AND USER ='$status' and STATUS = 'reciever' and TYPE ='credit'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $purchaseBalance = $purchaseBalance+(int)$row['AMOUNT'];

            }    
        }
        
                                $mysql_qry = "SELECT * FROM `online_recharge` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and USER_ID = '$id' AND USER ='$status' and STATUS = 'success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $purchaseBalance = $purchaseBalance+(int)$row['AMOUNT'];

            }    
        }
        
         $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'pending'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $pendingBalance = $pendingBalance+(int)$row['AMOUNT'];

            }    
        }
                 $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'refund'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $refundBalance = $refundBalance+(int)$row['AMOUNT'];

            }    
        }
        
        $openingBalance = (int)$currentBalance+(int)$usedBalance;
        $openingBalance = $openingBalance-(int)$purchaseBalance;
        
        
    }
    else{
     
             $date = date("Y-m-d");
        $temp_array = array();
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Success' and MOBILE = '$ofMobile'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $usedBalance = $usedBalance+(int)$row['AMOUNT'];    

            }    
        }
        
        
        
    
        $mysql_qry = "SELECT * FROM `amount_req` WHERE  DATE >= '$fromDate' and DATE <= '$toDate' AND USER_ID = '$id' AND USER ='$status' and STATUS = 'sender' and TYPE ='Debit'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $usedBalance = $usedBalance+(int)$row['AMOUNT'];
                    $givenToday = $givenToday+(int)$row['AMOUNT'];

            }    
        }
        
                        $mysql_qry = "SELECT * FROM `amount_req` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and USER_ID = '$id' AND USER ='$status' and STATUS = 'reciever' and TYPE ='credit'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $purchaseBalance = $purchaseBalance+(int)$row['AMOUNT'];

            }    
        }
        
                                $mysql_qry = "SELECT * FROM `online_recharge` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and USER_ID = '$id' AND USER ='$status' and STATUS = 'success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $purchaseBalance = $purchaseBalance+(int)$row['AMOUNT'];

            }    
        }
        
         $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'pending'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $pendingBalance = $pendingBalance+(int)$row['AMOUNT'];

            }    
        }
                 $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'refund'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                    $refundBalance = $refundBalance+(int)$row['AMOUNT'];

            }    
        }
        
        $openingBalance = (int)$currentBalance+(int)$usedBalance;
        $openingBalance = $openingBalance-(int)$purchaseBalance;   
        
    }
        
        array_push($temp_array,array("openingBalance"=>$openingBalance,"closingBalance"=>$currentBalance,"Transfer"=>$givenToday,"purchaseBalance"=>$purchaseBalance,"pendingBalance"=>$pendingBalance,"refundBalance"=>$refundBalance));
        echo json_encode($temp_array);
    
?>