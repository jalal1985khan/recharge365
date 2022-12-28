<?php 

session_start();
error_reporting(0);
include("../config.php");
if(isset($_POST['login'])){
    $mobile= $_POST['mobile'];
    echo $password = md5($_POST['password']);
    
    $query = "select * FROM retailer WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";
    $result = mysqli_query($con, $query);
    $row=mysqli_num_rows($result);
    $curr=$result->fetch_assoc();
    if($row!=0){
        $_SESSION["row"]=$curr;
        $_SESSION["rt_id"]=$curr['ID'];
		$_SESSION["retailer_status"] = "IN";
		header("location:../../retailer/index.php");
        $_SESSION['msg'] = 'logging as Retailer';
	}else{
    	$query = "select * FROM distributer WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
        $result = mysqli_query($con, $query);
        $row=mysqli_num_rows($result);
        $curr=$result->fetch_assoc();
        if($row!=0){
            $_SESSION["row"]=$curr;
            $_SESSION["ds_id"]=$curr['ID'];
    		$_SESSION["distributer_status"] = "IN";
    			header("location:../../distributer/index.php");
                $_SESSION['msg'] = 'logging as Distributer';
    
    	}else{
        	$query = "select * FROM masterdistributer WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
            $result = mysqli_query($con, $query);
            $row=mysqli_num_rows($result);
            $curr=$result->fetch_assoc();
            if($row!=0){
                $_SESSION["row"]=$curr;
                $_SESSION["ms_id"]=$curr['ID'];
        		$_SESSION["masterdistributer_status"] = "IN";
                		header("location:../../masterdistributer/index.php");
                        $_SESSION['msg'] = 'logging as Master Distributer';
        
        	}else{
            	$query = "select * FROM Api_users WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
                $result = mysqli_query($con, $query);
                $row=mysqli_num_rows($result);
                $curr=$result->fetch_assoc();
                if($row!=0){
                    $_SESSION["row"]=$curr;
                    $_SESSION["ap_id"]=$curr['ID'];
            		$_SESSION["masterdistributer_status"] = "IN";
                    		header("location:../../apiuser/index.php");
                            $_SESSION['msg'] = 'API User';
            
            	}
                else{
                    
                    $query = "select * FROM admin WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
                    $result = mysqli_query($con, $query);
                    $row=mysqli_num_rows($result);
                    $curr=$result->fetch_assoc();

                    if ($row != 0) {
                        
                        $admin_id = $curr['ID'];
                        $_SESSION["status"] = $admin_id;
                        header("location:../../agent/index.php");
                        $_SESSION['msg'] = 'Welcome Admin';
                        
                    }
                    
                    else{
                    header("location:../../");  
                    $_SESSION['msg'] = 'username not found';
                    }
                    
            	}
        	}
    	}
	}
	
	
}
else{
    header("location:../../");  
    $_SESSION['msg'] = 'username cannot be blank';

}
