<?php

    include("../../includes/config.php");
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $table = $_POST['table'];
    $id = $_POST['id'];
    $success = 0;
    $pending = 0;
    $failed = 0;
    
    $tableCaps = strtoupper($table);
    
                
                $temp_array = array();
                $data = $con->query("SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON = '$tableCaps' AND STATUS = 'success' AND DATE = '$date'");
                while($row = $data->fetch_assoc())
                {
                        $success = $success+(int)$row['AMOUNT'];
 
                }
                
                
                
                
                
                $data = $con->query("SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON = '$tableCaps' AND STATUS = 'pending' AND DATE = '$date'");
                while($row = $data->fetch_assoc())
                {
                        $pending = $pending+(int)$row['AMOUNT'];
                }
                
                
                
                
                $data = $con->query("SELECT * FROM `recharge_history` WHERE PERSON_ID = '$id' AND PERSON = '$tableCaps' AND STATUS = 'Failed' AND DATE = '$date'");
                while($row = $data->fetch_assoc())
                {
                        $failed = $failed+(int)$row['AMOUNT'];

                }
                
                
                
                
                
                
                array_push($temp_array,array("Success"=>$success, "Pending"=>$pending, "Failed"=>$failed));
                
                echo json_encode($temp_array);
 
 


?>