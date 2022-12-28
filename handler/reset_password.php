
<?php
session_start();
error_reporting(E_ALL);
include("../dashboard/includes/function.php");

include("../dashboard/includes/config.php");
$res = $con->query("SELECT * FROM `websetting` WHERE ID = 1");
$row2 = $res->fetch_assoc();
    
$weburl = $row2['WEBURL'];

if(isset($_POST['reset'])){
    $number= $_POST['mobile'];
    $password = mt_rand(100000 , 900000);
    $query = "select * FROM masterdistributer WHERE MOBILE = '$number'";
    $result = mysqli_query($con, $query);
    $row=mysqli_num_rows($result);
    $pass_hash = md5($password);
  //  $message = "Dear%20User%20your%20Password%20is%20$password%20from%20www.recharges365.com";
 //   $message2 = "Dear User Your Password is $password from www.recharges365.com";
    if($row!=0){
        $query2 = "select `EMAIL` FROM masterdistributer WHERE MOBILE = '$number'";
        
        	$email_data = mysqli_query($con, $query2);
        	$email = $email_data->fetch_assoc();
		$sql = "UPDATE masterdistributer SET PASSWORD='$pass_hash' WHERE MOBILE='$number'";
    		$result = mysqli_query($con, $sql);
		sendMessage($number,$message);
		sendMail($email["EMAIL"],$message2);
		echo"<script>alert('New Password Creates Cheak Your Phone');location.replace('../login.php');</script>";
}else{
     $query = "select * FROM distributer  WHERE MOBILE = '$number'";
        $result = mysqli_query($con, $query);
        $row=mysqli_num_rows($result);
       // echo $row;
        if($row!=0){
            $query2 = "select `EMAIL` FROM distributer WHERE MOBILE = '$number'";
            
            	$email_data = mysqli_query($con, $query2);
            	$email = $email_data->fetch_assoc();
            
    		$sql = "UPDATE distributer SET PASSWORD='".$pass_hash."' WHERE MOBILE='".$number."'";
        		$result = mysqli_query($con, $sql);
    
    		sendMessage($number,$message);
    		sendMail($email['EMAIL'],$message2);
    		echo"<script>alert('New Password Creates Cheak Your Phone'); location.replace('../login.php');</script>";
    }else{
         $query = "select * FROM retailer WHERE MOBILE = '$number'";
            $result = mysqli_query($con, $query);
            $row=mysqli_num_rows($result);
            // echo $row;
            if($row!=0){
                $query2 = "select `EMAIL` FROM retailer WHERE MOBILE = '$number'";
                
                	$email_data = mysqli_query($con, $query2);
                	$email = $email_data->fetch_assoc();
        
        		$sql = "UPDATE retailer SET PASSWORD='".$pass_hash."' WHERE MOBILE='".$number."'";
            		$result = mysqli_query($con, $sql);
        		sendMessage($number,$message);	
        		sendMail($email['EMAIL'],$message2);
        		echo"<script>alert('New Password Creates Cheak Your Phone'); location.replace('../login.php');</script>";
        }else{
             $query = "select * FROM Api_users WHERE MOBILE = '$number'";
                $result = mysqli_query($con, $query);
                $row=mysqli_num_rows($result);
                // echo $row;
                if($row!=0){
                    $query2 = "select `EMAIL` FROM Api_users WHERE MOBILE = '$number'";
                    
                    	$email_data = mysqli_query($con, $query2);
                    	$email = $email_data->fetch_assoc();
            
            		$sql = "UPDATE Api_users SET PASSWORD='".$pass_hash."' WHERE MOBILE='".$number."'";
                		$result = mysqli_query($con, $sql);
            		sendMessage($number,$message);	
            		sendMail($email['EMAIL'],$message2);
            		echo"<script>alert('New Password Creates Cheak Your Phone'); location.replace('../login.php');</script>";
            }
             else{
            	echo "<script>alert('User not found');location.replace('../forget-password.php');</script>";
            }	
        }
    }
    
}

}

?>