<?php

    include("config.php");
    $id = $_POST['id'];
    $status =$_POST['status'];
 
    
                    $mysql_qry = "SELECT * FROM `bc_users` WHERE US_TYPE='$status' AND US_ID='$id' AND msg='Success'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0)
            {
                    while ($row = mysqli_fetch_assoc($result)){
                array_push($temp_array,array("email"=>$row["email"],"mobile"=>$row["num"],"bcid"=>$row["BC_ID"]));
            }    
                echo json_encode($temp_array);        
            
                }
                
                else{
                    
                        echo "No Record";
                    
                }
    



?>