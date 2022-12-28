<?php

    include("config.php");
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $txnID = $_POST['txnID'];
    $userMobile = $_POST['userMobile'];
    $id = $_POST['ComplainNo'];
    $pass_hash = md5($password);

        
        $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$pass_hash."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0)
                    {
                            
        $mysql_qry = "SELECT * FROM `rc_complaint` WHERE ID='$id'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0){
                            
                 $delete  = $con->query("DELETE FROM `rc_complaint` WHERE ID='$id'");
                    echo "Complain Deleted";
            
                }
                else{
                    
                    echo "Doesn't Exist in Database anymore.";
                }
                        
                            
            
                    }
                
                else{
                
                    echo "Failed";
                    
                }
        
    
    






?>