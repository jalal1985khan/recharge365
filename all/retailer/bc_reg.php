<?php

session_start();
if(!isset($_SESSION['rt_id']) || $_SESSION['rt_id']==="0"){
header("location:../../login.php");
}

require("../includes/config.php");
require("../includes/function.php");
require("../includes/recharge_action.php");
// $arr = '[{"emailid": "abc720@gmail.com","bc_id": "BC3551192","phone1": "9719532487","Message": "Success"}]';

// $arr2 = json_decode($arr); 
// foreach( $arr2 as $rspns){
//     // $rspns->emailid;
//     echo $rspns->bc_id;
// }

// echo "<img src='img/277769958_1614235379.jpeg' width=30px>";
// Get the image and convert into string

echo $data;
if(isset($_POST['register'])){
          global $con;
      $url = "http://uat.dhansewa.com/AEPS/APIBCRegistration";
      $date = date("Y-m-d");$f_name = strip_tags($_POST['f_name']);
      $l_name = strip_tags($_POST['l_name']);$email = strip_tags($_POST['email']);
      $num = strip_tags($_POST['num']);$alternate_num = strip_tags($_POST['alternate_num']);
      $dob = date("d-m-Y", strtotime($_POST['date_birth']));
      
      $state = strip_tags($_POST['state']);
      $district = strip_tags($_POST['district']);$address = strip_tags($_POST['address']);
      $block = strip_tags($_POST['block']);$city = strip_tags($_POST['city']);
      $landmark = strip_tags($_POST['landmark']);$locality = strip_tags($_POST['locality']);
      $mohoalla = strip_tags($_POST['mohoalla']);$pan = strip_tags($_POST['pan_number']);
      $pincode = strip_tags($_POST['pincode']);$shop_name = strip_tags($_POST['shop_name']);
      $shop_type = strip_tags($_POST['shop_type']);$qualification = strip_tags($_POST['qualification']);
      $area_population = strip_tags($_POST['area_population']);$location_type = strip_tags($_POST['location_type']);
      
      mkdir("kyc_form/$pan");
      
      $id_pic = $_FILES['id_proof'];
      $add_prf = $_FILES['address_proof'];
      $shop_pic = $_FILES['shop_photo'];
      $psport_pic = $_FILES['psport_pic'];
      

      move_uploaded_file($id_pic['tmp_name'] , "kyc_form/$pan/".$id_pic['name']);
      move_uploaded_file($add_prf['tmp_name'] , "kyc_form/$pan/".$add_prf['name']);
      move_uploaded_file($shop_pic['tmp_name'] , "kyc_form/$pan/".$shop_pic['name']);
      move_uploaded_file($psport_pic['tmp_name'] , "kyc_form/$pan/".$psport_pic['name']);
      
      
      $img = file_get_contents('https://recharge.webspidy.in/dashboard/retailer/kyc_form/'.$pan.'/'.$id_pic['name']);
      $img2 = file_get_contents('https://recharge.webspidy.in/dashboard/retailer/kyc_form/'.$pan.'/'.$add_prf['name']);
      $img3 = file_get_contents('https://recharge.webspidy.in/dashboard/retailer/kyc_form/'.$pan.'/'.$shop_pic['name']);
      $img4 = file_get_contents('https://recharge.webspidy.in/dashboard/retailer/kyc_form/'.$pan.'/'.$psport_pic['name']);
        $data = base64_encode($img);
        $data2 = base64_encode($img2);
        $data3= base64_encode($img3);
        $data4 = base64_encode($img4);


        $arr = array(
            "bc_f_name"=>"$f_name",
            "bc_m_name"=>"",
            "bc_l_name"=>"$l_name",
            "emailid"=>"$email",
            "phone1"=>"$num",
            "phone2"=>"$alternate_num",
            "bc_dob"=>"$dob",
            "bc_state"=>"$state",
            "bc_district"=>"$district",
            "bc_address"=>"$address",
            "bc_block"=>"$block",
            "bc_city"=>"$city",
            "bc_landmark"=>"$landmark",
            "bc_loc"=>"$locality", 
            "bc_mohhalla"=>"$mohoalla",
            "bc_pan"=>"$pan",
            "bc_pincode"=>"$pincode",
            "shopname"=>"$shop_name",
            "kyc1"=>"$data",
            "kyc2"=>"$data2",
            "kyc3"=>"$data3",
            "kyc4"=>"$data4",
            "saltkey"=>"BNVCMJFD889VHVHH223500048MNAZXCKJF88900LKDHF",
            "secretkey"=>"BNJM87900JDLLPQWERTY785755NNBVML00986474JJDJUFDUU",
            "shopType"=>"$shop_type",
            "qualification"=>"$qualification",
            "population"=>"$area_population",
            "locationType"=>"$location_type",
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
              
      $id_pic_name = $id_pic['name'];
      $add_prf_name = $add_prf['name'];
      $shop_pic_name = $shop_pic['name'];
      $psport_pic_name = $psport_pic['name'];
      
      
        foreach($arr as $rspns){
            $bc_id  =  $rspns->bc_id;
            $msg =  $rspns->Message;
            $us_id = $_SESSION['rt_id'];
            $con->query("INSERT INTO `bc_users`(`f_name`, `l_name`, `email`, `num`, `alternate_num`, `dob`, `state`, `district`, `address`, `block`, `city`, 
            `landmark`, `locality`, `mohoalla`, `pan_number`, `pincode`, `shop_name`, `shop_type`, `qualification`, `area_population`, `location_type`, `US_ID`, `BC_ID`, 
            `msg`, `rspns`, `US_TYPE`, `id_proof`, `address_proof`, `shop_photo`, `psport_pic`) VALUES ('$f_name','$l_name','$email','$num','$alternate_num','$dob','$state','$district','$address','$block','$city','$landmark',
            '$locality','$mohoalla','$pan','$pincode','$shop_name','$shop_type','$qualification','$area_population','$location_type',
            '$us_id','$bc_id','$msg','$result','RETAILER' , '$id_pic_name' , '$add_prf_name' , '$shop_pic_name' , '$psport_pic_name')");
            
            echo "<script>alert('".$rspns->Message." ".$rspns->bc_id."')</script>";
        }
}


?>

<style>
    i{
        cursor:pointer;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Complete KYC</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="assets/pages/advance-elements/css/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="../bower_components/datedropper/datedropper.min.css" />

    <link rel="stylesheet" type="text/css"
        href="../bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">

    <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="assets/css/color/color-1.css" id="color" />
    <link rel="stylesheet" type="text/css" href="assets/css/linearicons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>

    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
                <!-- Top Header -->
                <?php
            include "topheader.php";
            ?>
            <!-- END Top Header -->

            <!--  LiveChat -->
            <?php
            include "Livechat.php";
            ?>
            <!-- END LiveChat -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- sidebarlist -->
                    <?php
                        include "sidebarlist.php";
                    ?>
                    <!-- sidebarlist -->
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body user-profile">
                                <div class="page-wrapper">

                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>Complete KYC</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Complete KYC</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                           
                                  


                                    <div class="page-body">
                                            
                                            <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Enter Details</h5>
                                                             </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form action="" method="post" enctype="multipart/form-data">
                                                                                            <div class="form-group row justify-content-center mt-3">
                                                                                                <div class="col-sm-3">
                                                                                                    <label>First Name</label>
                                                                                                    <input type="text" name="f_name" class="form-control"
                                                                                                        placeholder="First Name">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-3">
                                                                                                     <label>Last Name</label>
                                                                                                    <input type="text" name="l_name" class="form-control"
                                                                                                        placeholder="Last Name">
                                                                                                </div> 
                                                                                                <div class="form-group col-sm-3">
                                                                                                    <label>Email</label>
                                                                                                    <input type="text" name="email" class="form-control"
                                                                                                        placeholder="Email">
                                                                                                </div>
                                                                                                <div class="form-group col-sm-3">
                                                                                                    <label>Mobile</label>
                                                                                                    <input type="text" name="num" class="form-control"
                                                                                                        placeholder="Mobile">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row justify-content-center mt-3">
                                                                                                 <input type='hidden' id="op_code"> <!--for r-offer -->
                                                                                                <div class="col-sm-3">
                                                                                                     <label>Alternate Mobile</label>
                                                                                                    <input type="text" name="alternate_num" class="form-control"
                                                                                                        placeholder="Alternate Mobile">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-3">
                                                                                                     <label>Date Of Birth</label>
                                                                                                    <input type="date" name="date_birth" class="form-control" >
                                                                                                </div> 
                                                                                                <div class="form-group col-sm-3">
                                                                                                     <label>Address</label>
                                                                                                    <input type="text" name="address" class="form-control"
                                                                                                        placeholder="Address">
                                                                                                </div>
                                                                                                <div class="form-group col-sm-3">
                                                                                                     <label>Block</label>
                                                                                                    <input type="text" name="block" class="form-control"
                                                                                                        placeholder="Block">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row justify-content-center mt-3">
                                                                                                 <input type='hidden' id="op_code"> <!--for r-offer -->
                                                                                                <div class="col-sm-3">
                                                                                                    <label>City</label>
                                                                                                    <input type="text" name="city" class="form-control"
                                                                                                        placeholder="City">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-3">
                                                                                                     <label>Landmark</label>
                                                                                                     <!--<label>Dae Of Birth</label>-->
                                                                                                    <input type="text" name="landmark" class="form-control"
                                                                                                        placeholder="Landmark">
                                                                                                </div> 
                                                                                                <div class="form-group col-sm-3">
                                                                                                    <label>Locality</label>
                                                                                                    <input type="text" name="locality" class="form-control"
                                                                                                        placeholder="Locality">
                                                                                                </div>
                                                                                                <div class="form-group col-sm-3">
                                                                                                    <label>Mohoalla</label>
                                                                                                    <input type="text" name="mohoalla" class="form-control"
                                                                                                        placeholder="Mohoalla">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row justify-content-center mt-3">
                                                                                                 <input type='hidden' id="op_code"> <!--for r-offer -->
                                                                                                <div class="col-sm-4">
                                                                                                    <label>Pan Number</label>
                                                                                                    <input type="text" name="pan_number" class="form-control"
                                                                                                        placeholder="Pan Number">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-4">
                                                                                                     <label>Pincode</label>
                                                                                                     <!--<label>Dae Of Birth</label>-->
                                                                                                    <input type="text" name="pincode" class="form-control"
                                                                                                        placeholder="Pincode">
                                                                                                </div> 
                                                                                                <div class="form-group col-sm-4">
                                                                                                    <label>Shop Name</label>
                                                                                                    <input type="text" name="shop_name" class="form-control"
                                                                                                        placeholder="Shop Name">
                                                                                                </div>
                                                                                                <!--<div class="form-group col-sm-3">-->
                                                                                                <!--    <input type="text" name="amount" class="form-control"-->
                                                                                                <!--        placeholder="Mohoalla">-->
                                                                                                <!--</div>-->
                                                                                            </div>
                                                                                            <div class="form-group row justify-content-center mt-3">
                                                                                                 <input type='hidden' id="op_code"> <!--for r-offer -->
                                                                                                <div class="col-sm-3">
                                                                                                    <label>Identity Proof</label>
                                                                                                    <input type="file" name="id_proof" class="form-control">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-3">
                                                                                                     <label>Address Proof</label>
                                                                                                     <!--<label>Dae Of Birth</label>-->
                                                                                                    <input type="file" name="address_proof" class="form-control">
                                                                                                </div> 
                                                                                                <div class="form-group col-sm-3">
                                                                                                    <label>Shop Pic</label>
                                                                                                    <input type="file" name="shop_photo" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-sm-3">
                                                                                                    <label>Passport Size Photo</label>
                                                                                                    <input type="file" name="psport_pic" class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-4">
                                                                                                      <select onchange="state_change(this.value)" name="state" class="form-control">
                                                                                                        <option value="">Select State</option>
                                                                                                        <?php 
                                                                                                        $url = "http://uat.dhansewa.com/Common/GetState";
                                                                                                        $ch = curl_init($url);curl_setopt($ch, CURLOPT_URL, $url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);$result = curl_exec($ch);curl_close($ch);
                                                                                                        $arr = json_decode($result);
                                                                                                        foreach($arr as $rspns){
                                                                                                            ?>
                                                                                                            <option value="<?php echo $rspns->stateid ?>"><?php echo $rspns->statename ?></option>
                                                                                                            <?php } ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                                  <div class="input-group col-sm-4">
                                                                                                    <select name="district" id="district" class="form-control">
                                                                                                       <option value="">Select District</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                                  <div class="input-group col-sm-4">
                                                                                                    <select name="shop_type" id="" class="form-control">
                                                                                                       <option value="" disabled selected >---- Shop Type----</option>
                                                                                                       <option value="Kirana Shop">Kirana Shop</option>
                                                                                                       <option value="Mobile Shop">Mobile Shop</option>
                                                                                                       <option value="Copier Shop">Copier Shop</option>
                                                                                                       <option value="other">Other</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-4">
                                                                                                      <select name="qualification" class="form-control">
                                                                                                        <option value="">Qualication </option>
                                                                                                       <option value="SSC">SSC</option>
                                                                                                       <option value="HSC">HSC </option>
                                                                                                       <option value="Graduate">Graduate </option>
                                                                                                       <option value="Post Graduate">Post Graduate</option>
                                                                                                       <option value="Diploma">Diploma</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                  <div class="input-group col-sm-4">
                                                                                                    <select name="location_type" id="" class="form-control">
                                                                                                       <option value="">---- Location Type  ----</option>
                                                                                                       <option value="Rural">Rural</option>
                                                                                                       <option value="Urban">Urban</option>
                                                                                                       <option value="Metro Semi Urban">Metro Semi Urban</option>
                                                                                                    </select>
                                                                                                   </div>
                                                                                                  <div class="input-group col-sm-4">
                                                                                                    <select name="area_population" id="" class="form-control">
                                                                                                       <option value="" disabled selected >Area Population</option>
                                                                                                       <option value="0 to 2000">0 to 2000</option>
                                                                                                       <option value="2000 to 5000">2000 to 5000</option>
                                                                                                       <option value="5000 to 10000">5000 to 10000</option>
                                                                                                       <option value="10000 to 50000">10000 to 50000</option>
                                                                                                       <option value="50000 to 100000">50000 to 100000</option>
                                                                                                       <option value="100000+">100000+</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                           
                                                                                            <div class="text-center">
                                                                                            <button type="submit" name="register" class="btn btn-primary waves-effect waves-light m-r-20">Complete Now</button>
                                                                                        </div>
                                                                                        </form> 
                                                                                    </div>

                                                                                    <!--<div class="col-lg-12 col-xl-12">-->
                                                                                    <!--  <div class="card-block">-->
                                                                                    <!--    <div class="table-responsive dt-responsive">-->
                                                                                    <!--        <table id="custm-tool-ele"-->
                                                                                    <!--            class="table table-striped table-bordered nowrap">-->
                                                                                            
                                                                                    <!--            <thead>-->
                                                                                    <!--                <tr>-->
                                                                                    <!--                    <th>Amount</th>-->
                                                                                    <!--                    <th>Dettails</th>-->
                                                                                    <!--                </tr>-->
                                                                                    <!--            </thead>-->
                                                                                    <!--            <tbody id="roff">-->
                                                                                                   
                                                                                    <!--            </tbody>-->
                                                                                    <!--         </table>-->
                                                                                    <!--    </div>-->
                                                                                    <!--</div>-->
                                                                                    <!--</div>-->

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                     </div>
                                            
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function state_change(val){
            $.ajax({
        	type: "POST",
        	url: "../../handler/aeps_req.php",
        	data:'state='+val,
        	success: function(data , status){
        		$("#district").html(data);
        // 		console.log(data);
        	}
            
        })
        
    }
    
    function get_offer(){
        
        var op_code = document.getElementById("op_code").value;
        var number = document.getElementById("number").value;
        if(op_code == ""){
            alert("Please select Operator")
        }
        else if(number == ""){
            alert("Please enter suitable Number")
        }
        else{
            document.getElementById("roff").innerHTML = "Loading Wait.";  
            $.ajax({
                url:'../masterdistributer/offer-handler/mobile_recharge.php',
                type:'post',
                data:{op_code:op_code, number:number},
                success:function(data , status){
                    document.getElementById("roff").innerHTML = data;  
                    console.log("workd" + data);
                    }
            })
        }

    }
    </script>

    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../bower_components/tether/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

    <script type="text/javascript" src="../bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="../bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

    <script type="text/javascript" src="../bower_components/classie/classie.js"></script>

    <script type="text/javascript" src="assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript"
        src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript" src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script type="text/javascript" src="../bower_components/datedropper/datedropper.min.js"></script>

    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="../bower_components/ckeditor/ckeditor.js"></script>

    <script src="assets/pages/chart/echarts/js/echarts-all.js" type="text/javascript"></script>

    <script type="text/javascript" src="../bower_components/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="../bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript"
        src="../bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-i18next/jquery-i18next.min.js"></script>

    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="assets/pages/user-profile.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/demo-12.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
</body>

</html>