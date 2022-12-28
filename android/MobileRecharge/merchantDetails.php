<?php

include("config.php");

   $mysql_qry = "SELECT * FROM `payment_gateway`";
    $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result))
            {
                array_push($temp_array,array("merchantname"=>$row["MERCHANTNAME"],"image"=>$row["LOGO"],"description"=>$row["DESCRIPTION"],"keyid"=>$row["KEYID"],"keysecret"=>$row["KEYSECRET"]));
            }    
                echo json_encode($temp_array);        
            
        }

?>