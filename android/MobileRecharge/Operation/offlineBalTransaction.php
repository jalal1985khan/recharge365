<?php
    
    include("config.php");
    
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    
    
    
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $owner= $_POST['owner'];
    $owner = $_POST['ownerId'];
    
    $date=date("Y-m-d");
    
            date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    
    
     $temp_array = array();
    if($fromDate!="" && $toDate!=""){
        
        
         $mysql_qry = "SELECT * FROM `user_offline_payment` WHERE DATE >= '$fromDate' AND DATE <= '$toDate' AND USER_ID='$id' AND USER='$status' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        $person = $row['PASSED_PERSON'];
                        $personnum = $row['PASSED_NUMBER'];
                        $userinfo = $con->query("select * from `$person` where MOBILE = '$personnum'")->fetch_assoc();
                        if($person == "retailer"){
                             $showname = $userinfo['FNAME'];     
                        }
                        else{
                         $showname = $userinfo['NAME'];   
                        }

                        array_push($temp_array,array("AMOUNT"=>$row['AMOUNT'],"USERTYPE"=>$row['USER'],"USER_ID"=>$row['USER_ID'],"TRANS_ID"=>$row['TRANS_ID'],"BEFORE_BAL"=>$row['BEFORE_BAL'],"AFTER_BAL"=>$row['AFTER_BAL'],"BAL_TYPE"=>$row['BAL_TYPE'],"DATE"=>$row['DATE'],"TIME"=>$row['TIME'],"STATUS"=>$row['TYPE'],"PASSED_PERSON"=>$row['PASSED_PERSON'],"PASSED_NUMBER"=>$showname));
                        
                    }
        }
        
    }
    else{
        
                            $mysql_qry = "SELECT * FROM `user_offline_payment` WHERE USER_ID='$id' AND USER='$status' AND DATE='$date' ORDER BY ID DESC";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        
                        $person = $row['PASSED_PERSON'];
                        $personnum = $row['PASSED_NUMBER'];
                        $userinfo = $con->query("select * from `$person` where MOBILE = '$personnum'")->fetch_assoc();
                        if($person == "retailer"){
                             $showname = $userinfo['FNAME'];     
                        }
                        else{
                         $showname = $userinfo['NAME'];   
                        }

                        array_push($temp_array,array("AMOUNT"=>$row['AMOUNT'],"USERTYPE"=>$row['USER'],"USER_ID"=>$row['USER_ID'],"TRANS_ID"=>$row['TRANS_ID'],"BEFORE_BAL"=>$row['BEFORE_BAL'],"AFTER_BAL"=>$row['AFTER_BAL'],"BAL_TYPE"=>$row['BAL_TYPE'],"DATE"=>$row['DATE'],"TIME"=>$row['TIME'],"STATUS"=>$row['TYPE'],"PASSED_PERSON"=>$row['PASSED_PERSON'],"PASSED_NUMBER"=>$showname));
                        
                    }
        }
        
    }
    
                if(empty($temp_array)) {
             echo "No Records";    
        }
        else{
            echo json_encode($temp_array);
            
        }




?>