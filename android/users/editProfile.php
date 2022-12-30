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

    echo "Update Succeed";
// ADMIN PROFILE UPDATE END HERE


                                    




?>