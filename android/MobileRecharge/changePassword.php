<?php
    include("config.php");
    
    $table = $_POST['table'];
    $mobile = $_POST['mobile'];
    $old_pass = $_POST['password'];
    $new_pass = $_POST['newpassword'];
    

    
    
    $old_pass_hash = md5($old_pass);
    $new_pass_hash = md5($new_pass);
    
            if(isset($new_pass)){
            
            
            
            mysqli_query($con,"UPDATE $table SET `PASSWORD`='$new_pass_hash' WHERE MOBILE = '$mobile' AND PASSWORD = '$old_pass_hash'");
            
            if(mysqli_affected_rows($con)>0){
                
                echo "Password Successfully Changed";
                
            }
	       else
	            {
	                echo "Password Couldn't Change";
	            }
                
            }
            
            
	    else{
	        
	        echo "Password Couldn't Change";
           
	        
	    }

?>