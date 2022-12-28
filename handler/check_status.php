<?php
session_start();

if(isset($_GET['Txntype'])){
    $random = mt_rand(99999 , 100000000);
    $random_string = substr(str_shuffle("QWERTYUIOPASDFGHJKZXCVBNM") , 3 ,6);
    $trans = $random_string.$random;
    $vendor = mt_rand(88888 , 9999999);
    echo json_encode(array("MESSAGE" => "Success" , "STATUS" => "SUCCESS" , "TRANSACTION_ID" => $trans , "VENDOR_ID" => $vendor));
}

?>