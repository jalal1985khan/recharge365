<?php

session_start();
if(!isset($_SESSION['ms_id']) || $_SESSION['ms_id']==="0"){
header("location:../../login.php");
}

require("../includes/config.php");

?>

<style>
    i{
        cursor:pointer;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bill Payment</title>

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
                                            <h4>Bill Payment</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Bill Payment</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                        <div class="row">
                                        <!-- <div class="col-md-6 col-xl-4">-->
                                        <!--     <a   href="mobile-recharge.php">-->
                                        <!--    <div class="card client-blocks dark-primary-border">-->
                                        <!--        <div class="card-block">-->
                                        <!--            <h5>Mobile Recharge</h5>-->
                                        <!--            <ul>-->
                                        <!--                <li>-->
                                        <!--                    <img src="assets/icon/rc-icon/mobile.png" class="img-fluid">-->
                                        <!--                </li>-->
                                        <!--                <li class="text-right">-->
                                        <!--                    <i class="ti-angle-right"></i>-->
                                        <!--                </li>-->
                                        <!--            </ul>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--    </a>-->
                                        <!--</div>-->
                                        <!--<div class="col-md-6 col-xl-4">-->
                                        <!--    <a   href="dth-recharge.php">-->
                                        <!--    <div class="card client-blocks danger-border">-->
                                        <!--        <div class="card-block">-->
                                        <!--            <h5>DTH</h5>-->
                                        <!--            <ul>-->
                                        <!--                <li>-->
                                        <!--                    <img src="assets/icon/rc-icon/dth.png" class="img-fluid">-->
                                        <!--                </li>-->
                                        <!--                <li class="text-right text-danger">-->
                                        <!--                    <i class="ti-angle-right"></i>-->
                                        <!--                </li>-->
                                        <!--            </ul>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--    </a>-->
                                        <!--</div>-->
                                        <!--<div class="col-md-6 col-xl-4">-->
                                        <!--    <a   href="mobile-postpaid-recharge.php">-->
                                        <!--    <div class="card client-blocks dark-primary-border">-->
                                        <!--        <div class="card-block">-->
                                        <!--            <h5>Mobile Postpaid</h5>-->
                                        <!--            <ul>-->
                                        <!--                <li>-->
                                        <!--                    <img src="assets/icon/rc-icon/mobile.png" class="img-fluid">-->
                                        <!--                </li>-->
                                        <!--                <li class="text-right">-->
                                        <!--                    <i class="ti-angle-right"></i>-->
                                        <!--                </li>-->
                                        <!--            </ul>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--    </a>-->
                                        <!--</div>-->
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="electricity-recharge.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Electricity</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/electricity-bill.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="gas-bill-recharge.php">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>Gas Bill</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/gas.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="water-bill-recharge.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Water Bill</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/water-bill.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="broadband-recharge.php">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>BroadBand</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/antenna.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="insurance-recharge.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Insurance</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/home-insurance.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="data-card.php">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>Data Card</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/datacard.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="money-transfer-recharge.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Money Transfer</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/money-transfer.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="pancard-recharge.php">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>PAN Card</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/id-card.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="landline-recharge.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Landline Bill</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/telephone.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <h5>Travel And Flights</h5>
                                    <br>
                                    <div class="row">
                                         <div class="col-md-6 col-xl-4">
                                             <a   href="admin_contact.php">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>Flight Ticket</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/flight.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="admin_contact.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Bus Ticket</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/bus.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="admin_contact.php">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>Train</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/train.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="admin_contact.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Car Booking</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/car.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <h5>Online Shopping</h5>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="admin_contact.php">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>Shop</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/shopping.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <a   href="admin_contact.php">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Create Voucher</h5>
                                                    <ul>
                                                        <li>
                                                            <img src="assets/icon/rc-icon/voucher.png" class="img-fluid">
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            <i class="ti-angle-right"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </a>
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