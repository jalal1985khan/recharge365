<?php

    include("../../includes/config.php");
    $id = $_POST['id'];
    $status = $_POST['status'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $temp_array = array();   
    if($status=="Api_users"){
        $status="API_USER";
    }
    
       $date = date("Y-m-d");
    
    if($fromDate!="" && $toDate!=""){
        
                                $mysql_qry = "SELECT * FROM `comm_rpt` WHERE DATE >= '$fromDate' and DATE <= '$toDate' and TYPE ='$status' and USER_ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                 
                            array_push($temp_array,array("sl"=>$row['ID'],"credit"=>$row['AMOUNT'],"debit"=>$row['DEBIT_AMOUNT'],"bal"=>$row['CURRENT_BAL'],"type"=>$row['COMM_TYPE'],"date"=>$row['DATE'],"time"=>$row['TIME']));
            
                        
                    }    
            
                }
        
        
    }
    else{
        
                        $mysql_qry = "SELECT * FROM `comm_rpt` WHERE TYPE ='$status' and USER_ID='$id' and DATE='$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                      
                            array_push($temp_array,array("sl"=>$row['ID'],"credit"=>$row['AMOUNT'],"debit"=>$row['DEBIT_AMOUNT'],"bal"=>$row['CURRENT_BAL'],"type"=>$row['COMM_TYPE'],"date"=>$row['DATE'],"time"=>$row['TIME']));
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