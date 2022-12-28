<?php
 
 require_once('dbConnect.php');
 
        // $mobile = "8240193554";
        $password = "143573";
 
    // $mysql_qry = "select * FROM retailer WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $mysql_qry = "select * FROM retailer WHERE MOBILE ='$mobile'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo    $result;
                }
            else {
                            $mysql_qry = "select * FROM masterdistributor WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo $result;
                }
            else {
                            $mysql_qry = "select* FROM distributor WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo $result;
                }
            else {
                            $mysql_qry = "select * FROM Api_user WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo $result;
                }
            else {
                    echo "name not found";
                }
            }
        }
    }    

?>






