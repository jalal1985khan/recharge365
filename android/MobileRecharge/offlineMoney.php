<?php

    include("config.php");
    
    $userid = $_POST['userid'];
    $userstatus = $_POST['userstatus'];
    $ownerid = $_POST['ownerid'];
    $ownerstatus = $_POST['ownerstatus'];
    $amount = $_POST['amount'];
    $usermobile = $_POST['usermobile'];
    $bal = $_POST['money'];

    
        
        mysqli_query($con,"INSERT INTO `ofline_req`( `USERMOBILE`,`OWNERID`, `OWNERSTATUS`, `PERSONID`, `PERSONSTATUS`, `AMOUNT`, `APPROVALSTATUS`, `BAL_TYPE`) VALUES ('$usermobile','$ownerid','$ownerstatus','$userid','$userstatus','$amount','PENDING','$bal')");
        
        
            if(mysqli_affected_rows($con)>0){
                
                echo "Fund Requested Successfully";
                
            }
	       else
	            {
	                echo "Fund Request Failed";
	            }
                
        
            






?>