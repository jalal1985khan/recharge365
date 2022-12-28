<?php

    include("config.php");
    
     $packname = $_POST['packname'];
     $PackageId = $_POST['id'];

        
        $con->query("DELETE FROM `operator_comm`WHERE PACKAGE_NAME = '$packname')");
    
    $query = "DELETE FROM `commPackage` WHERE PACKNAME='$packname' AND ID ='$PackageId'";
    $run = mysqli_query($con , $query );
   if($run) {
       echo "Package Deleted Successfully";
   }
   else{
       
       echo "Something went wrong";
   }
    




?>