<?php

session_start();
if(!isset($_SESSION['rt_id']) || $_SESSION['rt_id']=="0"){
header("location:../../login.php");
}

include("../includes/config.php");
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $id = $_SESSION['rt_id'];
    $img = $_FILES['profile'];
    $img_name = $img['name'];
    
    $dest = "img/".$img_name;
    if($con->query("UPDATE retailer SET FNAME='$name' , ADDRESS='$address' , STATE='$state' , CITY='$city' where ID='$id'")){
        echo "<script>alert('Updated')</script>";
        if(!empty($img_name) && $img_name != ""){
            $user = $con->query("select * from retailer where ID='$id'")->fetch_assoc();
            $old_img = $user['IMAGE'];
            $old_dest = "img/".$old_img;
            $default_img = "img/default.jpeg";
            if($old_img != "" && $old_img != "default.jpeg" && $default_img != $old_dest){
                    if(unlink($old_dest)){
                    move_uploaded_file($img['tmp_name'] , $dest);
                    $con->query("UPDATE retailer SET IMAGE='$img_name' where ID='$id'");
                        
                    }
            }else{
                    move_uploaded_file($img['tmp_name'] , $dest);
                    $con->query("UPDATE retailer SET IMAGE='$img_name' where ID='$id'");  
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Profile</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords"
        content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">

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
                <div class="pcoded-wrapper">
                <!-- Top Header -->
           
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
                                            <h4>User Profile</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="user-profile.php">User Profile</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="user-profile.php">User Profile</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="page-body">
                                            <?php
                                            include("../includes/config.php");
                                            $id = $_SESSION['rt_id'];
                                            $row = $con->query("select * from retailer where ID='$id'")->fetch_assoc();
                                            ?>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="cover-profile">
                                                    <div class="profile-bg-img">
                                                        <img class="profile-bg-img img-fluid"
                                                            src="assets/images/user-profile/bg-img1.jpg" alt="bg-img">
                                                        <div class="card-block user-info">
                                                            <div class="col-md-12">
                                                                <div class="media-left">
                                                                    
                                                                    <a href="#" class="profile-image">
                                                                        <img style='border: 4px solid #fff;
                                                                        width: 120px !important;
                                                                        position: relative !important;
                                                                        border-radius: 30px !important;
                                                                        top: -20px !important;' class="user-img"
                                                                            src="img/<?php echo $row['IMAGE']; ?>"
                                                                            alt="user-img">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body row">
                                                                    <div class="col-lg-12">
                                                                        <div class="user-title">
                                                                            <h2><?php echo $row['FNAME'] ?></h2>
                                                                            <span class="text-white">Recharge Portal</span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="pull-right cover-btn">
                                                                            <!--<form method="post">-->
                                                                            <!--<button type="button"-->
                                                                            <!--    class="btn btn-primary m-r-10"><i-->
                                                                            <!--        class="icofont icofont-plus"></i>-->
                                                                            <!--    Profile Pic</button>-->
                                                                            <!--</form>-->
                                                                            <!--<button type="button"-->
                                                                            <!--    class="btn btn-primary"><i-->
                                                                            <!--        class="icofont icofont-plus"></i>-->
                                                                            <!--    Cover Pic</button>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="tab-header">
                                                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist"
                                                        id="mytab">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab"
                                                                href="#personal" role="tab">Personal Info</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <!--<li class="nav-item">-->
                                                        <!--    <a class="nav-link" data-toggle="tab" href="#binfo"-->
                                                        <!--        role="tab">User's Services</a>-->
                                                        <!--    <div class="slide"></div>-->
                                                        <!--</li>-->
                                                        <!--<li class="nav-item">-->
                                                        <!--    <a class="nav-link" data-toggle="tab" href="#contacts"-->
                                                        <!--        role="tab">User's Contacts</a>-->
                                                        <!--    <div class="slide"></div>-->
                                                        <!--</li>-->
                                                        <!--<li class="nav-item">-->
                                                        <!--    <a class="nav-link" data-toggle="tab" href="#review"-->
                                                        <!--        role="tab">Reviews</a>-->
                                                        <!--    <div class="slide"></div>-->
                                                        <!--</li>-->
                                                    </ul>
                                                </div>


                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="personal" role="tabpanel">

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">About Me</h5>
                                                                <button id="edit-btn" type="button"
                                                                    class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                                                    <i class="icofont icofont-edit"></i>
                                                                </button>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <table class="table m-0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th scope="row">Full
                                                                                                        Name</th>
                                                                                                    <td><?php echo $row['FNAME']; ?> <?php echo $row['LNAME'] ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">
                                                                                                        Address</th>
                                                                                                    <td><?php echo $row['ADDRESS']; ?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">
                                                                                                        City</th>
                                                                                                    <td><?php echo $row['CITY']; ?></td>
                                                                                                </tr>
                                                                                                <!--<tr>-->
                                                                                                <!--    <th scope="row">-->
                                                                                                <!--        Marital Status-->
                                                                                                <!--    </th>-->
                                                                                                <!--    <td>Single</td>-->
                                                                                                <!--</tr>-->
                                                                                                <!--<tr>-->
                                                                                                <!--    <th scope="row">-->
                                                                                                <!--        Location</th>-->
                                                                                                <!--    <td>New York, USA-->
                                                                                                <!--    </td>-->
                                                                                                <!--</tr>-->
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>

                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th scope="row">
                                                                                                        Email</th>
                                                                                                    <td><?php echo $row['EMAIL'] ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">
                                                                                                        Mobile Number
                                                                                                    </th>
                                                                                                    <td><?php echo $row['MOBILE'] ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">
                                                                                                        State</th>
                                                                                                    <td><?php echo $row['STATE']; ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <!--<tr>-->
                                                                                                <!--    <th scope="row">-->
                                                                                                <!--        Skype</th>-->
                                                                                                <!--    <td>phoenixcoded.demo-->
                                                                                                <!--    </td>-->
                                                                                                <!--</tr>-->
                                                                                                <!--<tr>-->
                                                                                                <!--    <th scope="row">-->
                                                                                                <!--        Website</th>-->
                                                                                                <!--    <td><a-->
                                                                                                <!--            href="#!">www.demo.com</a>-->
                                                                                                <!--    </td>-->
                                                                                                <!--</tr>-->
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="edit-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                        
                                                                                    <div class="col-lg-6">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label>First Name</label>
                                                                                                        <div
                                                                                                            class="input-group">
                                                                                                            <span
                                                                                                                class="input-group-addon"><i
                                                                                                                    class="icofont icofont-user"></i></span>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control" name=" name" value="<?php echo $row['FNAME'] ?>"
                                                                                                                placeholder="Full Name">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                         <label>Mobile</label>
                                                                                                        <div
                                                                                                            class="input-group">
                                                                                                            <span
                                                                                                                class="input-group-addon"><i
                                                                                                                    class="icofont icofont-user"></i></span>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control" name=" mobile" readonly value="<?php echo $row['MOBILE'] ?>"
                                                                                                                placeholder="Contact Name">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                         <label>Email</label>
                                                                                                        <div
                                                                                                            class="input-group">
                                                                                                            <span
                                                                                                                class="input-group-addon"><i
                                                                                                                    class="icofont icofont-user"></i></span>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control" name=" email" readonly value="<?php echo $row['EMAIL'] ?>"
                                                                                                                placeholder="Contact Name">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                  <tr>
                                                                                                    <td>
                                                                                                        <label><?php echo $row['IMAGE'] ?></label>
                                                                                                        <div
                                                                                                            class="input-group">
                                                                                                            <span
                                                                                                                class="input-group-addon"><i
                                                                                                                    class="icofont icofont-user"></i></span>
                                                                                                            <input
                                                                                                                type="file"
                                                                                                                class="form-control" name="profile" value=""
                                                                                                                placeholder="">
                                                                                                                <input
                                                                                                                type="hidden"
                                                                                                                class="form-control" name="old_img" value="<?php echo $row['IMAGE'] ?>"
                                                                                                                placeholder="">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>

                                                                                    <div class="col-lg-6">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label>Address</label>
                                                                                                        <div
                                                                                                            class="input-group">
                                                                                                            <span
                                                                                                                class="input-group-addon"><i
                                                                                                                    class="icofont icofont-location-pin"></i></span>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control" name=" address" value="<?php echo $row['ADDRESS'] ?>"
                                                                                                                placeholder="ADDRESS">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label>City</label>
                                                                                                        <div
                                                                                                            class="input-group">
                                                                                                            <span
                                                                                                                class="input-group-addon"><i
                                                                                                                    class="icofont icofont-location-pin"></i></span>
                                                                                                            <input
                                                                                                                type="text" name=" city"
                                                                                                                class="form-control" value="<?php echo $row['CITY'] ?>"
                                                                                                                placeholder="City">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <label>State</label>
                                                                                                        <div
                                                                                                            class="input-group">
                                                                                                            <span
                                                                                                                class="input-group-addon"><i
                                                                                                                    class="icofont icofont-location-pin"></i></span>
                                                                                                            <input
                                                                                                                type="text" name=" state" value="<?php echo $row['STATE'] ?>"
                                                                                                            
                                                                                                                class="form-control"
                                                                                                                placeholder="State">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                              
                                                                                               
                                                                                               
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>

                                                                                </div>

                                                                                <div class="text-center">
                                                                                    <button type="submit" name="update"
                                                                                        class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                                                                    <a href="#!" id="edit-cancel"
                                                                                        class="btn btn-default waves-effect">Cancel</a>
                                                                                </div>
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

                            <div id="styleSelector">
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

<!-- Mirrored from flatable.phoenixcoded.net/default/user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jan 2019 11:43:33 GMT -->

</html>