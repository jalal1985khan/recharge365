<?php
    include("config.php");
    
    
    $table = $_POST['table'];
    $mobile = $_POST['mobile'];


    $fname = $_POST['fname'];
    $mobile1 = $_POST['mobile1'];
    $mobile2 = $_POST['mobile2'];
    $email = $_POST['email'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $userphotoname = "";
    $userphoto = //$_POST['userphoto'];
    $aadharno = //$_POST['aadharno'];
  //  $aadharphoto1 = "";
  //  $aadharphoto2 = "";
  //  $pannumber = $_POST['panno'];
  //  $panphoto1= "";
  //  $panphoto2= "";
  //  $panphotoImage1 = $_POST['panphotoimage1'];
 //   $panphotoImage2 = $_POST['panphotoimage2'];
  //  $aadharphotoImage1 = $_POST['aadharimage1'];
  //  $aadharphotoImage2 = $_POST['aadharimage2'];
    $bankname = $_POST['bankname'];
    $accname = $_POST['accname'];
    $accnumber = $_POST['accnumber'];
    $ifsc = $_POST['ifsc'];
   // $websitename = $_POST['websitename'];
   // $websiteurl = $_POST['websiteurl'];


    
    
    
    $check = "SELECT * FROM `mykyc` WHERE USER_MOBILE = '$mobile'";
    		$checkmobile = mysqli_fetch_array(mysqli_query($con,$check));
		if(isset($checkmobile)){
		    echo "KYC Already Applied";
		    mysqli_close($connect);
		  
		}
		else{
		    
    
    
    
    
            // mkdir($mobile);
            mkdir("../../../dashboard/KycForms/".$mobile);
            
            $target_dir1 = "../../../dashboard/KycForms/".$mobile."/";
            $target_dir2 = "../../../dashboard/KycForms/".$mobile."/";
            $target_dir3 = "../../../dashboard/KycForms/".$mobile."/";
            $target_dir4 = "../../../dashboard/KycForms/".$mobile."/";
            $target_dir5 = "../../../dashboard/KycForms/".$mobile."/";
        //user_photo
	
	$userphotoname = rand()."_".time().".jpeg";
	$target_dir1 = $target_dir1."/".$userphotoname;
	file_put_contents($target_dir1, base64_decode($userphoto));
        
        //user_photo 
        
        
        //aadhar_photo1
	
	$aadharphoto1 = rand()."_".time().".jpeg";
	$target_dir2 = $target_dir2."/".$aadharphoto1;
	file_put_contents($target_dir2, base64_decode($aadharphotoImage1));
        
        //aadhar_photo1

        //aadhar_photo2
	
	$aadharphoto2 = rand()."_".time().".jpeg";
	$target_dir3 = $target_dir3."/".$aadharphoto2;
	file_put_contents($target_dir3, base64_decode($aadharphotoImage2));
        
        //aadhar_photo2
        
        
        //pan_photo1
	
	$panphoto1 = rand()."_".time().".jpeg";
	$target_dir4 = $target_dir4."/".$panphoto1;
	file_put_contents($target_dir4, base64_decode($panphotoImage1));
        
        //pan_photo1
        
        //pan_photo2
	
	$panphoto2 = rand()."_".time().".jpeg";
	$target_dir5 = $target_dir5."/".$panphoto2;
	file_put_contents($target_dir5, base64_decode($panphotoImage2));
        
        //pan_photo2
        
        




    $select= "INSERT INTO `mykyc`(`USER_MOBILE`, `FULLNAME`, `MOBILE`, `MOBILE2`, `EMAIL`, `ADDRESS1`, `ADDRESS2`, `STATE`, `CITY`, `PINCODE`, `USERPHOTO`, `ADHARNO`, `ADHARPHOTO1`, `ADHARPHOTO2`, `PANNUMBER`, `PANPHOTO1`, `PANPHOTO2`, `BANKNAME`, `ACNAME`, `ACNUMBER`, `IFSCCODE`, `WEBSITENAME`, `WEBSITEURL`) VALUES ('$mobile','$fname','$mobile1','$mobile2','$email','$address1','$address2','$state','$city','$pincode','$userphotoname','$aadharno','$aadharphoto1','$aadharphoto2','$pannumber','$panphoto1','$panphoto2','$bankname','$accname','$accnumber','$ifsc','$websitename','$websiteurl')";

	$responce = mysqli_query($con,$select);
	
	if($responce)
			{
			    echo "Successfully Uploaded.";
				mysqli_close($con);
			}
	else{
	        echo "Failed";
			
	}
	
}	
	
?>