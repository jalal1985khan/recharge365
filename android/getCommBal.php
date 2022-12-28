<?php
 
 require_once('dbConnect.php');
 
    $date = date("Y-m-d");
 
     $status = $_POST['status'];
    $id = $_POST['id'];
    $status2 = strtoupper($status);
    
    // $status = "RETAILER";
    // $id = "11";
                
                if($status2=="API_USERS"){
                    $status2=="API_USER";
                }

    
              $comm = $con->query("select * from comm_rpt where TYPE='$status' and USER_ID='$id' and DATE='$date'");
                while($cmm = $comm->fetch_assoc()){
                    $comm_amount += $cmm['AMOUNT'];
                }
                
                
                echo json_encode($comm_amount);

?>