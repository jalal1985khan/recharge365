<?php 

session_start();
error_reporting(0);
include("../includes/config.php");
if(isset($_POST['login'])){

    echo $mobile= $_POST['mobile'];
    echo $password = md5($_POST['password']);
    
    $query = "select * FROM retailer WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";
    $result = mysqli_query($con, $query);
    $row=mysqli_num_rows($result);
    $curr=$result->fetch_assoc();
    if($row!=0){
        $_SESSION["row"]=$curr;
        $_SESSION["rt_id"]=$curr['ID'];
		$_SESSION["retailer_status"] = "IN";
		header("location:../dashboard/retailer/index.php");
	}else{
    	$query = "select * FROM distributer WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
        $result = mysqli_query($con, $query);
        $row=mysqli_num_rows($result);
        $curr=$result->fetch_assoc();
        if($row!=0){
            $_SESSION["row"]=$curr;
            $_SESSION["ds_id"]=$curr['ID'];
    		$_SESSION["distributer_status"] = "IN";
    			header("location:../dashboard/distributer/index.php");
    
    	}else{
        	$query = "select * FROM masterdistributer WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
            $result = mysqli_query($con, $query);
            $row=mysqli_num_rows($result);
            $curr=$result->fetch_assoc();
            if($row!=0){
                $_SESSION["row"]=$curr;
                $_SESSION["ms_id"]=$curr['ID'];
        		$_SESSION["masterdistributer_status"] = "IN";
                		header("location:../dashboard/masterdistributer/index.php");
        
        	}else{
            	$query = "select * FROM Api_users WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
                $result = mysqli_query($con, $query);
                $row=mysqli_num_rows($result);
                $curr=$result->fetch_assoc();
                if($row!=0){
                    $_SESSION["row"]=$curr;
                    $_SESSION["ap_id"]=$curr['ID'];
            		$_SESSION["masterdistributer_status"] = "IN";
                    		header("location:../dashboard/apiuser/index.php");
            
            	}
            	else{
            	   // echo "<script>alert('User not found')
            	    //location.replace('../index.php')</script>";
            	}
        	}
    	}
	}
	
	
}
else{
    //header("location:../");    
}

?>