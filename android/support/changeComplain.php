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
        $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$pass_hash."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0)
                    {
                       
                       echo 'SUCCESS';
                
            
                    
                            
                //  $delete  = $con->query("DELETE FROM `rc_complaint` WHERE USER_NUMBER='$userMobile' AND TXN_ID='$txnID'");
                //     echo "Complain Deleted";
            
      
                            
            



            }
                
                else{
                
                    echo "FAILED";
                    
                }
        
        
    }

        

?>