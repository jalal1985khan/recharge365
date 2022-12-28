<?php
 
 require_once('dbConnect.php');
 
    $status = $_POST['status'];
    

    

    $mysql_qry = "SELECT ALERT FROM `news_alert` WHERE TYPE='$status'";
    $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result))
            {
                array_push($temp_array,array("News"=>$row["ALERT"]));
            }    
                echo json_encode($temp_array);        
            
        }
        else{
                            echo json_encode("NO NEWS.");        

        }

?>