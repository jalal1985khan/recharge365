<?php
    
    include("config.php");
    
        // $status = $_POST['status'];
        // $id = $_POST['id'];
        
        $status = 'admin';
        $id ="1";

        $date=date("Y-m-d");
        $temp_array = array();
        $mysql_qry2 = "SELECT * FROM `amount_req` where USER = '$status' and USER_ID = '$id' and date ='$date'";
        $result2 = mysqli_query($con, $mysql_qry2);
        $numbers_of_rows = mysqli_num_rows($result2);
        if($numbers_of_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        
                array_push($temp_array,array("amount"=>$row2['AMOUNT'],"txnid"=>$row2['TRANS_ID'],"beforeamount"=>$row2['BEFORE_REQ'],"datetime"=>$row2['DATE']." / ".$row2['TIME'],"from"=>$row2['PAYMENT_MODE'],"sataus"=>$row2['STATUS'],"avalamount"=>$row2['AFTER_REQ'],"type"=>$row2['TYPE'],"baltype"=>"RCBAL"));
            }
        }
        
        $mysql_qry2 = "SELECT * FROM `online_recharge` where USER = '$status' and USER_ID = '$id' and date ='$date'";
        $result2 = mysqli_query($con, $mysql_qry2);
        $numbers_of_rows = mysqli_num_rows($result2);
        if($numbers_of_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        
                array_push($temp_array,array("amount"=>$row2['AMOUNT'],"txnid"=>$row2['TRANS_ID'],"beforeamount"=>$row2['BEFORE_REQ'],"datetime"=>$row2['DATE']." / ".$row2['TIME'],"from"=>$row2['PAYMENT_MODE'],"sataus"=>$row2['STATUS'],"avalamount"=>$row2['AFTER_REQ'],"type"=>$row2['TYPE'],"baltype"=>"RCBAL"));
            }
        }
        
        
        echo json_encode($temp_array);








?>