<?php
include("../../includes/config.php");
$pak_id = $_POST['id'];
$temp_array = array();
$res = $con->query("SELECT * FROM operator_comm WHERE PACKAGE_ID='$pak_id' order by ID asc");
    if($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
        array_push($temp_array,array("name"=>$row['OP_NAME'],"id"=>$row['ID'],"value"=>$row['PERCENTAGE']));
                                        
            }
            
              echo json_encode($temp_array);
        }
    else {
        echo "No Record";
    }
        

?>