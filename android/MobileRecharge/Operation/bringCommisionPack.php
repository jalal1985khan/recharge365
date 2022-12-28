<?php

    include("config.php");
    
    $id = $_POST['id'];
    $table = $_POST['table'];
    $place = $_POST['place'];
    
    
    // $id = "4";
    // $table = "masterdistributer";
    // $place = "DTH";
     $temp_array = array();    
     $q = $con->query("select * from `$table` where ID='$id'")->fetch_assoc();
            $cm = $q['COMM_PACK'];
            // echo $cm;
            $data = $con->query("select * from switchOperator where SERVICETYPE='$place'");
            while($row = $data->fetch_assoc()){
                $comm_op = $con->query("select * from operator_comm where OP_NAME='".$row['PRODUCTNAME']."' and PACKAGE_ID='".$cm."'")->fetch_assoc();
                // print_r($comm_op);
                array_push($temp_array,array("OP_NAME"=>$comm_op['OP_NAME'],"PERCENTAGE"=>$comm_op['PERCENTAGE']));
            }
            
            echo json_encode($temp_array);

?>
