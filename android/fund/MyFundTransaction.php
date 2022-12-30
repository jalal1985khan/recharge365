<?php

        $date=date("Y-m-d");
        $temp_array = array();
    include("../../includes/config.php");
    
        $id = $_POST['id'];
        $status = $_POST['status'];
        
        $fromDate= $_POST['fromDate'];
        $toDate= $_POST['toDate'];
        
        if($fromDate=="" && $toDate==""){
            

    
                        $mysql_qry2 = "SELECT * FROM `online_recharge` where USER = '$status' and USER_ID = '$id' and date ='$date'";
        $result2 = mysqli_query($con, $mysql_qry2);
        $numbers_of_rows = mysqli_num_rows($result2);
        if($numbers_of_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        
                array_push($temp_array,array("amount"=>$row2['AMOUNT'],"txnid"=>$row2['ORDER_ID'],"beforeamount"=>$row2['BEFORE_BAL'],"datetime"=>$row2['DATE']." ".$row2['TIME'],"from"=>"From : upi","status"=>$row2['STATUS'],"avalamount"=>$row2['AFTER_BAL'],"type"=>"Credit to ","baltype"=>$row2['BAL_TYPE']));
            }
        }
        
                    
               
            
        }
        else{
            

            
        $mysql_qry2 = "SELECT * FROM `online_recharge` where DATE >= '$fromDate' and DATE <= '$toDate' and USER = '$status' and USER_ID = '$id'";
        $result2 = mysqli_query($con, $mysql_qry2);
        $numbers_of_rows = mysqli_num_rows($result2);
        if($numbers_of_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        
                array_push($temp_array,array("amount"=>$row2['AMOUNT'],"txnid"=>$row2['ORDER_ID'],"beforeamount"=>$row2['BEFORE_BAL'],"datetime"=>$row2['DATE']." ".$row2['TIME'],"from"=>"From : upi","status"=>$row2['STATUS'],"avalamount"=>$row2['AFTER_BAL'],"type"=>"Credit to ","baltype"=>$row2['BAL_TYPE']));
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