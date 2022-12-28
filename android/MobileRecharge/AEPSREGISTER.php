<?php
    
   include("config.php");
   
         $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $mobile = $_POST['mobile'];
      $amobile = $_POST['amobile'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $block = $_POST['block'];
      $landmark = $_POST['landmark'];
      $locality = $_POST['locality'];
      $mohalla = $_POST['mohalla'];
      $shopname = $_POST['shopname'];
      $city = $_POST['city'];
      $pincode = $_POST['pincode'];
      $pannumber = $_POST['pannumber'];
      $dob = $_POST['dob'];
      $state = $_POST['state'];
      $district = $_POST['district'];
      $shoptype = $_POST['shoptype'];
      $qualification = $_POST['qualification'];
      $locationtype = $_POST['locationtype'];
      $areapopulation = $_POST['areapopulation'];
      $idphoto = $_POST['idphoto'];
      $addressproof = $_POST['addressproof'];
      $shopproof = $_POST['shopproof'];
      $passportpic = $_POST['passportpic'];
      $myID = $_POST['id'];
      $myStatus = $_POST['mystatus'];
   
      global $con;
      $url = "http://uat.dhansewa.com/AEPS/APIBCRegistration";
   
              // mkdir($mobile);
            mkdir("../../dashboard/KycForms/".$mobile);
            
            $target_dir1 = "../../dashboard/KycForms/".$mobile."/";
            $target_dir2 = "../../dashboard/KycForms/".$mobile."/";
            $target_dir3 = "../../dashboard/KycForms/".$mobile."/";
            $target_dir4 = "../../dashboard/KycForms/".$mobile."/";
            $target_dir5 = "../../dashboard/KycForms/".$mobile."/";
        //user_photo
	
	$idphotoname = rand()."_".time().".jpeg";
	$target_dir1 = $target_dir1."/".$userphotoname;
	file_put_contents($target_dir1, base64_decode($idphoto));
        
        //user_photo 
        
        
        //aadhar_photo1
	
	$addressproofname = rand()."_".time().".jpeg";
	$target_dir2 = $target_dir2."/".$addressproofname;
	file_put_contents($target_dir2, base64_decode($addressproof));
        
        //aadhar_photo1

        //aadhar_photo2
	
	$shopproofname = rand()."_".time().".jpeg";
	$target_dir3 = $target_dir3."/".$shopproofname;
	file_put_contents($target_dir3, base64_decode($shopproof));
        
        //aadhar_photo2
        
        
        //pan_photo1
	
	$passportpicname = rand()."_".time().".jpeg";
	$target_dir4 = $target_dir4."/".$passportpicname;
	file_put_contents($target_dir4, base64_decode($passportpic));
        
        //pan_photo1
        
  
  


        $arr = array(
            "bc_f_name"=>"$fname",
            "bc_m_name"=>"",
            "bc_l_name"=>"$lname",
            "emailid"=>"$email",
            "phone1"=>"$mobile",
            "phone2"=>"$amobile",
            "bc_dob"=>"$dob",
            "bc_state"=>"$state",
            "bc_district"=>"$district",
            "bc_address"=>"$address",
            "bc_block"=>"$block",
            "bc_city"=>"$city",
            "bc_landmark"=>"$landmark",
            "bc_loc"=>"$locality", 
            "bc_mohhalla"=>"$mohalla",
            "bc_pan"=>"$pannumber",
            "bc_pincode"=>"$pincode",
            "shopname"=>"$shopname",
            "kyc1"=>"$idphoto",
            "kyc2"=>"$addressproof",
            "kyc3"=>"$shopproof",
            "kyc4"=>"$passportpic",
            "saltkey"=>"BNVCMJFD889VHVHH223500048MNAZXCKJF88900LKDHF",
            "secretkey"=>"BNJM87900JDLLPQWERTY785755NNBVML00986474JJDJUFDUU",
            "shopType"=>"$shoptype",
            "qualification"=>"$qualification",
            "population"=>"$areapopulation",
            "locationType"=>"$locationtype",
            );
            
        $data_string = json_encode($arr , true);
        $ch = curl_init($url);
        $header = array('Content-Type:application/json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //response of request 
        $result = curl_exec($ch);
        //close curl
        curl_close($ch);
        $arr = json_decode($result); 
               foreach($arr as $rspns){
                
                $bc_id  =  $rspns->bc_id;
                $msg =  $rspns->Message;
            
                   
               }
            if($rspns->Message=="Success"){
             
             $con->query("INSERT INTO `bc_users`(`f_name`, `l_name`, `email`, `num`, `alternate_num`, `dob`, `state`, `district`, `address`, `block`, `city`, 
            `landmark`, `locality`, `mohoalla`, `pan_number`, `pincode`, `shop_name`, `shop_type`, `qualification`, `area_population`, `location_type`, `US_ID`, `BC_ID`, 
            `msg`, `rspns`, `US_TYPE`, `id_proof`, `address_proof`, `shop_photo`, `psport_pic`) VALUES ('$fname','$lname','$email','$mobile','$amobile','$dob','$state','$district','$address','$block','$city','$landmark',
            '$locality','$mohalla','$pannumber','$pincode','$shopname','$shoptype','$qualification','$areapopulation','$locationtype',
            '$myID','$bc_id','$msg','$result','$myStatus' , '$idphotoname' , '$addressproofname' , '$shopproofname' , '$passportpicname')");   

                echo "Success";
            }
            else{
             
             echo $result;
                
            }



?>