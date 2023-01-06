<?php 
    include("../../includes/config.php");
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $address= $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $table = $_POST['table'];
    //$table = 'admin';
    $mobile = $_POST['mobile'];
    //$mobile = '8876512898';
    $password = $_POST['password'];
    $pass_hash = md5($password);
    //$pass_hash = '36aba7ac608d9f5dacb81c00c82bc54d';
    $check = "Unclear";

   // echo "Update Succeed";
// ADMIN PROFILE UPDATE END HERE
$details = $con->query("select * from `$table` where MOBILE='$mobile' and PASSWORD='$pass_hash'")->fetch_assoc();
    
    $old_email = $details['EMAIL'];
    
    if($email==$old_email){
        $email="xyz123@xyz.com";
    }
    
    
                                    
        $mysql_qry = "SELECT * FROM `retailer` WHERE EMAIL='$email'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {

            echo "Email already Exist";
            
        }
        else
        {
            
        $mysql_qry = "SELECT * FROM `distributer` WHERE EMAIL='$email'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
            echo "Email already Exist";
            
        }
        else
        {
        
        $mysql_qry = "SELECT * FROM `masterdistributer` WHERE EMAIL='$email'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
            echo "Email already Exist";
            
        }
        
        else
        {
            $mysql_qry = "SELECT * FROM `admin` WHERE EMAIL='$email'";
        $result = mysqli_query($con, $mysql_qry);
        $numbers_of_rows = mysqli_num_rows($result);
        if($numbers_of_rows > 0) {
            echo "Email already Exist";
            
        }
        else
        {
         $mysql_qry = "SELECT * FROM `Api_users` WHERE EMAIL='$email'";
         $result = mysqli_query($con, $mysql_qry);
         $numbers_of_rows = mysqli_num_rows($result);
         if($numbers_of_rows > 0) {
            echo "Email already Exist";
            
            }
            
            else
            {
                
                
             if($table=="retailer"){
                 if($email=="xyz123@xyz.com"){
                     $email = $old_email;
                 }
        
                 $query = "UPDATE `$table` SET `FNAME`='$name',`EMAIL`='$email',`ADDRESS`='$address',`CITY`='$city',`STATE`='$state' WHERE MOBILE='$mobile' AND PASSWORD='$pass_hash'";
    if(mysqli_query($con,$query)){
             echo "Update Succeed";
         }
    else
    {
        
        echo "Failed to update";
    
    }
        
         
    }
    if($table=="admin"){
        
                         if($email=="xyz123@xyz.com"){
                     $email = $old_email;
                 }
                 $query = "UPDATE `$table` SET `NAME`='$name',`EMAIL`='$email' WHERE MOBILE='$mobile' AND PASSWORD='$pass_hash'";
     if(mysqli_query($con,$query)){
             echo "Update Succeed";
         }
    else
    {
        
        echo "Failed to update";
    
    }
         
    }
    if($table!="admin" && $table!="retailer"){
        
                if($email=="xyz123@xyz.com"){
                     $email = $old_email;
                 }
        
                 $query = "UPDATE `$table` SET `NAME`='$name',`EMAIL`='$email',`ADDRESS`='$address',`CITY`='$city',`STATE`='$state' WHERE MOBILE='$mobile' AND PASSWORD='$pass_hash'";
                 
    if(mysqli_query($con,$query)){
             echo "Update Succeed";
         }
    else
    {
        
        echo "Failed to update";
    
    }
         
    }
                
                
                
                
            }
            
        }
            
            
        }
            
            
        }
            
}

                                    




?>