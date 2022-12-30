<?php


session_start();
error_reporting(0);
require("../includes/config.php");
$row=$_SESSION["row"];
if(!isset($_SESSION["retailer_status"]) || $_SESSION["retailer_status"]==="0"){
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
    $dest = "../images/amount_req/distributer/".$img_name;
    $date = date("Y-m-d");
    $rt_id = $_SESSION['rt_id'];
    $query = $con->query("SELECT * FROM `retailer` WHERE ID='$rt_id'");
    $DS = $query->fetch_assoc();
    $ms_id = $DS['MS_ID'];
    $ds_id = $DS['DISTRIBUTER'];
    $owner = $DS['OWNER'];
    if($owner == "MASTERDISTRIBUTER"){
        $owner_id = $ms_id;
    }
    else if($owner == "DISTRIBUTER"){
        $owner_id = $ds_id;
    }
    else{
        $owner_id = 1;
    }
    
    $query2 = $con->query("INSERT INTO `amount_req`(`PERSON` ,`USER` , `OWNER_ID`, `USER_ID`, `TYPE`, `PAYMENT_MODE`, `AMOUNT`, `BANK_UTR`, `BANK_NUM`, `SCREENSHOT`, `STATUS` , `DATE`) VALUES
    ( '$owner', 'RETAILER' , '$owner_id', '$rt_id' , '$type' , '$mode' , '$amt' , '$utr' , '$acc' , '$img_name' , 'PENDING' , '$date')");
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
    <title>Request Money</title>

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
                                                                                        <form action="" method="post">
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock" name="type">
                                                                                                        <option value="">---- Select Type ----</option>
                                                                                                        <option value="Recharge">Recharge</option>
                                                                                                        <option value="DMR">DMR </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="input-group col-sm-6">
                                                                                                    <select id="hello-single" class="form-control stock" name="mode">
                                                                                                        <option value="">---- Select Payment Mode ----</option>
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
                                                                                                    <input type="text" class="form-control" name="amt"
                                                                                                        placeholder="Enter Amount">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-6">
                                                                                                    <input type="text" class="form-control" name="utr"
                                                                                                        placeholder="Bank UTR Number">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row  mt-3">
                                                                                                <div class="col-sm-6">
                                                                                                    <input type="text" class="form-control" name="acc"
                                                                                                        placeholder="Your Bank Account Number">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-6">
                                                                                                    <input type="file" class="form-control"
                                                                                                        placeholder="Screenshot">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                            <input type="submit" class="btn btn-primary waves-effect waves-light m-r-20" name="request" value="Request"/>
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
                                                        $my_id = $_SESSION['rt_id'];
                                                        $q = $con->query("SELECT * FROM `retailer` where ID='$my_id'");
                                                        $row = $q->fetch_assoc();
                                                        
                                                        $rand = md5($_COOKIE["rand_num"]);
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
                                                                                                    <input type="hidden" name="billing-email" id="billing-email" value="<?php echo $row['EMAIL'] ?>">
                                                                                                    <input type="hidden" name="billing-phone" id="billing-phone" value="<?php echo $row['MOBILE'] ?>">
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


<script>

        function send_data(){
   var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = "<?php echo RAZOR_KEY_ID; ?>";
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
    
    
            $.ajax({
                 url:'Payment/success.php',
                type: 'post',
                data: {
                merchant_order_id: merchant_order_id, 
                merchant_surl_id: merchant_surl_id,
                merchant_furl_id: merchant_furl_id, 
                card_holder_name_id: card_holder_name_id,
                merchant_total: merchant_total,
                merchant_amount: merchant_amount,
                currency_code_id: currency_code_id
                    
                },
                success: function (data , status) {
                            // alert("data sent");
                            console.log(data);
                }
            })
        }
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
  jQuery(document).on('click', '#razor-pay-now', function (e) {
    var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = "<?php echo RAZOR_KEY_ID; ?>";
    var store_name = 'Recharge365';
    var store_description = 'Recharge Now';
    var store_logo = '../../../apk/images/logo.png';
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
 
    jQuery('.text-danger').remove();
    var razorpay_options = {
        key: key_id,
        amount: merchant_total,
        name: store_name,
        description: store_description,
        image: store_logo,
        netbanking: true,
        currency: currency_code_id,
        prefill: {
            name: card_holder_name_id,
            email: email,
            contact: phone
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
            jQuery.ajax({
                url:'Payment/callback.php',
                type: 'post',
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code_id: currency_code_id},
                dataType: 'json',
                success: function (res) {
                    if(res.msg){
                        alert(res.msg);
                        return false;
                    }
                        
                     
                    window.location = res.redirectURL;
                }
            });
        },
        "modal": {
            "ondismiss": function () {
                // code here
            }
        }
    };
    // obj     
    var objrzpv1 = new Razorpay(razorpay_options);
    objrzpv1.open();
        e.preventDefault();
         
});
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