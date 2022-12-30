<?php
include("../../includes/config.php");
$id = $_POST['id'];
$name = $_POST['name'];
$value = $_POST['value'];
$details = $con->query("select * from operator_comm WHERE ID = '$id' AND OP_NAME = '$name'")->fetch_assoc();
$old_value = $details['PERCENTAGE'];
    if($old_value==$value){
        echo "Success";   
    }
    else{
          mysqli_query($con,"UPDATE `operator_comm` SET `PERCENTAGE`='$value' WHERE ID = '$id' AND OP_NAME = '$name'"); 
            if(mysqli_affected_rows($con)>0){
                echo "Success";
            }
            else{
                echo "Failed";
            }   
    }

?>