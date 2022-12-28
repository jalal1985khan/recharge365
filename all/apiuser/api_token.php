<?php

session_start();
if(!isset($_SESSION['ap_id']) || $_SESSION['ap_id']==="0"){
header("location:../../login.php");
}

require("../includes/config.php");
require("../includes/function.php");
  
    
    // echo $_SESSION['otp'];
if(isset($_POST['submit'])){
    $ip = $_POST['ip'];
    $id = $_SESSION['ap_id'];
    $token = str_shuffle("QWERTYUIOPasdfghjklzxcvbnm1231234567890");
    $otp = $_POST['otp_value'];
    // echo "<br>".$otp;
    if($otp == $_SESSION['otp']){
        $con->query("update Api_users set IP='$ip' , API_KEY='$token' where ID='$id'");
        echo "<script>alert('API key Genrated Check Api Documention')</script>";
    }else{
        echo "<script>alert('Wrong OTP')</script>";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                            <h4>API Token</h4>
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
                                                                                        <form method='post'>
                                                                                            <div class="form-group row mt-3">
                                                                                                <div class="col-sm-6">
                                                                                                    <label>IP Address</label>
                                                                                                    <input type="text" value="<?php echo $row['IP'] ?>" name="ip" class="form-control"
                                                                                                        placeholder="Enter IP ">
                                                                                                </div>
                                                                                                <div class="col-sm-6 row">
                                                                                                    <div class="col-4">
                                                                                                     <button type="button" id="otp_form" class="mt-4 btn btn-primary waves-effect waves-light m-r-20">Get OTP</button>
                                                                                                    </div> 
                                                                                                    <div style="display:none;" id="otp_div" class="col-8">
                                                                                                         <label>Enter OTP</label>
                                                                                                        <input class="form-control" type="number" name="otp_value" id="otp_input">
                                                                                                        <span id="otp_error" style="color:#dc3545;opacity:0;">OTP not Matched</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                 
                                                                                            </div> 
                                                                                            <div class="form-group row mt-5">
                                                                                                <!--<div class="form-group col-sm-6">-->
                                                                                                <!--     <label>API Key</label>-->
                                                                                                <!--    <input type="text" name="api" readonly value="<?php // echo $row['API_KEY'] ?>" class="form-control"-->
                                                                                                <!--        placeholder="Api Key">-->
                                                                                                <!--</div>-->
                                                                                                <div class="col-sm-8">
                                                                                                    <label>Api Response Page</label>
                                                                                                    <input type="text" name="pass" class="form-control"
                                                                                                        placeholder="Enter Response page URL ">
                                                                                                        <p class="pt-2 text-muted">template fields: @reqid, @status, @remark, @balance, @mn, @field1, @ec</p>
                                                                                                   <p class="pt-2 text-muted"> e.g: yourresponsepage?reqid=@reqid&status=@status&remark=
                                                                                                   @remark&balance=@balance&mn=
                                                                                                   @mn&field1=@field1&ec=@ec</p>
                                                                                                </div>
                                                                                                
                                                                                                <div class="col-sm-4">
                                                                                                 <lable>Validate IP</lable>
                                                                                                 <br>
                                                                                                 <br>
                                                                                                <div class="checkbox-fade fade-in-primary">
                                                                                                    <label>
                                                                                                         <input type="hidden" id="avail_st" value="on">
                                                                                                        <input onclick="update_avail()" id="avail" checked="" type="checkbox">
                                                                                                        <span class="cr">
                                                                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                                                        </span> <span class="text-muted">If you uncheck, IP address will not be validated on api call.</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                    
                                                                                               
                                                                                            </div>
                                                                                                
                                                                                            </div>
                                                                                            
                                                                                            <div class="text-center">
                                                                                                <button type="submit" id="submit_btn" name="submit" class="btn btn-primary waves-effect waves-light m-r-20">Generate Token</button>
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
                                                     <script>
                                                        $(document).ready(function(){
                                                            $("#submit_btn").attr("disabled" ,"disabled");
                                                            $("#submit_btn").css("opacity" ,"0.5");
                                                        })
                                                        $("#otp_input").on('input' , function(){
                                                            var match_otp = $("#otp_input").val();
                                                            $.ajax({
                                                                 url:'offer-handler/api_generate.php',
                                                                 type:'post',
                                                                 data:{match_otp:match_otp,},
                                                                 success:function(data , status){
                                                                     console.log(data);
                                                                     if(data == 200){
                                                                        //  $("#otp_error").css("opacity", "0");
                                                                         $("#otp_error").css("opacity", "1");
                                                                         $("#otp_error").css("color", "green");
                                                                         $("#otp_error").text("OTP Matched ");
                                                                     }else{
                                                                         $("#otp_error").css("opacity", "1");
                                                                     }
                                                                 }
                                                             })
                                                        });
                                                        
                                                         $("#otp_form").click(function(e){
                                                             e.preventDefault();
                                                             var ip = $("#ip_input").val();
                                                             var send_otp = "send_otp";
                                                             $.ajax({
                                                                 url:'offer-handler/api_generate.php',
                                                                 type:'post',
                                                                 data:{ip:ip,send_otp:send_otp ,},
                                                                 success:function(data , status){
                                                                     $("#otp_div").css("display" , "block");
                                                                      $("#submit_btn").attr("disabled" ,false);
                                                                $("#submit_btn").css("opacity" ,"1");
                                                                 }
                                                             })
                                                         })
                                                     </script>
                                            <div class="card">
                                            <div class="card-header">
                                                <h5>Api Token</h5>
                                                 
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                    <i class="icofont icofont-close-circled"></i>
                                                </div>
                                                <!--<button type="button"-->
                                                <!--            class="btn btn-primary mt-5 waves-effect waves-light f-right d-inline-block md-trigger"-->
                                                <!--            data-modal="modal-13"> <i-->
                                                <!--                class="icofont icofont-plus m-r-5"></i> Add Filter-->
                                                <!--</button>-->
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="custm-tool-ele"
                                                        class="table table-striped table-bordered nowrap">
                                                    
                                                            <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Api Token</th>
                                                                <th>IP Address</th>
                                                                <th>Validate IP</th>
                                                                <th>Api Response</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                                                                    $user = $con->query("select * from Api_users where ID='".$_SESSION['ap_id']."'")->fetch_assoc();
                                                                    ?>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><?php echo $user['API_KEY'] ?></td>
                                                                <td><?php echo $row['IP'] ?></td>
                                                                <td>
                                                                    <div class="checkbox-fade fade-in-primary">
                                                                    <label>
                                                                         <input type="hidden" id="avail_st" value="on">
                                                                        <input onclick="update_avail()" id="avail" checked="" type="checkbox">
                                                                        <span class="cr">
                                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                        </span>
                                                                    </label>
                                                                    </div>
                                                                 </td>
                                                                <td>https//:Recharges365.com</td>
                                                                <td>
                                                        <a target="_blank" href="edit-retailer.php?id=13" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="icofont icofont-ui-edit"></i></a>
                                                        <a onclick="javascript: confirmationDelete($(this));return false;" href="retailer.php?delete&amp;id=13" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="icofont icofont-delete-alt"></i></a>
                                                    </td>
                                                            </tr>
                                              
                                                        </tbody>
                                                      
                                                    </table>
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