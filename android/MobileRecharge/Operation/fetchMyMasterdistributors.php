<?php

     require_once('config.php');
 
        $id = $_POST['id'];
        $OWNER = $_POST['status'];
        
    

      
        $mysql_qry = "SELECT * FROM `masterdistributer` WHERE ADMIN_ID='".$id."' AND OWNER='".$OWNER."' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                array_push($temp_array,array("Id"=>$row["ID"],"Name"=>$row["NAME"],"Image"=>$row["IMAGE"],"Owner"=>$row["OWNER"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"masterdistributer"));
            }    
                echo json_encode($temp_array);        
            
            }
                        else{
                echo "No Data";
            }

?>