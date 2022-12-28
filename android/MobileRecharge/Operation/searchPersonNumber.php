<?php

         require_once('config.php');
 
        $id = $_POST['id'];
        $status = $_POST['status'];
        $number = $_POST['number'];
        $you = $_POST['yours'];

            if($status=="admin" && $you=="Api_users"){
             
                     $mysql_qry = "SELECT * FROM `Api_users` where MOBILE='$number'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $im = "https://www.recharges365.com/dashboard/apiuser/img/";
                array_push($temp_array,array("Id"=>$row["ID"],"Name"=>$row["NAME"],"Image"=>$im.$row["IMAGE"],"Owner"=>$row["OWNER"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"Api_users"));
            }    
                echo json_encode($temp_array);        
            
            }

        else{
                
                echo "No Data";
            
            }   
                
    }
            
            else if($you=="masterdistributer"){
                
                        $mysql_qry = "SELECT * FROM `masterdistributer` WHERE ADMIN_ID='".$id."' AND OWNER='".$status."' AND MOBILE='".$number."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $im = "https://www.recharges365.com/dashboard/masterdistributer/img/";
                array_push($temp_array,array("Id"=>$row["ID"],"Name"=>$row["NAME"],"Image"=>$im.$row["IMAGE"],"Owner"=>$row["OWNER"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"masterdistributer"));
            }    
                echo json_encode($temp_array);        
            
            }
                        else{
                echo "No Data";
            }
                
            }

            else if($you=="distributer"){
                        $mysql_qry = "SELECT * FROM `distributer` WHERE MS_ID='".$id."' AND OWNER='".$status."' AND MOBILE='".$number."' ";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $im = "https://www.recharges365.com/dashboard/distributer/img/";
                array_push($temp_array,array("Id"=>$row["ID"],"Name"=>$row["NAME"],"Image"=>$im.$row["IMAGE"],"Owner"=>$row["OWNER"],"MS_ID"=>$row["MS_ID"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"distributer"));
            }    
                echo json_encode($temp_array);        
            
            }
            
            else{
                echo "No Data";
            }
            }

            else if($you=="retailer"){
                            if($status!="distributer"){
                                $mysql_qry = "SELECT * FROM `retailer` WHERE MS_ID='".$id."' AND OWNER='".$status."' AND MOBILE='".$number."'";
                                
                                        $result = mysqli_query($con, $mysql_qry);
                                        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $im = "https://www.recharges365.com/dashboard/retailer/img/";
                array_push($temp_array,array("Id"=>$row["ID"],"Name"=>$row["FNAME"],"Image"=>$im.$row["IMAGE"],"Owner"=>$row["OWNER"],"MS_ID"=>$row["MS_ID"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"retailer"));
            }    
                echo json_encode($temp_array);        
            
            }
                        else{
                echo "No Data";
            }
                                
                                
                            }
                            else{
                                  $mysql_qry = "SELECT * FROM `retailer` WHERE DISTRIBUTER='".$id."' AND OWNER='".$status."' AND MOBILE='".$number."'";
                                          $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                         $im = "https://www.recharges365.com/dashboard/retailer/img/";
                array_push($temp_array,array("Id"=>$row["ID"],"Name"=>$row["FNAME"],"Image"=>$im.$row["IMAGE"],"Owner"=>$row["OWNER"],"MS_ID"=>$row["DISTRIBUTER"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"retailer"));
            }    
                echo json_encode($temp_array);        
            
            }
        else{
                echo "No Data";
            }
        }
            
                    
    }
    else{
                        echo "No Data";
    }
            
            
?>