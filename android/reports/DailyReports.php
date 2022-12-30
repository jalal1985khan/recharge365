<?php

include("../../includes/config.php");
    $id = $_POST['id'];
    $status = $_POST['status'];
    $myname = $status;
    
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $password = $_POST['password'];
    $pass = md5($password);
    
        $todayBalance=0;
        $usedBalance = 0;
        $currentBalance=0;
        $givenToday=0;
        $purchaseBalance=0;
        $pendingBalance=0;
        $refundBalance=0;
        $totalRechargeBalance=0;
        $deductBalance=0;
        $commissionBalances=0;
        $openingBalance=0;
        $transferBalance=0;
        
        
        
        
        //new Version
        
        $myRecharges=0;
        $myCommissions=0;
        $myUsersRecharge=0;
        $totalRecharges=0;
        
        $upiAddedMoney = 0;
        $offlineAddedMoney =0;
        $debitedMoney = 0;
        $dailyDeductionMoney=0;
        $myCommissionsfirst=0;
        
        
        $details = $con->query("select * from `$status` where ID='$id'")->fetch_assoc();
        $currentBalance = (float)$details['RCBAL'];
        
        if($fromDate=="" && $toDate==""){
            
               
        $date = date("Y-m-d");
        $temp_array = array();
        
        
        
        if($status=="admin"){
        
        //My All Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Success' and DATE = '$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $myRecharges = $myRecharges + (float)$row['AMOUNT'];

            }    
        }
        //My All Recharges ends
        
        
        //AdminDailyDeduction Starts
        
        $mysql_qry = "SELECT * FROM `admin_deduction` WHERE DATE = '$date' AND BAL_TYPE='RCBAL'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $dailyDeductionMoney = $dailyDeductionMoney + (float)$row['AMOUNT'];

            }    
        }
        
        //AdminDailyDeduction Ends
        
        
        
        //Admin offline Wallet Starts Credits
        
        $mysql_qry = "SELECT * FROM `admin_deduction` WHERE DATE = '$date' AND STATUS='Credit' AND BAL_TYPE='RCBAL'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                                            
                    $purchaseBalance = $purchaseBalance+(float)$row['AMOUNT'];
                    $offlineAddedMoney = $offlineAddedMoney + (float)$row['AMOUNT'];

            }    
        }
        
        //Admin offline Wallet Ends Credits
        
        
                //Admin offline Wallet Starts Debits
        
        $mysql_qry = "SELECT * FROM `admin_deduction` WHERE DATE = '$date' AND STATUS='Debit' AND BAL_TYPE='RCBAL'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $offlineAddedMoney = $offlineAddedMoney - (float)$row['AMOUNT'];

            }    
        }
        
        //Admin offline Wallet Ends Debits
        
        
        
        
        
        
        
        
                //Total All Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE STATUS = 'Success' and DATE = '$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    $totalRecharges = $totalRecharges + (float)$row['AMOUNT'];

            }    
        }
        //Total All Recharges ends
        
        

            
        }
        else{
            
        //My All Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Success' and DATE = '$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    // $usedBalance = $usedBalance+(float)$row['AMOUNT']; 
                    $myRecharges = $myRecharges + (float)$row['AMOUNT'];

            }    
        }
        //My All Recharges ends
        
        
        //My Users Recharges
        
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE OWNER_ID = '$id' AND OWNER ='$status' and STATUS = 'Success' and DATE = '$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    $myUsersRecharge = $myUsersRecharge+(float)$row['AMOUNT'];

            }    
        }
        
        //My Users Recharges Ends
            
        
            $totalRecharges=$myUsersRecharge+$myRecharges;
            
        }
        
        
        
        
        
        //My All Pending Recharges Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Pending' and DATE = '$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $pendingBalance = $pendingBalance + (float)$row['AMOUNT'];

            }    
        }
        //My All Pending Recharges ends
        
        
        
        //My All refund Recharges Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON ='$status' and STATUS ='Failed' and DATE = '$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $refundBalance = $refundBalance + (float)$row['AMOUNT'];

            }    
        }
        //My All refund Recharges ends
        
        
        
        
        
        //Users offline Wallet Starts Credits
        $mysql_qry = "SELECT * FROM `user_offline_payment` WHERE DATE = '$date' AND TYPE='Credit' AND BAL_TYPE='RCBAL' AND USER='$status' and USER_ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                      
                    $purchaseBalance = $purchaseBalance+(float)$row['AMOUNT'];
                    $offlineAddedMoney = $offlineAddedMoney + (float)$row['AMOUNT'];
                    

            }    
        }
        
        //USers offline Wallet Ends Credits
        
        
        //Users offline Wallet Starts Debit
         $mysql_qry = "SELECT * FROM `user_offline_payment` WHERE DATE = '$date' AND TYPE='Debit' AND BAL_TYPE='RCBAL' AND USER='$status' and USER_ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                                
                    $transferBalance= $transferBalance+(float)$row['AMOUNT'];
                    $offlineAddedMoney = $offlineAddedMoney - (float)$row['AMOUNT'];

            }    
        }
        
        //Users offline Wallet Ends Debit
        
        
    
                //Users online Wallet Starts Credits
        $mysql_qry = "SELECT * FROM `online_upi_wallet` WHERE DATE = '$date' AND STATUS='Success' AND BAL_TYPE='RCBAL' AND USER='$status' and USER_ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    $purchaseBalance = $purchaseBalance+(float)$row['AMOUNT'];
            }    
        }
        
        //Users online Wallet Ends Credits
        
        
        
        
        
        
        
        
        
        
                            if($status=="Api_users"){
                        $status="API_USER";
                    }
        
        
        
        
                        $comm = $con->query("select * from `comm_rpt` where TYPE='$status' and USER_ID='$id' and DATE='$date' and COMM_TYPE='Recharge'");
                while($cmm = $comm->fetch_assoc()){
                    $myCommissionsfirst = (float)$myCommissionsfirst+$cmm['AMOUNT'];
                }
        
                $comm = $con->query("select * from `comm_rpt` where TYPE='$status' and USER_ID='$id' and DATE='$date'");
                while($cmm = $comm->fetch_assoc()){
                    $myCommissions = (float)$myCommissions+$cmm['AMOUNT'];
                }
                
                
                // if($myname!="Api_users"){
                    
                // if($status!="admin"){
                //     include("myUsersCommBal.php");
                //     $commissionBalances = $myCommissions+$commissionBalances;
                    
                // }
                // if($status=="admin"){
                    
                //     include("myUsersCommBalForAdmin.php");
                //     $commissionBalances = $myCommissions+$commissionBalances;
                // }   
                    
                // }
                
                $openingBalance = $currentBalance-$purchaseBalance+$myRecharges-$myCommissions+$dailyDeductionMoney-$offlineAddedMoney;
                
        
        array_push($temp_array,array("openingBalance"=>$openingBalance,"closingBalance"=>$currentBalance,"Transfer"=>$transferBalance+$dailyDeductionMoney,"purchaseBalance"=>$purchaseBalance,"pendingBalance"=>$pendingBalance,"refundBalance"=>$refundBalance,"totalRechargeBalance"=>$totalRecharges,"commissionBalance"=>(float)$myCommissions,"myCommissionBalance"=>$myCommissionsfirst,"myRechargeBalance"=>$myRecharges));
        echo json_encode($temp_array);
            
            
        }
        
        
        
        
        
        
        
        ///With Filter Starts here
        
        
        
        
        
        
        
        
        
        else{
            
                 
        $date = date("Y-m-d");
        $temp_array = array();
        
        
        
        if($status=="admin"){
        
        //My All Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $myRecharges = $myRecharges + (float)$row['AMOUNT'];

            }    
        }
        //My All Recharges ends
        
        
        //AdminDailyDeduction Starts
        
        $mysql_qry = "SELECT * FROM `admin_deduction` DATE >= '$fromDate' and DATE <= '$toDate' and WHERE AND BAL_TYPE='RCBAL'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $dailyDeductionMoney = $dailyDeductionMoney + (float)$row['AMOUNT'];

            }    
        }
        
        //AdminDailyDeduction Ends
        
        
        
        //Admin offline Wallet Starts Credits
        
        $mysql_qry = "SELECT * FROM `admin_deduction` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and STATUS='Credit' AND BAL_TYPE='RCBAL'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                                            
                    $purchaseBalance = $purchaseBalance+(float)$row['AMOUNT'];
                    $offlineAddedMoney = $offlineAddedMoney + (float)$row['AMOUNT'];

            }    
        }
        
        //Admin offline Wallet Ends Credits
        
        
                //Admin offline Wallet Starts Debits
        
        $mysql_qry = "SELECT * FROM `admin_deduction` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and AND STATUS='Debit' AND BAL_TYPE='RCBAL'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $offlineAddedMoney = $offlineAddedMoney - (float)$row['AMOUNT'];

            }    
        }
        
        //Admin offline Wallet Ends Debits
        
        
        
        
        
        
        
        
                //Total All Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and STATUS = 'Success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    $totalRecharges = $totalRecharges + (float)$row['AMOUNT'];

            }    
        }
        //Total All Recharges ends
        
        

            
        }
        else{
            
        //My All Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    // $usedBalance = $usedBalance+(float)$row['AMOUNT']; 
                    $myRecharges = $myRecharges + (float)$row['AMOUNT'];

            }    
        }
        //My All Recharges ends
        
        
        //My Users Recharges
        
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and OWNER_ID = '$id' AND OWNER ='$status' and STATUS = 'Success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    $myUsersRecharge = $myUsersRecharge+(float)$row['AMOUNT'];

            }    
        }
        
        //My Users Recharges Ends
            
        
            $totalRecharges=$myUsersRecharge+$myRecharges;
            
        }
        
        
        
        
        
        //My All Pending Recharges Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS = 'Pending'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $pendingBalance = $pendingBalance + (float)$row['AMOUNT'];

            }    
        }
        //My All Pending Recharges ends
        
        
        
        
        
        //My All Refund Recharges Recharges Starts
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and PERSON_ID = '$id' AND PERSON ='$status' and STATUS ='Failed'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                        
                    $refundBalance = $refundBalance + (float)$row['AMOUNT'];

            }    
        }
        //My All Refund Recharges ends
        
        
        
        
        
        //Users offline Wallet Starts Credits
        $mysql_qry = "SELECT * FROM `user_offline_payment` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and TYPE='Credit' AND BAL_TYPE='RCBAL' AND USER='$status' and USER_ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                      
                    $purchaseBalance = $purchaseBalance+(float)$row['AMOUNT'];
                    $offlineAddedMoney = $offlineAddedMoney + (float)$row['AMOUNT'];
                    

            }    
        }
        
        //USers offline Wallet Ends Credits
        
        
        //Users offline Wallet Starts Debit
         $mysql_qry = "SELECT * FROM `user_offline_payment` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and TYPE='Debit' AND BAL_TYPE='RCBAL' AND USER='$status' and USER_ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                                
                    $transferBalance= $transferBalance+(float)$row['AMOUNT'];
                    $offlineAddedMoney = $offlineAddedMoney - (float)$row['AMOUNT'];

            }    
        }
        
        //Users offline Wallet Ends Debit
        
        
    
                //Users online Wallet Starts Credits
        $mysql_qry = "SELECT * FROM `online_upi_wallet` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and STATUS='Success' AND BAL_TYPE='RCBAL' AND USER='$status' and USER_ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                    while ($row  = mysqli_fetch_assoc($result)){
                    $purchaseBalance = $purchaseBalance+(float)$row['AMOUNT'];
            }    
        }
        
        //Users online Wallet Ends Credits
        
        
        
        
        
        
        
        
        
                    if($status=="Api_users"){
                        $status="API_USER";
                    }
        
        
        
        
        
                        $comm = $con->query("select * from `comm_rpt` where DATE >= '$fromDate' and DATE <= '$toDate' and TYPE='$status' and USER_ID='$id' and COMM_TYPE='Recharge'");
                while($cmm = $comm->fetch_assoc()){
                    $myCommissionsfirst = (float)$myCommissionsfirst+$cmm['AMOUNT'];
                }
        
                $comm = $con->query("select * from `comm_rpt` where DATE >= '$fromDate' and DATE <= '$toDate' and TYPE='$status' and USER_ID='$id'");
                while($cmm = $comm->fetch_assoc()){
                    $myCommissions = (float)$myCommissions+$cmm['AMOUNT'];
                }
                
                
                // if($myname!="Api_users"){
                    
                // if($status!="admin"){
                //     include("myUsersCommBal.php");
                //     $commissionBalances = $myCommissions+$commissionBalances;
                    
                // }
                // if($status=="admin"){         
                    
                //     include("myUsersCommBalForAdmin.php");
                //     $commissionBalances = $myCommissions+$commissionBalances;
                // }   
                    
                // }
                
                // $openingBalance = $currentBalance-$purchaseBalance+$myRecharges-$myCommissions+$dailyDeductionMoney-$offlineAddedMoney;
                
        
        array_push($temp_array,array("openingBalance"=>$openingBalance,"closingBalance"=>"0","Transfer"=>$transferBalance+$dailyDeductionMoney,"purchaseBalance"=>$purchaseBalance,"pendingBalance"=>$pendingBalance,"refundBalance"=>$refundBalance,"totalRechargeBalance"=>$totalRecharges,"commissionBalance"=>(float)$myCommissions,"myCommissionBalance"=>$myCommissionsfirst,"myRechargeBalance"=>$myRecharges));
        echo json_encode($temp_array);
            
            
        }
        
        
        
        
        

    
?>