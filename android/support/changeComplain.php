<?php

    include("../../includes/config.php");
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $txnID = $_POST['txnID'];
    $userMobile = $_POST['userMobile'];
    $statusGiven = $_POST['status'];
    $remarks = $_POST['remarks'];
    $pass_hash = md5($password);
    $date = date("Y-m-d");

    if($txnID!=""){
        echo 'SUCCESS';
     

                }
                else{
                    echo 'FAILED';   
                }

        

?>