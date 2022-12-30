<?php
 
include('../../includes/config.php');
 
        $mysql_qry = "SELECT * FROM `customer_supports`";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
          while ($row = mysqli_fetch_assoc($result)){
                array_push($temp_array,array("id"=>$row["ID"],"name"=>$row["NAME"],"whatsapp"=>$row["WHATSAPP"],"whatsapptime"=>$row["WHATSAPP_TIME"],"mobile"=>$row["MOBILE"],"calltime"=>$row["CALL_TIME"],"position"=>$row['POSTION']));
                }    
                echo json_encode($temp_array);        
                }
                else{
                 echo "No records found";
                    
                }
 
 
 
 
 
 
 
 
?>