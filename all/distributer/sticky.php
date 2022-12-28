<?php
session_start();
if(!isset($_SESSION["distributer_status"]) || $_SESSION["distributer_status"]==="0"){
header("location:../../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sticky Notes</title>

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

    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">

    <link rel="stylesheet" type="text/css" href="assets/pages/flag-icon/flag-icon.min.css">

    <link rel="stylesheet" type="text/css" href="assets/pages/menu-search/css/component.css">

    <link rel="stylesheet" href="assets/pages/sticky/css/jquery.postitall.css" type="text/css" media="all">
    <link rel="stylesheet" href="assets/pages/sticky/css/trumbowyg.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="assets/css/color/color-1.css" id="color" />
    <link rel="stylesheet" type="text/css" href="assets/css/linearicons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/simple-line-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <style type="text/css">
        /**  =====================
      Sticky css start
==========================  **/
        /*add Button css Start*/

        .pulse-ring {
            content: '';
            width: 140px;
            height: 55px;
            border: 20px solid #1b8bf9;
            position: absolute;
            top: 18px;
            left: 18px;
            background-color: #1b8bf9;
            animation: pulsate infinite 1.5s;
        }

        @-webkit-keyframes pulsate {
            0% {
                -moz-transform: scale(0);
                opacity: 0.0;
            }

            25% {
                -moz-transform: scale(0);
                opacity: 0.1;
            }

            50% {
                -moz-transform: scale(0.1);
                opacity: 0.3;
            }

            75% {
                -moz-transform: scale(0.5);
                opacity: 0.5;
            }

            100% {
                -moz-transform: scale(1);
                opacity: 0.0;
            }
        }

        @-moz-keyframes pulsate {
            0% {
                -moz-transform: scale(0);
                opacity: 0.0;
            }

            25% {
                -moz-transform: scale(0);
                opacity: 0.1;
            }

            50% {
                -moz-transform: scale(0.1);
                opacity: 0.3;
            }

            75% {
                -moz-transform: scale(0.5);
                opacity: 0.5;
            }

            100% {
                -moz-transform: scale(1);
                opacity: 0.0;
            }
        }


        /*====== Sticky End ======*/
    </style>
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
                                            <h4>Sticky</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Sticky</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Sticky Notes</h5>
                                                        <span>Click <code>Add Note</code> button to add new sticky
                                                            notes</span>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-rounded-down"></i>
                                                            <i class="icofont icofont-refresh"></i>
                                                            <i class="icofont icofont-close-circled"></i>
                                                        </div>
                                                    </div>
                                                    <div class="card-block sticky-card">
                                                        <button type="button" id="idRunTheCode"
                                                            class="btn btn-primary waves-effect waves-light"
                                                            data-toggle="tooltip" data-placement="top" title="Add note">
                                                            <i class="icofont icofont-ui-add"></i><span
                                                                class="m-l-10">Add note</span>
                                                        </button>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <p id="notes" class="notes"></p>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <p id="notes1" class="notes1"></p>
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


    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../bower_components/tether/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

    <script type="text/javascript" src="../bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="../bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

    <script type="text/javascript" src="../bower_components/classie/classie.js"></script>

    <script type="text/javascript" src="assets/pages/sticky/js/trumbowyg.min.js"></script>
    <script type="text/javascript" src="assets/pages/sticky/js/jquery.minicolors.min.js"></script>
    <script type="text/javascript" src="assets/pages/sticky/js/jquery.postitall.js"></script>

    <script type="text/javascript" src="../bower_components/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="../bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript"
        src="../bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-i18next/jquery-i18next.min.js"></script>

    <script type="text/javascript" src="assets/pages/sticky/js/sticky.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/demo-12.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
</body>

<!-- Mirrored from flatable.phoenixcoded.net/default/sticky.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jan 2019 11:52:17 GMT -->

</html>