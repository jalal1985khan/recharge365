<?php 
       
       
       include("dbConnect.php");

    $mobile= $_POST['MOBILE'];
    $password = md5($_POST['PASSWORD']);
    
    
        $mysql_qry = "select * FROM admin WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo "Welcome admin";
        
            
        }
        else{    
            
    
    
        $mysql_qry = "select * FROM retailer WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo "Welcome retailer";
                }
            else {
                            $mysql_qry = "select * FROM masterdistributer WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo "Welcome masterdistributer";
                }
            else {
                            $mysql_qry = "select * FROM distributer WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo "Welcome distributer";
                }
            else {
                            $mysql_qry = "select * FROM Api_users WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";

        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        echo "Welcome Api User";
                }
            else {
                    echo "login not success";
                }
            }
        }
                }
                
                
        }  
 




?>