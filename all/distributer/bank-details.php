<?php
session_start();
if(!isset($_SESSION["distributer_status"]) || $_SESSION["distributer_status"]==="0"){
header("location:../../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bank Detail</title>

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

    <link rel="stylesheet" type="text/css" href="assets/pages/j-pro/css/demo.css">
    <link rel="stylesheet" type="text/css" href="assets/pages/j-pro/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/pages/j-pro/css/j-pro-modern.css">

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

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>Bank Detail</h4>
                                            <span>Don't Worry Your Data is Secure With Us</span>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">CRM</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Bank Detail</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Bank Detail</h5>
                                                        <span> <code>Don't Worry..!!</code> You Data is Secure With Us</span>
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-rounded-down"></i>
                                                            <i class="icofont icofont-refresh"></i>
                                                            <i class="icofont icofont-close-circled"></i>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper j-wrapper-640">
                                                            <form
                                                                action=""
                                                                method="" class="j-pro" id="j-pro"
                                                                enctype="multipart/form-data" novalidate>

                                                                <div class="j-content">

                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="bankname">
                                                                                <i class="icofont icofont-building"></i>
                                                                            </label>
                                                                            <input type="text" id="bankname"
                                                                                placeholder="Bank Name" name="bankname">
                                                                        </div>
                                                                    </div>
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="accountno">
                                                                                <i class="icofont icofont-file-code"></i>
                                                                            </label>
                                                                            <input type="text" id="accountno"
                                                                                placeholder="Account Number" name="accountno">
                                                                        </div>
                                                                    </div>
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="ifsc">
                                                                                <i class="icofont icofont-building"></i>
                                                                            </label>
                                                                            <input type="text" id="ifsc"
                                                                                placeholder="IFSC Code" name="ifsc">
                                                                        </div>
                                                                    </div>
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="branchname">
                                                                                <i class="icofont icofont-building"></i>
                                                                            </label>
                                                                            <input type="text" id="branchname"
                                                                                placeholder="Branch Name" name="branchname">
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <div class="divider gap-bottom-25"></div>
                                                                    


                                                                    <div class="j-row">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input j-append-small-btn">
                                                                                <img src="assets/images/product-edit/product-edit1.jpg"
                                                                                class="img-fluid width-100"
                                                                                alt="img-edit">
                                                                            </div>
                                                                        </div>
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input j-append-small-btn">
                                                                                <div class="j-file-button">
                                                                                    Browse
                                                                                    <input type="file" id="file2"
                                                                                        name="file2"
                                                                                        onchange="document.getElementById('file2_input').value = this.value;">
                                                                                </div>
                                                                                <input type="text" id="file2_input"
                                                                                    readonly=""
                                                                                    placeholder="Add Bank Logo">
                                                                                <span class="j-hint">Only: less 100kb</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="j-response"></div>

                                                                </div>

                                                                <div class="j-footer">
                                                                    
                                                                    <button
                                                                        type="submit"
                                                                        class="btn btn-danger waves-effect waves-light" style="margin-left:15px">
                                                                        <i
                                                                            class="icofont icofont-close-circled f-16 m-l-5"></i>Remove
                                                                    </button>

                                                                    <button
                                                                        type="submit"
                                                                        class="btn btn-primary waves-effect waves-light" >
                                                                        <i
                                                                            class="ti-cloud-up f-16 m-l-5"></i>Update
                                                                    </button>
                                                                    
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

                            <div id="styleSelector">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../bower_components/tether/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="assets/pages/j-pro/js/jquery.ui.min.js"></script>
    <script type="text/javascript" src="assets/pages/j-pro/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="assets/pages/j-pro/js/jquery.j-pro.js"></script>

    <script type="text/javascript" src="../bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

    <script type="text/javascript" src="../bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="../bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

    <script type="text/javascript" src="../bower_components/classie/classie.js"></script>

    <script type="text/javascript" src="../bower_components/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="../bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript"
        src="../bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-i18next/jquery-i18next.min.js"></script>

    <script type="text/javascript" src="assets/pages/j-pro/js/custom/form-job.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/demo-12.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
</body>

</html>