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

    $details = $con->query("select * from `masterdistributer` where MOBILE='9731415095' and PASSWORD='b2fe7b1b2666db3112bfa165c22985f9'")->fetch_assoc();
    $old_email = $details['EMAIL'];
    echo $old_email;


    $res = $con->query("SELECT * FROM masterdistributer order by NAME ASC");
    echo $res;
    echo "Update Succeed";
                                    




?>