<?php 
    include("../../includes/config.php");
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
    echo "Update Succeed";
                                    




?>