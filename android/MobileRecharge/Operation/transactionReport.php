<?php
 
 require_once('config.php');

     
     $id = $_POST['id'];
     $table = $_POST['table'];
     
        $name = $table;
        
        
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    // $time = date("g:i:s A");
     $myTable = strtoupper($table);
     
     
                            
                            $searchnum = $con->query("SELECT * FROM `$table` WHERE ID = '$id'")->fetch_assoc();
                            $usernum = $searchnum['MOBILE'];
                        
                    
            $temp_array = array();
            if($table=="Api_users"){
            $table="API_USER";
        }
            
            
                    $mysql_qry = "SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON ='$table' AND DATE='$date'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                array_push($temp_array,array("Amount"=>$row['AMOUNT'],"Number"=>$row['NUMBER'],"OperatorID"=>$row['OPERATOR_ID'],"Status"=>$row['STATUS'],"TXNID"=>$row['TRANS_ID'],"Time"=>$row['TIME'],"Date"=>$row['DATE'],"TranType"=>$row['TRANS_TYPE'],"fee"=>"0%","Method"=>"Recharge","AvalAmount"=>""));
            }    
        }
            
                    if($table=="API_USER"){
            $table="API_USERS";
        }
        
                $mysql_qry2 = "SELECT * FROM `amount_req` WHERE USER = '$table' AND USER_ID = '$id' AND DATE='$date'";
        $result2 = mysqli_query($con, $mysql_qry2);
        $numbers_of_rows = mysqli_num_rows($result2);
        if($numbers_of_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        
                    
                array_push($temp_array,array("Amount"=>$row2['AMOUNT'],"Number"=>$usernum,"OperatorID"=>$row2['OPERATOR_ID'],"Status"=>$row2['STATUS'],"TXNID"=>$row2['TRANS_ID'],"Time"=>$row2['TIME'],"Date"=>$row2['DATE'],"TranType"=>$row2['TYPE'],"fee"=>$row2['FEE'],"Method"=>$row2['PAYMENT_MODE'],"AvalAmount"=>$row2['AFTER_REQ']));
            }    
                    
            
        }
        
            if($table=="API_USERS"){
            $table="API_USER";
        }
        
                        $mysql_qry3 = "SELECT * FROM `online_recharge` WHERE USER = '$table' AND USER_ID = '$id' AND DATE='$date'";
        $result3 = mysqli_query($con, $mysql_qry3);
        $numbers_of_rows = mysqli_num_rows($result3);
        if($numbers_of_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($result3)){
                        
                    
                array_push($temp_array,array("Amount"=>$row2['AMOUNT'],"Number"=>$usernum,"OperatorID"=>$row2['OPERATOR_ID'],"Status"=>$row2['STATUS'],"TXNID"=>$row2['ORDER_ID'],"Time"=>"","Date"=>$row2['DATE'],"TranType"=>"DEBIT","fee"=>"0%","Method"=>"UPI WALLET","AvalAmount"=>$row2['AFTER_BAL']));
            
                                        //array_push($temp_array,array("Amount"=>$row2['AMOUNT'],"Status"=>$row2['STATUS'],"ORDER_ID"=>$row2['TRANS_ID'],"Time"=>$row2['TIME'],"Date"=>$row2['DATE'],"TranType"=>"UPI WALLET","Method"=>"UPI","AvalAmount"=>$row2['AFTER_BAL']));
                    }    
                    
            
        }
        
        
        
        
    
        
        if(empty($temp_array)) {
             echo "No Data";    
        }
        else{
            echo json_encode($temp_array);
            
        }
        
        
                
?>