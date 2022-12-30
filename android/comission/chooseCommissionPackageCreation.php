<?php

    include("../../includes/config.php");
    $id  =$_POST['id'];
    $status = $_POST['status'];
    $usertype = $_POST['userType'];
    
    if($usertype=="masterdistributor"){
       $usertype="masterdistributer";
    }
    else if($usertype=="distributor"){
       $usertype="distributer";
    }

        
                        $mysql_qry = "SELECT * FROM `commPackage` where OWNER_ID='$id' and OWNER='$status' and USERTYPE='$usertype' and STATUS='activate'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
               
                // array_push($temp_array,array("id"=>$row["ID"],"owner"=>$row["OWNER"],"ownerId"=>$row["OWNER_ID"],"name"=>$row["PACKNAME"],"userType"=>$row["USERTYPE"],"status"=>$row["STATUS"]));
                array_push($temp_array,array("name"=>$row["PACKNAME"],"id"=>$row["ID"]));
            }    
                echo json_encode($temp_array);        
            
                }else{
                    echo "No Packages found";
                }
                
?>