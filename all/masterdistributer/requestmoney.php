<?php


session_start();
error_reporting(0);
require("../includes/config.php");
$row=$_SESSION["row"];

if(!isset($_SESSION["masterdistributer_status"]) || $_SESSION["masterdistibuter_status"]==="0"){
header("location:../../login.php");
}
if(isset($_POST['request'])){

    $rid=$row["NAME"];
    $type = $_POST['type'];
    $mode = $_POST['mode'];
    $amt = $_POST['amt'];
    $utr = $_POST['utr'];
    $acc = $_POST['acc'];
    $img = $_FILES['screenshot'];
    $img_name = $img['name'];
    $img_tmp = $img['tmp_name'];
    $dest = "../images/amount_req/master/".$img_name;
    
    $ms_id = $_SESSION['ms_id'];
    $query = $con->query("SELECT * FROM `masterdistributer` WHERE ID='$ms_id'");
    $MS = $query->fetch_assoc();
    $admin_id = $MS['ADMIN_ID'];
    $owner = $MS['OWNER'];
    $date = date("Y-m-d");
    $query2 = $con->query("INSERT INTO `amount_req`(`PERSON`,`USER` , `OWNER_ID`, `USER_ID`, `TYPE`, `PAYMENT_MODE`, `AMOUNT`, `BANK_UTR`, `BANK_NUM`, `SCREENSHOT` , `DATE` , `STATUS` ) VALUES
    ( '$owner','MASTERDISTRIBUTER' , '$admin_id', '$ms_id' , '$type' , '$mode' , '$amt' , '$utr' , '$acc' , '$img_name' , '$date' , 'PENDING')");
    if($query2){
        move_uploaded_file($img_tmp , $dest);
     echo "<script>alert('Request made')</script>";
     }else{
              echo "<script>alert('Request Failed')</script>";

     }
	}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Money</title>

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
                                            <h4>Add Money</h4>
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
                                                <li class="breadcrumb-item"><a href="#!">Add Money</a>
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
                                                    <ul class="nav nav-tabs md-tabs tab-timeline justify-content-center" role="tablist"
                                                        id="mytab">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab"
                                                                href="#personal" role="tab">Ofline Balance Request</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#binfo"
                                                                role="tab">Online Add Wallet</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                    </ul>
                                                </div>


                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="personal" role="tabpanel">

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Ofline Balance Request</h5>
                                                                
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form action="" enctype="multipart/form-data" method="post">
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock" name="type">
                                                                                                        <option value="" selected disabled>---- Select Type ----</option>
                                                                                                        <option value="Recharge">Recharge</option>
                                                                                                        <option value="DMR">DMR </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock" name="mode">
                                                                                                        <option disabled selected  value="">---- Select Payment Mode ----</option>
                                                                                                        <option value="IMPS">IMPS</option>
                                                                                                        <option value="NEFT">NEFT </option>
                                                                                                        <option value="RTGS">RTGS </option>
                                                                                                        <option value="PAYTM">PAYTM </option>
                                                                                                        <option value="PHONEPE">PHONE PE</option>
                                                                                                        <option value="GOOGLEPAY">GOOGLE PAY</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row  mt-3">
                                                                                                <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Enter Amount" name="amt">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Bank UTR Number" name="utr">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row  mt-3">
                                                                                                <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control"
                                                                                                        placeholder="Your Bank Account Number" name="acc">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-6">
                                                                                                    <input type="file" name="screenshot" class="form-control"
                                                                                                        placeholder="Screenshot">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                            <input type="submit" name="request" class="btn btn-primary waves-effect waves-light m-r-20" value="Request">
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
                                                        <?php  
                                                        $my_id = $_SESSION['ms_id'];
                                                        $q = $con->query("SELECT * FROM `masterdistributer` where ID='$my_id'");
                                                        $row = $q->fetch_assoc();
                                                        
                                                        $rand = $_COOKIE["rand_num"];
                                                        // echo $rand;
                                                        require("Payment/constants.php");
                                                        
                                                        ?>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Online Add Wallet</h5>
                                                                
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form name="razorpay_frm_payment" class="razorpay-frm-payment" id="razorpay-frm-payment" method="post">
                                                                                            <div class="form-group row mt-3">
                                                                                               
                                                                                                <div class="col-sm-12">
                                                                                                    
                                                                                                    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="12345">
                                                                                                    <input type="hidden" name="language" value="EN">
                                                                                                    <input type="hidden" name="currency" id="currency" value="INR">
                                                                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                                                                                    
                                                                                                    <input type="hidden" name="surl" id="surl" value="pay/success.php?id=<?php echo $my_id ?>&token=<?php  echo $rand ?>">
                                                                                                    <input type="hidden" name="furl" id="furl" value="pay/failed.php">
                                                                                                     <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">

                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                           
                                                                                            <div class="text-center">
                                                                                            <button type="button" onclick="send_data()" id="razor-pay-now" class="btn btn-primary waves-effect waves-light m-r-20">Add Wallet</button>
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