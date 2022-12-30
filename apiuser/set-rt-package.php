<?php


session_start();
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}

 require("../includes/config.php");

if(isset($_POST['updatechatid']))
   {
       
     $talktochatid = $_POST['talktochatid'];

    $query = "UPDATE `tawkToChatId` SET `ID`='1',`CHATID`='$talktochatid' WHERE 1";
 
    
 $query_run = mysqli_query($con,$query);
    
     if($query_run)
     {
       echo '<script>alert("set-package is Updated")</script>';
       
     }
 
     else
     {
       echo '<script>alert("Failed to Update set-package")</script>';
     }
  }



    $u_id = $_GET['user_id'];
if(isset($_POST['update_rt_pack'])){
    $pack = $_POST['Package'];
       $query = $con->query("UPDATE `retailer` set COMM_PACK='$pack' where ID='$u_id'");
    if($query){
           echo '<script>alert("Package is Updated")</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Set package</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

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
                        include "sidebarlist.php";
                    ?>
                    <!-- sidebarlist -->

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                    
                            <div class="main-body">
                                <div class="page-wrapper">
                    
                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>Set package::</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="settings.php">CRM Managment</a> 
                                                </li>
                                                <li class="breadcrumb-item"><a href="settings.php">Set Package</a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                        
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                    
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Make Sure !! Do You Want To Change Package::</h5>
                                                        <span> <code>Change</code> Your Pckage
                                                        <div class="card-header-right">
                                                            <i class="icofont icofont-rounded-down"></i>
                                                            <i class="icofont icofont-refresh"></i>
                                                            <i class="icofont icofont-close-circled"></i>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $user_id = $_GET['user_id'];
                                                        $res = $con->query("SELECT * FROM `retailer` WHERE ID='$user_id'");
                                                        $row = $res->fetch_assoc();
                                                         $cm = $row['COMM_PACK'];
                                                        $pack = $con->query("SELECT * FROM commPackage WHERE ID='$cm'")->fetch_assoc();
                                                        $p_name = $pack['PACKNAME'];
                                                     ?>
                                                      <div class="card-block">
                                                       <div class="container">
                                                        <h4 class="pb-3"> Current Plan :: <?php echo $p_name?> </h4>
                                                        <form action="" method="post">
                                                            <div class="form-group row  justify-content-center mt-3">
                                                                <div class="col-sm-8">
                                                                    <select name="Package" class="form-control">
                                                                            <option value="" selected disabled>---- Select New Package ----</option>
                                                                 <?php
                                                                 $ad_id = $_SESSION['ms_id'];
                                                                $query = "SELECT * FROM commPackage WHERE USERTYPE='retailer' and OWNER='MASTERDISTRIBUTER' and OWNER_ID='$ad_id' order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['ID']."'>".$row['PACKNAME']."</option>>";
                                                                 }
                                                                ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                          
                                                            <div class="text-center">
                                                            <button type="submit" name="update_rt_pack" class="btn btn-primary waves-effect waves-light m-r-20">Update</button>
                                                            <a href="#!" id="edit-cancel" class="btn btn-danger waves-effect">cancel</a>
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

</html>