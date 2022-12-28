<?php

session_start();
if(!isset($_SESSION['ap_id']) || $_SESSION['ap_id']==="0"){
header("location:../../login.php");
}

require("../includes/config.php");
require("../includes/function.php");
  
    
if(isset($_POST['submit'])){
    $ip = $_POST['ip'];
    $pass = md5($_POST['pass']);
    $id = $_SESSION['ap_id'];
    $user = $con->query("select * from Api_users where ID='$id'")->fetch_assoc();
    $user_pass = $user['PASSWORD'];
    if($pass == $user_pass){
        $con->query("update Api_users set IP='$ip' where ID='$id'");
        echo "<script>alert('Updated')</script>";

    }else{
        echo "<script>alert('Wrong Password')</script>";
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
    <title>API Management</title>

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
                                            <h4>API</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Manage API</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                           
                                  


                                    <div class="page-body">
                                            
                                            <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">API Setting</h5>
                                                             </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <?php
                                                                                    $id = $_SESSION['ap_id'];
                                                                                    $row = $con->query("select * from Api_users where ID='$id'")->fetch_assoc();
                                                                                    ?>
                                                                                    <div class="col-lg-12">
                                                                                        <form method="post">
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="col-sm-6">
                                                                                                    <label>Whitelist IP</label>
                                                                                                    <input type="text" value="<?php echo $row['IP'] ?>" name="ip" class="form-control"
                                                                                                        placeholder="Enter IP ">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-6">
                                                                                                     <label>API Key</label>
                                                                                                    <input type="text" name="api" readonly value="<?php echo $row['API_KEY'] ?>" class="form-control"
                                                                                                        placeholder="Api Key">
                                                                                                </div>
                                                                                            </div> 
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="col-sm-6">
                                                                                                    <label>Enter Password</label>
                                                                                                    <input type="text" name="pass" class="form-control"
                                                                                                        placeholder="Enter Password ">
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="text-center">
                                                                                                <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light m-r-20">Update</button>
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
                </div>
            </div>
        </div>
    </div>
    <script>
    function operator_change(){
        var e = document.getElementById("operator_menu");
            var strUser = e.options[e.selectedIndex].text;
            document.getElementById("op_code").value = strUser;
            
            $.ajax({
        	type: "POST",
        	url: "../admin/get_subcat.php",
        	data:'mr_op_id='+strUser,
        	success: function(data , status){
        		$("#state").html(data);
        		
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
                    document.getElementById("roff").innerHTML = "Loading wait";  
            $.ajax({
                url:'offer-handler/mobile_recharge.php',
                type:'post',
                data:{op_code:op_code, number:number},
                success:function(data , status){
                    document.getElementById("roff").innerHTML = data;  
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