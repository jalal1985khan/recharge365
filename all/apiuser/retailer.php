<?php

session_start();
if(!isset($_SESSION['ms_id']) || $_SESSION['ms_id']==="0"){
header("location:../../login.php");
}

?>


<?php


require("../includes/config.php");
require("../includes/function.php");


if(isset($_POST['submitretailer'] )){
    
    $distributer = $_POST['distributer'];
    $firstname = $_POST['f_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $password = mt_rand(1000 , 20000);
 	$message = "Dear%20User%20%20Your%20Password%20for%20Recharge365%20is%20$password.%20By%20Recharge365";

    $query = "SELECT * FROM `retailer` WHERE `MOBILE` = '$mobile' ";
    $run = mysqli_query($con , $query );
    if(mysqli_num_rows($run) < 1){
            $date = date("Y-m-d");
            if($distributer == ""){
                $owner = "MASTERDISTRIBUTER";
                $ms_id = $_SESSION["ms_id"];
            }else{
                $owner = "DISTRIBUTER";
                $ms_id = "";
            }
        	$query2 = "INSERT INTO `retailer`(`OWNER` , `MS_ID`,`DISTRIBUTER`, `FNAME`, `LNAME`, `IMAGE`, `REGDATE` ,  `MOBILE`, `EMAIL`, `SMSBAL`, `RCBAL`, `DMRBAL`, `COMM_PACK`, `CUTTOFFAMOUNT`, `STATUS`, `APIACCESS`, `ADDRESS`, `CITY`,`STATE`,  `PASSWORD`) 
        	VALUES('$owner' , '$ms_id' , '$distributer' , '$firstname' , '' ,'default.jpeg', '$date' , '$mobile' , '$email', '0', '0', '0',  '0', '10', 'Activate', '', '$address' , '$city' , '$state' , '$password') ";
             	
             		$run_query = mysqli_query($con , $query2 );
             		
            if($run_query){
                echo "<script> alert('data inserted') </script>";
   		            SendMessage($mobile,$message);
            }else{
                echo "<script> alert('data not inserted') </script>";
            } 
    }else{
                echo "<script> alert('Mobile Number Already Exisit') </script>";
    }
 
}

if(isset($_GET['status'])){
    $st = $_GET['status'];
    $id = $_GET['id'];
    if($st == "Activate"){
        $status = "Deactivate";
    }else{
        $status = "Activate";
    }
    
    if($con->query("update retailer SET STATUS='$status' where ID='$id'")){
        echo "<script> alert('User Updated') 
        location.replace('retailer.php');
        </script>";
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Retailer</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
        href="../bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="../bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">

    <link href="../bower_components/jquery.filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
    <link href="../bower_components/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css"
        rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="assets/css/component.css">

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

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>Retailer</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!"> User Managment</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Retailer</a>
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
                                    
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Retailer</h5>
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                    <i class="icofont icofont-close-circled"></i>
                                                </div>
                                                <button type="button"
                                                            class="btn btn-primary mt-5 waves-effect waves-light f-right d-inline-block md-trigger"
                                                            data-modal="modal-13"> <i
                                                                class="icofont icofont-plus m-r-5"></i> Add Person
                                                </button>
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="custm-tool-ele"
                                                        class="table table-striped table-bordered nowrap">
                                                    
                                                        <thead>
                                                            <tr>
                                                                <th>S.NO</th>
                                                                <!--<th>User ID</th>-->
                                                                <th>Image</th>
                                                                <th>Name</th>
                                                                <th>Mobile Number</th>
                                                                <th>RC BAL</th>
                                                                <th>SMS BAL</th>
                                                                <th>DMR BAL</th>
                                                                <th>Reg. Date</th>
                                                                <th>Comm</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ms_id = $_SESSION["ms_id"];
                                                            $ds = $con->query("SELECT * FROM `distributer` WHERE MS_ID='$ms_id'");
                                                            $row_ds = $ds->fetch_assoc();
                                                            $ds_id = $row_ds['ID'];
                                                    $res = $con->query("SELECT * FROM retailer WHERE OWNER='MASTERDISTRIBUTER' and (MS_ID='$ms_id' OR DISTRIBUTER='$ds_id') order by ID asc");
                                                    if($res->num_rows > 0){
                                                        while($row = $res->fetch_assoc()){
                                                            ?> <tr>
                                                                        <td><?php echo $row['ID'] ?> </td>
                                                                        <td><img src="../retailer/img/<?php echo $row['IMAGE'] ?>" width="70px"> </td>
                                                                        <td><?php echo $row['FNAME'] . $row['LNAME']?></td>
                                                                        <td><?php echo $row['MOBILE'] ?> </td>
                                                                        <td><?php echo $row['RCBAL'] ?> </td>
                                                                        <td><?php echo $row['SMSBAL'] ?> </td>
                                                                        <td><?php echo $row['DMRBAL'] ?> </td>
                                                                        <td><?php echo $row['REGDATE'] ?> </td>
                                                                    <td><a href="set-rt-package.php?user_id=<?php echo $row['ID'] ?> " class="text-center text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="icofont icofont-ui-edit"></i></a></td>
                                                                    <td><a href="retailer.php?id=<?php echo $row['ID'] ?>&status=<?php echo $row['STATUS']?>" ><?php echo ($row['STATUS'] == "Activate") ? "Activate" : "Deactivate" ?></a></td>
                                    
                                                                    </tr><?php 
                                                                      }
                                                                    }
                                                    
                                                                    ?>
                                                          </tbody>
                                                     </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="md-modal md-effect-13 addcontact" id="modal-13">
                                            <div class="md-content">
                                                <div>
                                                <h3 class="f-26">Add Retailer</h3>
                                                <br>
                                                <form action="" method="post">
                                                    <div class="input-group">
                                                        <select name="distributer" class="form-control">
                                                            <option value="">---- Select Distributer ----</option>
                                                            <?php
                                                            $query = "SELECT * FROM distributer order by ID asc";
                                                            $run = mysqli_query($con , $query);
                                          
                                                            while($row = mysqli_fetch_array($run)){
                                                    
                                                            echo "<option value=".$row['ID'].">".$row['NAME']."&nbsp;&nbsp;(Contact No : ".$row['MOBILE'].")</option>>";
                                                             }
                                                            ?>
                                                        </select>
                                                    </div>
                                                   <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control" name="f_name" placeholder="Name">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="number" class="form-control" name="mobile" placeholder="Mobile Number">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="email" class="form-control" name="email" placeholder="Email ID">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control" nam="address" placeholder="Address">
                                                    </div>
                                                    <div class="input-group">
                                                        <select name="state" class="form-control">
                                                            <option value="">---- Select State ----</option>
                                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                <option value="Assam">Assam</option>
                                                                <option value="Bihar">Bihar</option>
                                                                <option value="Chandigarh">Chandigarh</option>
                                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                                <option value="Daman and Diu">Daman and Diu</option>
                                                                <option value="Delhi">Delhi</option>
                                                                <option value="Lakshadweep">Lakshadweep</option>
                                                                <option value="Puducherry">Puducherry</option>
                                                                <option value="Goa">Goa</option>
                                                                <option value="Gujarat">Gujarat</option>
                                                                <option value="Haryana">Haryana</option>
                                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                <option value="Jharkhand">Jharkhand</option>
                                                                <option value="Karnataka">Karnataka</option>
                                                                <option value="Kerala">Kerala</option>
                                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                <option value="Maharashtra">Maharashtra</option>
                                                                <option value="Manipur">Manipur</option>
                                                                <option value="Meghalaya">Meghalaya</option>
                                                                <option value="Mizoram">Mizoram</option>
                                                                <option value="Nagaland">Nagaland</option>
                                                                <option value="Odisha">Odisha</option>
                                                                <option value="Punjab">Punjab</option>
                                                                <option value="Rajasthan">Rajasthan</option>
                                                                <option value="Sikkim">Sikkim</option>
                                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                                <option value="Telangana">Telangana</option>
                                                                <option value="Tripura">Tripura</option>
                                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                <option value="Uttarakhand">Uttarakhand</option>
                                                                <option value="West Bengal">West Bengal</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control" name="city" placeholder="City">
                                                    </div>
                                                    
                                                    <div class="text-center">
                                                        <button type="submit" name="submitretailer" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Create</button>
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="md-overlay"></div>

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
    <script type="text/javascript" src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../bower_components/tether/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

    <script type="text/javascript" src="../bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="../bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

    <script type="text/javascript" src="../bower_components/classie/classie.js"></script>

    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="../bower_components/jquery.filer/js/jquery.filer.min.js"></script>
    <script src="assets/pages/filer/custom-filer.js" type="text/javascript"></script>
    <script src="assets/pages/filer/jquery.fileuploads.init.js" type="text/javascript"></script>

    <script src="assets/js/classie.js"></script>
    <script src="assets/js/modalEffects.js"></script>

    <script type="text/javascript" src="assets/pages/product-list/product-list.js"></script>

    <script type="text/javascript" src="../bower_components/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="../bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript"
        src="../bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery-i18next/jquery-i18next.min.js"></script>

    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/demo-12.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
</body>


</html>