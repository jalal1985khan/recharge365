<?php
 
 require_once('dbConnect.php');
 


     $mobile = $_POST['MOBILE'];
     $password = $_POST['PASSWORD'];
     $password_sec = md5($password);

    
        $mysql_qry = "SELECT * FROM `admin` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
            mysqli_close($con);
        }
                
                else{
        
        
        
    

       
       
        $mysql_qry = "SELECT * FROM `retailer` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array = array();
        if($numbers_of_rows > 0) {
                mysqli_close($con);
            
        }
            else {
                            $mysql_qry = "SELECT * FROM `masterdistributer` WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {
                mysqli_close($con);
            
        }
            else {
                            $mysql_qry = "select * FROM distributer WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {
                mysqli_close($con);
            
        }
            else {
                            $mysql_qry = "select * FROM Api_users WHERE MOBILE='".$mobile."' AND PASSWORD='".$password_sec."'";

        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        $temp_array =  array();
        if($numbers_of_rows > 0) {
            mysqli_close($con);
            
        }
            else {
                    echo "1";
                }
            }
        }
    }    
    
                }


?>