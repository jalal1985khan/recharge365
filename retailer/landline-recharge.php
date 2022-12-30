<?php

session_start();
if(!isset($_SESSION['rt_id']) || $_SESSION['rt_id']==="0"){
header("location:../../login.php");
}

require("../includes/config.php");
require("../includes/function.php");
  
    // echo $_SERVER['REMOTE_ADDR'];
if(isset($_POST['submit_rech'])){
    $operator = $_POST['operator'];
    $circle = $_POST['circle'];
    $mobile = $_POST['mobile_num'];
    $amount = $_POST['amount'];
    
    $q3 = $con->query("SELECT * FROM switchOperator where LONGCODE='$operator'")->fetch_assoc();
    $op_name = $q3['PRODUCTNAME'];

    if($amount=='' || $mobile=='' || strlen($mobile)!==10 || $amount < 10){
              echo "<script>alert('Please Enter 10 Digit Number OR Amount Greater Than 10')</script>";
    }else{
                $rt_id = $_SESSION['rt_id'];
             $q = $con->query("SELECT * FROM retailer where ID='$rt_id'")->fetch_assoc();
             $ms_ctof = $q['CUTTOFFAMOUNT'];
             $ms_comm = $q['COMM_PACK'];
             $ms_rcbal = $q['RCBAL'];
                 if($amount < $ms_rcbal){
                     if(($ms_rcbal - $amount) < $ms_ctof){
                          echo "<script>alert('OOPS..! Your CuttOff Limit Is ".$ms_ctof."')</script>";
                     }else{
                        $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$operator'")->fetch_assoc();
                      $serchApi = $serch['APICOMPANY'];
                      if($serchApi == "MYRC"){
                        myrc($mobile , $operator , $amount , $circle);
                      }
                      elseif($serchApi == "PAISACHARGE"){
                          p_charge($mobile , $operator , $amount);
                      } 
                      elseif($serchApi == "MROBOTIC"){
                          mrobo($mobile , $operator , $amount);
                      } 
                      elseif($serchApi == "allindiatopup"){
                          allind($mobile , $operator , $amount);
                      }
                      elseif($serchApi == "RECH1"){
                          rech365($mobile , $operator , $amount , $circle);
                      }
                  }
             }else{
                       echo "<script>alert('Invaild Amount')</script>";
             }
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
    <title>Recharge</title>

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
                                            <h4>Recharge</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Recharge</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                           
                                  


                                    <div class="page-body">
                                            
                                            <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">LANDLINE</h5>
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
                                                                                                      <select onchange="operator_change()" id="operator_menu" name="operator" class="form-control">
                                                                                                        <option value="">---- Select Operator ----</option>
                                                                                                        <?php 
                                                                                                          $query2 = "SELECT * FROM `switchOperator` WHERE `SERVICETYPE`= 'LANDLINE'";
                                                                                                          $run2 = mysqli_query($con , $query2);
                                                                                                          while($operator = mysqli_fetch_array($run2)){
                                                                                                        ?>
                                                                                                        <option value="<?php echo $operator['LONGCODE']?>"><?php echo $operator['PRODUCTNAME'] ?></option>
                                                                                                     
                                                                                                        <?php  }  ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <!--  <div class="input-group col-sm-6">-->
                                                                                                <!--    <select name="circle" id="state" class="form-control">-->
                                                                                                       
                                                                                                <!--    </select>-->
                                                                                                <!--</div>-->
                                                                                                
                                                                                            </div>
                                                                                            <div class="form-group row justify-content-center mt-3">
                                                                                                 <input type='hidden' id="op_code"> <!--for r-offer -->
                                                                                                <div class="col-sm-6">
                                                                                                    <input type="text" id="number" name="mobile_num" class="form-control"
                                                                                                        placeholder="Mobile Number">
                                                                                                </div>
                                                                                                 <div class="form-group col-sm-6">
                                                                                                    <input type="text" name="amount" class="form-control"
                                                                                                        placeholder="Amount">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                            <button type="submit" name="submit_rech" class="btn btn-primary waves-effect waves-light m-r-20">Recharge</button>
                                                                                            <button id="edit-cancel" type='button' onclick="get_offer()" class="btn btn-default waves-effect">Search Plans</button>
                                                                                        </div>
                                                                                        </form> 
                                                                                    </div>

                                                                                    <div class="col-lg-12 col-xl-12">
                                                                                      <div class="card-block">
                                                                                        <div class="table-responsive dt-responsive">
                                                                                            <table id="custm-tool-ele"
                                                                                                class="table table-striped table-bordered nowrap">
                                                                                            
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Amount</th>
                                                                                                        <th>Dettails</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody id="roff">
                                                                                                   
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
            $.ajax({
                url:'../masterdistributer/offer-handler/mobile_recharge.php',
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