  <?php
  
          

        define('HOST','localhost');

        define('USER','recharge');

      	define('PASS','c!HepeZ1zycyp4T5');

	    define('DB','recharge_db');
	    
	    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
  
    $mobile= $_POST['MOBILE'];
    $password = md5($_POST['PASSWORD']);
    
    $query = "select * FROM retailer WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";
    $result = mysqli_query($con, $query);
    $row=mysqli_num_rows($result);
    if($row!=0){
        echo "Welcome Retailer";
	}else{
    	$query = "select * FROM distributer WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
        $result = mysqli_query($con, $query);
        $row=mysqli_num_rows($result);
        if($row!=0){
        echo "Welcome distributer";
        
    	}else{
        	$query = "select * FROM masterdistributer WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
            $result = mysqli_query($con, $query);
            $row=mysqli_num_rows($result);
            if($row!=0){
        echo "Welcome Masterdistributer";
        
        	}else{
            	$query = "select * FROM Api_users WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$password. "'";
                $result = mysqli_query($con, $query);
                $row=mysqli_num_rows($result);
                if($row!=0){
                    echo "Welcome API User";
            
            	}
            	else{
            	    echo "User not found";
            	}
        	}
    	}
	}
	
         
	
?>