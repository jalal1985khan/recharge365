<?php
    include("../../includes/config.php");
    $FPersonMobile = $_POST['FPersonMobile'];
    $FPersonTable = $_POST['FPersonStatus'];
    $FPersonID = $_POST['FPersonID'];
    $FPersonOwnerID = $_POST['FPersonOwnerID'];
    $FPersonOwnerStatus = $_POST['FPersonOwnerStatus'];
    $SPersonMobile = $_POST['SPersonMobile'];
    $SPersonTable = $_POST['SPersonStatus'];
    $SPersonID = $_POST['SPersonID'];
    $BalanceType = $_POST['BalanceType'];
    $Amount = $_POST['Amount'];
    $perfID = $_POST['id'];
    
    mysqli_query($con,"UPDATE `ofline_req` SET `APPROVALSTATUS`='REJECTED' WHERE USERMOBILE = '$SPersonMobile' AND PERSONID = '$SPersonID' AND ID = '$perfID'");
    if(mysqli_affected_rows($con)>0){
    echo "Fund Rejected";   
    
            }
            else{
                
                echo "Failed";
            }





?>