<?php

    include("../../includes/config.php");
    $mobile = $_POST['MOBILE'];
     $password = $_POST['PASSWORD'];
     $fromDate = $_POST['fromDate'];
     $toDate = $_POST['toDate'];
    $date=date("Y-m-d");
    $password_sec = md5($password);

        if($fromDate=="" && $toDate==""){
            
                            $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0){
            
            
                    $mysql_qry = "SELECT * FROM `admin_offline_wallet` WHERE DATE='$date' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        array_push($temp_array,array("Amount"=>$row["AMOUNT"],"STATUS"=>$row['STATUS'],"BEFORE_BAL"=>$row['BEFORE_BAL'],"AFTER_BAL"=>$row['AFTER_BAL'],"DATE"=>$row['DATE'],"BAL_TYPE"=>$row['BAL_TYPE']));
                        
                    }
        }
                 
            
        }
            
        }
        
        else{
            
                                        $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0){
            
            
                    $mysql_qry = "SELECT * FROM `admin_offline_wallet` where DATE >= '$fromDate' and DATE <= '$toDate' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        array_push($temp_array,array("Amount"=>$row["AMOUNT"],"STATUS"=>$row['STATUS'],"BEFORE_BAL"=>$row['BEFORE_BAL'],"AFTER_BAL"=>$row['AFTER_BAL'],"DATE"=>$row['DATE'],"BAL_TYPE"=>$row['BAL_TYPE']));
                        
                    }
        }
                 
            
        }
            
            
        }

    

                if(empty($temp_array)) {
             echo "No Records";    
        }
        else{
            echo json_encode($temp_array);
            
        } 



?>