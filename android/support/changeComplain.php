<?php

    include("../../includes/config.php");
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $txnID = $_POST['txnID'];
    $userMobile = $_POST['userMobile'];
    $statusGiven = $_POST['status'];
    $remarks = $_POST['remarks'];
    $mn = $_POST['mn'];
    $pass_hash = md5($password);
    $date = date("Y-m-d");

    if($txnID!=""){
        ECHO 'SUCCESS';
        $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$pass_hash."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0)
                    {
                        $details = $con->query("SELECT * FROM 'rc_complaint' WHERE USER_NUMBER='$userMobile' AND TXN_ID='$txnID'")->fetch_assoc();
                        $personTYPE = $details['USER_TYPE'];
                        $amount = $details['RC_AMOUNT'];
                        $comm_amount = $details['COMM_AMOUNT'];
                        $rc_status = $details['RC_STATUS'];
                        $rc_status = strtoupper($rc_status);

                        if($statusGiven=="SUCCESS" && $rc_status=="PENDING"){
                                echo 'SUCCESS';
                        }
                
            
                    
                            
                //  $delete  = $con->query("DELETE FROM `rc_complaint` WHERE USER_NUMBER='$userMobile' AND TXN_ID='$txnID'");
                //     echo "Complain Deleted";
            
      
                            
            



            }
                
                else{
                
                    echo "FAILED";
                    
                }
        
        
    }
    else{
                
        echo "FAILED";
        
    }

        

?>