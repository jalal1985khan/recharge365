<?php

    include("../../includes/config.php");
$imgPath ="https://rch.hassantravels.in/images/";
$mysql_qry = "SELECT * FROM `toll_free`";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        array_push($temp_array,array("operator"=>$imgPath.$row["OPERATOR_IMG"],"name"=>$row["NAME"],"number"=>$row["NUMBER"]));
            }    
                echo json_encode($temp_array);        
            
            }
            else {
                
                
                echo "No records";
            }





?>


