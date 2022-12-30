<?php

session_start();
if(!isset($_SESSION["retailer_status"]) || $_SESSION["retailer_status"]==="0"){
header("location:../../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add / Deduct DMR Fund</title>

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
                                            <h4> DMR Fund</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Wallet</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">DMR Fund </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                        <div class="row">
                                        <div class="col-md-6 col-xl-4">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>success</h5>
                                                    <ul>
                                                        <li>
                                                            <i class="icofont icofont-document-folder"></i>
                                                        </li>
                                                        <li class="text-right">
                                                            133
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6 col-xl-4">
                                            <div class="card client-blocks warning-border">
                                                <div class="card-block">
                                                    <h5>Pending</h5>
                                                    <ul>
                                                        <li>
                                                            <i class="icofont icofont-ui-user-group text-warning"></i>
                                                        </li>
                                                        <li class="text-right text-warning">
                                                            23
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <div class="card client-blocks danger-border">
                                                <div class="card-block">
                                                    <h5>Failure</h5>
                                                    <ul>
                                                        <li>
                                                            <i class="icofont icofont-files text-danger"></i>
                                                        </li>
                                                        <li class="text-right text-danger">
                                                            240
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="page-body">

                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="tab-header">
                                                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist"
                                                        id="mytab">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab"
                                                                href="#personal" role="tab">Master Distributer</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#binfo"
                                                                role="tab">Distributer</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#review"
                                                                role="tab">Retailer</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#whitelabel"
                                                                role="tab">WhiteLabel</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                    </ul>
                                                </div>


                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="personal" role="tabpanel">

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Master Distributer</h5>
                                                                
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form>
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Select Master Distributer ----</option>
                                                                                                        <option value="married">In Stock</option>
                                                                                                        <option value="unmarried">Out of Stock</option>
                                                                                                        <option value="unmarried">Law Stock</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Transaction Type ----</option>
                                                                                                        <option value="married">Add Fund</option>
                                                                                                        <option value="unmarried">Deduct Fund</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            <div class="form-group row mt-3">
                                                                                                 <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Amount">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Remark">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                                        </div>
                                                                                        </form> 
                                                                                    </div>

                                                                                    <div class="col-lg-12 col-xl-6">
                                                            
                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                     

                                                    </div>


                                                    <div class="tab-pane" id="binfo" role="tabpanel">

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Distributer</h5>
                                                                
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form>
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Select Distributer ----</option>
                                                                                                        <option value="married">In Stock</option>
                                                                                                        <option value="unmarried">Out of Stock</option>
                                                                                                        <option value="unmarried">Law Stock</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Transaction Type ----</option>
                                                                                                        <option value="married">Add Fund</option>
                                                                                                        <option value="unmarried">Deduct Fund</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            <div class="form-group row mt-3">
                                                                                                 <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Amount">
                                                                                                </div>
                                                                                                 <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Remark">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                                        </div>
                                                                                        </form> 
                                                                                    </div>

                                                                                    <div class="col-lg-12 col-xl-6">
                                                            
                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                     </div>

                                                    <div class="tab-pane" id="review" role="tabpanel">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Retailer</h5>
                                                                
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form>
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Select Retailer ----</option>
                                                                                                        <option value="married">In Stock</option>
                                                                                                        <option value="unmarried">Out of Stock</option>
                                                                                                        <option value="unmarried">Law Stock</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Transaction Type ----</option>
                                                                                                        <option value="married">Add Fund</option>
                                                                                                        <option value="unmarried">Deduct Fund</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            <div class="form-group row mt-3">
                                                                                                 <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Amount">
                                                                                                </div>
                                                                                                 <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Remark">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                                        </div>
                                                                                        </form> 
                                                                                    </div>

                                                                                    <div class="col-lg-12 col-xl-6">
                                                            
                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="whitelabel" role="tabpanel">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">WhiteLabel</h5>
                                                                
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form>
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Select WhiteLabel ----</option>
                                                                                                        <option value="married">In Stock</option>
                                                                                                        <option value="unmarried">Out of Stock</option>
                                                                                                        <option value="unmarried">Law Stock</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock">
                                                                                                        <option value="">---- Transaction Type ----</option>
                                                                                                        <option value="married">Add Fund</option>
                                                                                                        <option value="unmarried">Deduct Fund</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            <div class="form-group row mt-3">
                                                                                                 <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Amount">
                                                                                                </div>
                                                                                                 <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Remark">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                                        </div>
                                                                                        </form> 
                                                                                    </div>

                                                                                    <div class="col-lg-12 col-xl-6">
                                                            
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