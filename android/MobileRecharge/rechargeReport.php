<?php

include("config.php");
    // $status = $_POST['status'];
    // $id = $_POST['id'];
    
        $status = "masterdistributer";
        $id = "4";
        $owner = "ADMIN";
        $ownerID = "1"; 
        
    
    $temp_array = array();

//   $mysql_qry = "SELECT * FROM `payment_gateway`";
//     $result = mysqli_query($con, $mysql_qry);
//         $numbers_of_rows = mysqli_num_rows($result);
//         $temp_array = array();
//         if($numbers_of_rows > 0) {
//                     while ($row = mysqli_fetch_assoc($result))
//             {
//                 array_push($temp_array,array("merchantname"=>$row["MERCHANTNAME"],"image"=>$row["LOGO"],"description"=>$row["DESCRIPTION"],"keyid"=>$row["KEYID"],"keysecret"=>$row["KEYSECRET"]));
//             }    
//                 echo json_encode($temp_array);        
            
//         }

                                    $date = date("Y-m-d");
                                    $rt_sc = $con->query("SELECT * FROM recharge_history where DATE='$date' and  (STATUS='Success' OR STATUS=' Sucess ') and 
                                    OWNER='$owner' and OWNER_ID='$$ownerID'");
                                    $rt_sc_row = $rt_sc->num_rows;
                                    while($row1 = $rt_sc->fetch_assoc()){
                                        $rt_sc_am += $row1['AMOUNT'];
                                    }
                                    array_push($temp_array,array("Success"=>$rt_sc_am));
                                    
                                    $ds_sc = $con->query("SELECT * FROM recharge_history where DATE='$date' and  (STATUS='Success' OR STATUS=' Sucess ') and 
                                     PERSON='$status' and PERSON_ID='$id'");
                                    $ds_sc_row = $ds_sc->num_rows;
                                    while($row1 = $ds_sc->fetch_assoc()){
                                        $ds_sc_am += $row1['AMOUNT'];
                                    }
                                    
                                    array_push($temp_array,array("Success"=>$ds_sc_am));
                                    
                                    $rt_pn = $con->query("SELECT * FROM recharge_history where DATE='$date' and  (STATUS='Pending' OR STATUS='pending') and OWNER='$owner' and OWNER_ID='$ownerID'");
                                    $rt_pn_row = $rt_pn->num_rows;
                                     while($row2 = $rt_pn->fetch_assoc()){
                                        $rt_pn_am += $row2['AMOUNT'];
                                    }
                                    
                                    array_push($temp_array,array("Pending"=>$rt_pn_am));
                                    
                                     $ds_pn = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Pending' OR STATUS='pending') and  PERSON='$status' and PERSON_ID='$id'");
                                    $ds_pn_row = $ds_pn->num_rows;
                                     while($row2 = $ds_pn->fetch_assoc()){
                                        $ds_pn_am += $row2['AMOUNT'];
                                    }
                                    
                                    array_push($temp_array,array("Pending"=>$ds_pn_am));
                                    
                                    $rt_fl = $con->query("SELECT * FROM recharge_history where  DATE='$date' and  STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'
                                    and OWNER='$owner' and OWNER_ID='$ownerID'");
                                    $rt_fl_row = $rt_fl->num_rows;
                                     while($row3 = $rt_fl->fetch_assoc()){
                                        $rt_fl_am += $row3['AMOUNT'];
                                    }
                                    
                                    array_push($temp_array,array("Success"=>$rt_fl_am));
                                    $ds_fl = $con->query("SELECT * FROM recharge_history where  DATE='$date' and   STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'
                                    and PERSON='$status' and PERSON_ID='$id'");
                                    $ds_fl_row = $ds_fl->num_rows;
                                     while($row3 = $ds_fl->fetch_assoc()){
                                        $ds_fl_am += $row3['AMOUNT'];
                                    }
                                    
                                    array_push($temp_array,array("Success"=>$ds_sc_am));
                                    
                                    echo json_encode($temp_array);





?>