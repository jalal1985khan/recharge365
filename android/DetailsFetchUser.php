<?php
 
 require_once('dbConnect.php');
 


     $mobile = $_POST['MOBILE'];
     $password = $_POST['PASSWORD'];
     
    
    
    
    $password_sec = md5($password);

    
                $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $imgpath = "https://www.recharges365.com/dashboard/admin/img/";
                array_push($temp_array,array("Name"=>$row["NAME"],"Image"=>$imgpath.$row["IMAGE"],"Owner"=>"Admin","OwnerId"=>"1","ID"=>$row["ID"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"admin","ImagePath"=>$imgpath));
            }    
                echo json_encode($temp_array);        
            
                }
                
                else{
        
        
        
    

       
       
        $mysql_qry = "SELECT * FROM `retailer` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        $imgpath = "https://www.recharges365.com/dashboard/retailer/img/";
                        
                        $Myowner = $row["OWNER"];
                            if($Myowner=="DISTRIBUTER"){
                                $ownerID = $row["DISTRIBUTER"];
                            }
                            else{
                                $ownerID = $row["MS_ID"];
                            }
                        
                array_push($temp_array,array("Name"=>$row["FNAME"],"Image"=>$imgpath.$row["IMAGE"],"Owner"=>$row["OWNER"],"OwnerId"=>$ownerID,"ID"=>$row["ID"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"retailer","ImagePath"=>$imgpath));
            }    
                echo json_encode($temp_array);        
            
                }
            else {
                            $mysql_qry = "SELECT * FROM `masterdistributer` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $imgpath = "https://www.recharges365.com/dashboard/masterdistributer/img/";
                array_push($temp_array,array("Name"=>$row["NAME"],"Image"=>$imgpath.$row["IMAGE"],"Owner"=>$row["OWNER"],"OwnerId"=>$row["ADMIN_ID"],"ID"=>$row["ID"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"masterdistributer","ImagePath"=>$imgpath));
            }    
                echo json_encode($temp_array); 
                        
            
                }
            else {
                            $mysql_qry = "select * FROM distributer WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $imgpath = "https://www.recharges365.com/dashboard/distributer/img/";
                array_push($temp_array,array("Name"=>$row["NAME"],"Image"=>$imgpath.$row["IMAGE"],"Owner"=>$row["OWNER"],"OwnerId"=>$row["MS_ID"],"ID"=>$row["ID"],"Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"APIACCESS"=>$row["APIACCESS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"distributer","ImagePath"=>$imgpath));
            }    
                echo json_encode($temp_array); 
                        
            
                }
            else {
                            $mysql_qry = "select * FROM Api_users WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $imgpath = "https://www.recharges365.com/dashboard/apiuser/img/";
                        
                array_push($temp_array,array("Name"=>$row["NAME"],"Image"=>$imgpath.$row["IMAGE"],"ID"=>$row["ID"],"Owner"=>"admin","OwnerId"=>"1","Mobile"=>$row["MOBILE"],"RCBAL"=>$row["RCBAL"],"DMRBAL"=>$row["DMRBAL"],"SMSBAL"=>$row["SMSBAL"],"COMM_PACK"=>$row["COMM_PACK"],"Status"=>$row["STATUS"],"Email"=>$row["EMAIL"],"City"=>$row["CITY"],"Address"=>$row["ADDRESS"],"State"=>$row["STATE"],"Type"=>"Api_users","ImagePath"=>$imgpath,"APIACCESS"=>$row["APIACCESS"],"CUTTOFFAMOUNT"=>$row["CUTTOFFAMOUNT"]));
            }    
                echo json_encode($temp_array); 
                        
            
                }
            else {
                    echo "1";
                }
            }
        }
    }    
    
                }


?>