<?php
    include("../../includes/config.php");
    $table = $_POST['table'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $pass_hash = md5($password);
    
    
    
        if($table=="distributer"){
            $target_dir = "../../images/";
        }
        elseif($table=="retailer"){
            $target_dir = "../../images/";
        }
        elseif($table=="masterdistributer"){
            $target_dir = "../../images/";
        }
        elseif($table=="admin"){
            $target_dir = "../../images/";
        }
        else{
            $target_dir = "../../images/";
        }

    
    
    
    if(isset($_POST['image']))
	{
	    
	$image = $_POST['image'];
	$imageStore = rand()."_".time().".jpeg";
	$target_dir = $target_dir."/".$imageStore;
	file_put_contents($target_dir, base64_decode($image));




    // 	$select= "UPDATE `$table` SET IMAGE(image) VALUES ('$imageStore')";
    // $select= "UPDATE `$table` SET IMAGE ='$imageStore' WHERE MOBILE ='$mobile' AND PASSWORD ='$pass_hash'";
    $select= "UPDATE `$table` SET `IMAGE`='$imageStore' WHERE MOBILE ='$mobile' AND PASSWORD ='$pass_hash'";

	$responce = mysqli_query($con,$select);
	
	if($responce)
			{
							
			    echo $imageStore;
				mysqli_close($connect);
				
			}
	else{
	        echo "Failed";
			}
	}
?>