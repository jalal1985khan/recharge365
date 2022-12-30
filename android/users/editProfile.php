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

    $details = $con->query("select * from `masterdistributer` where `MOBILE`='$mobile' and `PASSWORD`='$pass_hash'")->fetch_assoc();
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