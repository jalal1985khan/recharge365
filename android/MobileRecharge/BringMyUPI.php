<?php

    include("config.php");
        
                $mysql_qry = "SELECT * FROM `google_pay_business`";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
   
                // PA_UPI_ID,PN_NAME,MC_MERCHANT_CODE,TN_TXN_MSG,CU_CURRENCY;
                array_push($temp_array,array("PA_UPI_ID"=>$row["PA_UPI_ID"],"PN_NAME"=>$row['PN_NAME'],"MC_MERCHANT_CODE"=>$row['MC_MERCHANT_CODE'],"TN_TXN_MSG"=>$row['TN_TXN_MSG'],"CU_CURRENCY"=>$row['CU_CURRENCY'],"MIN_ADD"=>$row['MIN_ADD_WALLET'],"MAX_ADD"=>$row['MAX_ADD_WALLET']));
            }    
                echo json_encode($temp_array);        
            
        }



?>