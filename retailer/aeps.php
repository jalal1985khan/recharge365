<?php
include("../includes/config.php");
initate();
function initate(){
      $url = "http://uat.dhansewa.com/AEPS/BCInitiate";
        global $con;
        // $us = $con->query("select * from bc_users where US_ID='".$_SESSION['rt_id']."' ")->fetch_assoc();
        // // $bc_id = $us['BC']
        $arr = array(
            "bc_id" => "BC047036725",
            "phone1" => "6289195314",
            "ip" => "88.99.218.137",
            "userid" => "91272",
            "saltkey" => "BNVCMJFD889VHVHH223500048MNAZXCKJF88900LKDHF",
            "secretkey" => "BNJM87900JDLLPQWERTY785755NNBVML00986474JJDJUFDUU" 
            );
            
        $data_string = json_encode($arr , true);
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        $result_arr =  json_decode($result);
        foreach($result_arr as $rsps){
            $url = $rsps->Result;
        }
        echo $url;
        header("location: https://icici.bankmitra.org/Location.aspx?text=$url");
}

?>