<?php

    $st_id = $_POST['stateID'];
    $url = "http://uat.dhansewa.com/Common/GetDistrictByState";
    
       $data_string = json_encode(array("stateid"=>$st_id));
        $header = array('Content-Type:application/json');
        //initialize curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        echo $result;



?>