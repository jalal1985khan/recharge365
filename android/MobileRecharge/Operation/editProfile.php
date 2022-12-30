<?php 
    include("config.php");
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $address= $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $table = $_POST['table'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $pass_hash = md5($password);
    $check = "Unclear";
        
    $details = $con->query("select * from `$table` where MOBILE='$mobile' and PASSWORD='$pass_hash'")->fetch_assoc();
    $old_email = $details['EMAIL'];
    echo "Update Succeed";
                                    




?>