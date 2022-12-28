<?php
 
 require_once('config.php');
     $table = $_POST['status'];
     $id = $_POST['id'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    
    
    
        // $mysql_qry = "SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id'";
        
        $mysql_qry = "select * from `recharge_history` where DATE >= '$fromDate' and DATE <= '$toDate' and PERSON ='$table' and PERSON_ID = '$id' ORDER BY ID DESC";
        
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                                $op_name = $row['OP'];
                                $op_row = $con->query("select * from switchOperator where PRODUCTNAME='$op_name'")->fetch_assoc();
                                $op_logo = $op_row['LOGO'];
                                $imagepath = "https://www.recharges365.com/recharge/images/".$op_logo;
                array_push($temp_array,array("Amount"=>$row['AMOUNT'],"Number"=>$row['NUMBER'],"OperatorID"=>$row['OPERATOR_ID'],"Status"=>$row['STATUS'],"TXNID"=>$row['TRANS_ID'],"Time"=>$row['TIME'],"Logo"=>($imagepath),"Date"=>$row['DATE']));
            }    
                echo json_encode($temp_array);        
            
        }
        else{
            echo "No Data";
        }
                
?>