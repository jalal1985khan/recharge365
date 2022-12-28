<?php
 
 require_once('config.php');

 
   $mysql_qry = "SELECT * FROM `serviceManager`";
    $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result))
            {
                array_push($temp_array,array("ID"=>$row["ID"],"SERVICENAME"=>$row["SERVICENAME"],"STATUS"=>$row["STATUS"]));
            }    
                echo json_encode($temp_array);        
            
        }
        else{
                            echo json_encode("No Service Manager");        

        }

?>