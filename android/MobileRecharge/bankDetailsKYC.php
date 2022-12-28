<?php

    include("config.php");
    
    $mobile = $_POST['mobile'];
    
    
        $mysql_qry = "SELECT * FROM `mykyc` WHERE USER_MOBILE='$mobile' AND STATUS = 'SUCCESS'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                array_push($temp_array,array("bankname"=>$row["BANKNAME"],"acname"=>$row["ACNAME"],"acnumber"=>$row["ACNUMBER"],"ifsc"=>$row["IFSCCODE"]));
            }    
                echo json_encode($temp_array);        
            
            }
            else {
                
                
                echo "No records";
            }
    





?>