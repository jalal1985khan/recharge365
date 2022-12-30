<?php


//require("../includes/config.php");
$error=false;
session_start();
include("../includes/function.php");
function sendMail($email,$message){

$subject = "Password Details";

// mail id to be changed to server mail id
$headers = 'From: support@recharges365.com' . "\r\n" .
  'Reply-To:  support@recharges365.com' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

// Send the email
if ($error == FALSE) {
  if(mail($email, $subject, $message, $headers)) {
    // echo "<script> alert('The email was sent.')</script>";
    
    }
    else {
    echo "<script> alert('The email fail to sent.')</script>";
    $error = TRUE;
    }
}
}
include("../includes/config.php");
	    if(isset($_POST['save'])){
            $current = $_POST['cpassword'];
            $new = $_POST['n1password'];
            $mobile = $_POST['mobile'];
            $confirm = $_POST['n2password'];
    
            if($con === false){
   	            die("ERROR: Could not connect. " . mysqli_connect_error());
   	            echo "<script>alert('Not connected')</script>";
            }
            else{
                if($new===$confirm){
    	            $query1 = "select * FROM retailer WHERE MOBILE = '".$mobile. "' OR PASSWORD = '".$current. "'";
    	            $result = mysqli_query($con, $query1);
    	            $row=mysqli_num_rows($result);
    	           // print_r($row);
   	                if($row != 0){
   	                    $email_data = mysqli_query($con, $query1);
                    	$email = $email_data->fetch_assoc();
        
   	                    // echo "<script> alert('posted') </script>";
    		            $query2 ="UPDATE retailer SET PASSWORD='".$new."' WHERE MOBILE='".$mobile."'";
     		            $run_query = mysqli_query($con , $query2 );
     		         //   print_r($run_query);
     		            $message1 = "Dear%20User%20Your%20Password%20is%20$password%20from%20www.recharges365.com";
     		            $message2 = "Dear User Your Password is $password from www.recharges365.com";
   		                sendMessage($mobile,$message1);
   		                sendMail($email['EMAIL'],$message2);
   		                echo "<script>alert('Successfully updated')</script>";
   		                header("location:index.php");
   	                }
   		            else{
		                echo "<script>alert('User does not exist.')</script>";
    	            }

            }
            else{
                echo "<script>alert('new password and confirm password should be same')</script>"; 
            }
     
        }

    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Setting</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!--complete-copy-->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/pages/dashboard/horizontal-timeline/css/style.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/pages/dashboard/amchart/css/amchart.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/css/color/color-1.css" id="color" />
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/css/linearicons.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css">
    <!-- completed -->

    <link rel="stylesheet" type="text/css" href="assets/css/ionicons.css">
    <!-- complete -->

    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- completed -->

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
                    
                            <div class="main-body">
                                <div class="page-wrapper">
                    
                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>Setting</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="settings.php">Settings</a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                    
                    
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                    
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Make Sure !! Do You Want To Change Your Password</h5>
                                                        <span> <code>Change</code> Your password
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-rounded-down"></i>
                                                            <i class="icofont icofont-refresh"></i>
                                                            <i class="icofont icofont-close-circled"></i>
                                                        </div>
                                                    </div>
                        
                                                      <div class="card-block">
                                                       <div class="container">
                                                        <h4 class="pb-3"> Change password: </h4>
                                                        <form action="" method="post">
                                                            <div class="form-group row mt-3">
                                                                
                                                                <div class="col-sm-6">
                                                                    <label for="">Mobile Number</label>
                                                                    <input type="text" name="mobile" class="form-control"
                                                                        placeholder="">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="">Current password</label>
                                                                    <input type="text" name="cpassword" class="form-control"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-3">
                                                                
                                                                <div class="col-sm-6">
                                                                    <label for="">New Password</label>
                                                                    <input type="text" name="n1password" class="form-control"
                                                                        placeholder="">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="">Confirm Password</label>
                                                                    <input type="text" name="n2password" class="form-control"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                            <input type="submit" class="btn btn-primary waves-effect waves-light m-r-20" name="save" value="Save"/>
                                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                        </div>
                                                           
                                                           
                                                        </form>
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

    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->


    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>

    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- completed -->

    <script type="text/javascript" src="../bower_components/tether/dist/js/tether.min.js"></script>
    <!-- completed -->
    <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- completed -->
    <script type="text/javascript" src="../bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- completed -->
    <script type="text/javascript" src="../bower_components/modernizr/modernizr.js"></script>
    <!-- completed -->
    <script type="text/javascript" src="../bower_components/modernizr/feature-detects/css-scrollbars.js"></script>
    <!-- completed -->
    <script type="text/javascript" src="../bower_components/classie/classie.js"></script>
    <!-- completed -->
    <script src="../bower_components/d3/d3.js"></script>
    <!-- completed -->
    <script src="../bower_components/rickshaw/rickshaw.js"></script>
    <!-- completed -->

    <script src="../bower_components/raphael/raphael.min.js"></script>
    <!-- completed -->
    <script src="../bower_components/morris.js/morris.js"></script>
    <!-- complete -->
    <script type="text/javascript" src="assets/pages/dashboard/horizontal-timeline/js/main.js"></script>
    <!-- completed -->

    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/amcharts.js"></script>
    <!-- complete -->

    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/serial.js"></script>
    <!-- complete -->

    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/light.js"></script>
    <!-- completed -->

    <script type="text/javascript" src="assets/pages/dashboard/amchart/js/custom-amchart.js"></script>
    <!-- complete -->

    <script type="text/javascript" src="../bower_components/i18next/i18next.min.js"></script>
    <!-- complete -->

    <script type="text/javascript" src="../bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <!-- complete -->
    <script type="text/javascript"
        src="../bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <!-- complete -->

    <script type="text/javascript" src="../bower_components/jquery-i18next/jquery-i18next.min.js"></script>
    <!-- completed -->


    <script type="text/javascript" src="assets/pages/dashboard/custom-dashboard.js"></script>
    <!-- complete -->
    <script type="text/javascript" src="assets/js/script.js"></script>
    <!-- complete -->
    <script src="assets/js/pcoded.min.js"></script>
    <!-- complete -->
    <script src="assets/js/demo-12.js"></script>
    <!-- complete -->
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- complete -->
    <script src="assets/js/jquery.mousewheel.min.js"></script>
    <!-- completed -->
</body>

<!-- Mirrored from flatable.phoenixcoded.net/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jan 2019 11:42:46 GMT -->

</html>