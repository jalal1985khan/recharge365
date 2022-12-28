<?php

    include("config.php");
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $id  =$_POST['id'];
    $status = $_POST['myType'];
    $pass = md5($password);

        
                        $mysql_qry = "SELECT * FROM `commPackage` WHERE OWNER='".$status."' AND OWNER_ID='".$id."' AND STATUS='"."ACTIVATE"."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
               
                array_push($temp_array,array("id"=>$row["ID"],"owner"=>$row["OWNER"],"ownerId"=>$row["OWNER_ID"],"name"=>$row["PACKNAME"],"userType"=>$row["USERTYPE"],"status"=>$row["STATUS"]));
            }    
                echo json_encode($temp_array);        
            
                }
                
                else{
                    
                    echo "No Records";
                        
                }







?>