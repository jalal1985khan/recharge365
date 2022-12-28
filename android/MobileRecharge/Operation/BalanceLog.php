<?php

    include("config.php");
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    
    
    $table = $_POST['table'];
    $id = $_POST['id'];
    

    
    
    
    $rcBal = 0;
    $dmrBal = 0;
    $commBal = 0;
    $comm_amount = 0;
    
    $tableCaps = strtoupper($table);
    
                
                $temp_array = array();
                $data = $con->query("SELECT * FROM `$table` WHERE ID = '$id'")->fetch_assoc();
                    $rcBal = $data['RCBAL'];
                        
                    $dmrBal = $data['DMRBAL'];




                if($table =="Api_users"){
                   $table ="API_USER";
                }

                $comm = $con->query("select * from `comm_rpt` where TYPE='$table' and USER_ID='$id' and DATE='$date'");
                while($cmm = $comm->fetch_assoc()){
                    $comm_amount += $cmm['AMOUNT'];
                }








                
                array_push($temp_array,array("RC BAL"=>$rcBal, "Comm."=>$comm_amount, "DMR BAL"=>$dmrBal));
                
                echo json_encode($temp_array);
 
 


?>