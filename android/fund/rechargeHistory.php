<?php
 
    include("../../includes/config.php");
     $table = $_POST['status'];
     $id = $_POST['id'];
     
        
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    
        $mysql_qry = "SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' and PERSON ='$table' AND DATE='$date' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                                $op_name = $row['OP'];
                                $op_row = $con->query("select * from switchOperator where PRODUCTNAME='$op_name'")->fetch_assoc();
                                $op_logo = $op_row['LOGO'];
                                $imagepath = "https://rch.hassantravels.in/images/".$op_logo;
                array_push($temp_array,array("Amount"=>$row['AMOUNT'],"Number"=>$row['NUMBER'],"OperatorID"=>$row['OPERATOR_ID'],"Status"=>$row['STATUS'],"TXNID"=>$row['TRANS_ID'],"Time"=>$row['TIME'],"Logo"=>($imagepath),"Date"=>$row['DATE']));
            }    
                echo json_encode($temp_array);        
            
        }
        else{
            
            echo "No Data";
        }
                
?>