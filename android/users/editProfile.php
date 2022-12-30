<?php 
    include("../../includes/config.php");
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $address= $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    //$table = $_POST['table'];
    $table = 'admin';
    //$mobile = $_POST['mobile'];
    $mobile = '8876512898';
    $password = $_POST['password'];
    //$pass_hash = md5($password);
    $pass_hash = '36aba7ac608d9f5dacb81c00c82bc54d';
    $check = "Unclear";

    $details = $con->query("select * from $table where MOBILE='$mobile' and PASSWORD='$pass_hash'")->fetch_assoc();
    $old_email = $details['EMAIL'];

if($table=="admin"){
$mysql_qry = "SELECT * FROM `admin` WHERE `EMAIL`= '$email'";
$result = mysqli_query($con, $mysql_qry);
$nrows = mysqli_num_rows($result);
    if($nrows > 0) {
        echo "Email already Exist";  
    }
else {
$query = "UPDATE `$table` SET `NAME`='$name',`EMAIL`='$email' WHERE `MOBILE` ='$mobile' AND `PASSWORD` ='$pass_hash'";
if(mysqli_query($con,$query)){
echo "Update Succeed";
}
else
{
echo "Failed to update";
}
} }
// ADMIN PROFILE UPDATE END HERE


                                    




?>