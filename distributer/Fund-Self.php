<?php

session_start();
if(!isset($_SESSION["distributer_status"]) || $_SESSION["distributer_status"]==="0"){
header("location:../../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Self Rechage Fund</title>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords"
        content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">

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
                        include "sidebarlist.php"
                    ?>
                    <!-- sidebarlist -->
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                    
                            <div class="main-body">
                                <div class="page-wrapper">
                    
                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>Add Fund</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="settings.php">Wallet</a> 
                                                </li>
                                                <li class="breadcrumb-item"><a href="settings.php">Self Recharge Fund</a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                    
                    
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                    
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Make Sure !!  Self Recharge</h5>
                                                        <span> <code>Add</code> Fund</span>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-rounded-down"></i>
                                                            <i class="icofont icofont-refresh"></i>
                                                            <i class="icofont icofont-close-circled"></i>
                                                        </div>
                                                    </div>
                        
                                                      <div class="card-block">
                                                       <div class="container">
                                                        <h4 class="pb-3"> Self Recharge : </h4>
                                                        <form>
                                                           <div class="form-group row mt-3">
                                                            <div class="col-sm-12">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Amount">
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Add Fund</a>
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