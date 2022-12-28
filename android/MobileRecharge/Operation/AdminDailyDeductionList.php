<?php

    include("config.php");

     $mobile = $_POST['MOBILE'];
     $password = $_POST['PASSWORD'];
     $fromDate = $_POST['fromDate'];
     $toDate = $_POST['toDate'];
            $date=date("Y-m-d");
                    $temp_array = array();
    $password_sec = md5($password);

        if($fromDate=="" && $toDate==""){
            
                            $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
            
            
                    $mysql_qry = "SELECT * FROM `admin_deduction` WHERE DATE='$date' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){

                        array_push($temp_array,array("amount"=>$row['AMOUNT'],"user"=>$row['USER'],"userMobile"=>$row['USER_MOBILE'],"userOldBal"=>$row['USER_OLD_BAL'],"userNewBal"=>$row['USER_NEW_BAL'],"myOldBal"=>$row['MY_OLD_BAL'],"myNewBal"=>$row['MY_NEW_BAL'],"DATE"=>$row['DATE'],"TIME"=>$row['TIME'],"BalType"=>$row['BAL_TYPE'],"TRANS_ID"=>$row['TRANS_ID'],"STATUS"=>"Success"));
                        
                    }
        }
        
                        if(empty($temp_array)) {
             echo "No Records";    
        }
        else{
            echo json_encode($temp_array);
            
        } 
                 
            
        }
            
        }
        
        else if($fromDate!="" && $toDate!=""){
            
                                        $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
            
                    $mysql_qry = "SELECT * FROM `admin_deduction` where DATE >= '$fromDate' and DATE <= '$toDate' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
array_push($temp_array,array("amount"=>$row['AMOUNT'],"user"=>$row['USER'],"userMobile"=>$row['USER_MOBILE'],"userOldBal"=>$row['USER_OLD_BAL'],"userNewBal"=>$row['USER_NEW_BAL'],"myOldBal"=>$row['MY_OLD_BAL'],"myNewBal"=>$row['MY_NEW_BAL'],"DATE"=>$row['DATE'],"TIME"=>$row['TIME'],"BalType"=>$row['BAL_TYPE'],"TRANS_ID"=>$row['TRANS_ID'],"STATUS"=>"Success"));
                                                
                    }
        }
                 
            
        }
                            if(empty($temp_array)) {
             echo "No Records";    
        }
        else{
            echo json_encode($temp_array);
            
        } 
            
        }

    




?>