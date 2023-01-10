<?php

    include("../../includes/config.php");
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $txnID = $_POST['txnID'];
    $userMobile = $_POST['userMobile'];
    $statusGiven = $_POST['status'];
    $statusGiven = strtoupper($statusGiven);
    $remarks = $_POST['remarks'];
    $mn = $_POST['mn'];
    $pass_hash = md5($password);
    $date = date("Y-m-d");

    $statusGiven ="SUCCESS";
    $rc_status="FAILED";
   $txnID = '12124';

if($txnID==""){

    // $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$pass_hash."'";
    // $result = mysqli_query($con, $mysql_qry);
    // $numbers_of_rows = mysqli_num_rows($result);
    // if($numbers_of_rows > 0)
                //{
                    $details = $con->query("SELECT * FROM `rc_complaint` WHERE USER_NUMBER='8876512898' AND TXN_ID='12124'")->fetch_assoc();
                    $personTYPE = $details['USER_TYPE'];
                    $amount = $details['RC_AMOUNT'];
                    $comm_amount = $details['COMM_AMOUNT'];
                    $rc_status = $details['RC_STATUS'];
                    $rc_status = strtoupper($rc_status);
                    if($statusGiven=="SUCCESS" && $rc_status=="FAILED"){
                    $q4 = $con->query("UPDATE `recharge_history` SET `STATUS`='$statusGiven' WHERE TRANS_ID='$txnID'");
                    if($q4){
                        $old = $con->query("select * from $personTYPE where MOBILE='$userMobile'")->fetch_assoc();
                                    $old_bal = $old['RCBAL'];
                                    $user_id = $old['ID'];
                                    if($personTYPE=='admin'){
                                     $owner = "admin";
                                     $ownerid = "1";
                                    }
                                    else if($personTYPE=='Api_users'){
                                        $owner = "admin";
                                        $ownerid = "1";
                                       }
                                     else if($personTYPE=='masterdistributer'){
                                        $owner = $old['OWNER'];
                                        $ownerid = $old['ADMIN_ID'];
                                       }
                                       else if($personTYPE=='distributer'){
                                        $owner = $old['OWNER'];
                                        $ownerid = $old['MS_ID'];
                                       }
                                   else if($personTYPE=='retailer'){
                                        $owner = $old['OWNER'];
                                        $ownerid = $old['DISTRIBUTER'];
                                        if($ownerid==""){
                                             $ownerid = $old['MS_ID'];
                                        }
                                    }

                            $finalBal = $old_bal-$comm_amount;
                           // $refund = $con->query("UPDATE `$personTYPE` SET `RCBAL`=$finalBal WHERE MOBILE='$userMobile'");
                            $q5 = $con->query("UPDATE `rc_complaint` SET `COMPLAIN_STATUS`='RESOLVED',`RC_STATUS`='$statusGiven',`$remarks`='RESOLVED' WHERE USER_NUMBER='8876512898' AND TXN_ID='$txnID'");
                            //$queryX1  = $con->query("INSERT INTO `amount_req`(`PERSON`, `TRANS_ID`, `USER`, `OWNER_ID`, `USER_ID`, `TYPE`, `PAYMENT_MODE`, `AMOUNT`, `FEE`, `STATUS`, `BEFORE_REQ`, `AFTER_REQ`, `TIME`) VALUES ('$owner','$txnID','$personTYPE','$ownerid','$user_id','Debit','Failed to Success','$comm_amount','0%','Deduction','$old_bal','$finalBal','$date')");
                            echo "SUCCESS";

                            
                        

                    }
                    }
// SUCCESS FAILED END HERE




                //}
    


      



        
    }
    else{
                
        echo "FAILED";
        
    }

        

?>