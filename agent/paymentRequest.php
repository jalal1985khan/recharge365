<?php
session_start();
// error_reporting(0);
if(!isset($_SESSION["status"]) || $_SESSION["status"]==="0"){
header("location:login.php");
}
require("../includes/config.php");

if(isset($_GET['req_accept'])){
    $req_id = $_GET['id'];
    $query = $con->query("SELECT * FROM `amount_req` WHERE ID='$req_id'");
    $row = $query->fetch_assoc();
    $user = $row['USER'];
    $user_id = $row['USER_ID'];
    $req_bal = $row['AMOUNT'];
    $status = $row['STATUS'];
    if($status == "PENDING"){
                if($user == "MASTERDISTRIBUTER"){
                    // echo $user_id;
                    $query2 = $con->query("SELECT * FROM `masterdistributer` WHERE ID='$user_id'");
                    $user_row = $query2->fetch_assoc();
                    $user_row_id = $user_row['ID'];
                    $user_rc_bal = $user_row['RCBAL'];
                    $add_bal = $user_rc_bal + $req_bal;
                            $admin_id = $_SESSION["status"];
                            $query3 = $con->query("SELECT * FROM `admin` WHERE ID='$admin_id'");
                            $admin_row = $query3->fetch_assoc();
                            $admin_rc_bal = $admin_row['RCBAL'];
                            if($admin_rc_bal > $req_bal){
                                $update = $con->query("UPDATE `masterdistributer` SET `RCBAL`='$add_bal' WHERE ID='$user_id'");
                                $update2 = $con->query("UPDATE `amount_req` SET `STATUS`='ACCEPTED' , `AFTER_REQ`='$add_bal' WHERE ID='$req_id'");
                                if($update2){
                                    $remain_bal = $admin_rc_bal -$req_bal;
                                    $update3 = $con->query("UPDATE `admin` SET `RCBAL`='$remain_bal' WHERE ID='$admin_id'");
                                    if($update3){
                                    echo "<script>alert('Request Accepted');
                                        location.replace('paymentRequest.php')
                                    </script>";
                                    }//update3
                                 }//update2
                            }else{
                                 echo "<script>alert('You Have No Suffeicient Amount');
                                    location.replace('paymentRequest.php')
                                </script>";
                            }
                }
                if($user == "API_USER"){
                    // echo $user_id;
                    $query2 = $con->query("SELECT * FROM `Api_users` WHERE ID='$user_id'");
                    $user_row = $query2->fetch_assoc();
                    $user_row_id = $user_row['ID'];
                    $user_rc_bal = $user_row['RCBAL'];
                    $add_bal = $user_rc_bal + $req_bal;
                            $admin_id = $_SESSION["status"];
                            $query3 = $con->query("SELECT * FROM `admin` WHERE ID='$admin_id'");
                            $admin_row = $query3->fetch_assoc();
                            $admin_rc_bal = $admin_row['RCBAL'];
                            if($admin_rc_bal > $req_bal){
                                $update = $con->query("UPDATE `Api_users` SET `RCBAL`='$add_bal' WHERE ID='$user_id'");
                                $update2 = $con->query("UPDATE `amount_req` SET `STATUS`='ACCEPTED' , `AFTER_REQ`='$add_bal' WHERE ID='$req_id'");
                                if($update2){
                                    $remain_bal = $admin_rc_bal -$req_bal;
                                    $update3 = $con->query("UPDATE `admin` SET `RCBAL`='$remain_bal' WHERE ID='$admin_id'");
                                    if($update3){
                                    echo "<script>alert('Request Accepted');
                                        location.replace('paymentRequest.php')
                                    </script>";
                                    }//update3
                                 }//update2
                            }else{
                                 echo "<script>alert('You Have No Suffeicient Amount');
                                    location.replace('paymentRequest.php')
                                </script>";
                            }
                }
                else if($user == "DISTRIBUTER"){
                        // echo $user_id;
                    $query2 = $con->query("SELECT * FROM `distributer` WHERE ID='$user_id'");
                    $user_row = $query2->fetch_assoc();
                    $user_row_id = $user_row['ID'];
                    $user_rc_bal = $user_row['RCBAL'];
                    $add_bal = $user_rc_bal + $req_bal;
                         $admin_id = $_SESSION["status"];
                            $query3 = $con->query("SELECT * FROM `admin` WHERE ID='$admin_id'");
                            $admin_row = $query3->fetch_assoc();
                            $admin_rc_bal = $admin_row['RCBAL'];
                            if($admin_rc_bal > $req_bal){
                                $update = $con->query("UPDATE `distributer` SET `RCBAL`='$add_bal' where ID='$user_id'");
                                $update2 = $con->query("UPDATE `amount_req` SET `STATUS`='ACCEPTED' , `AFTER_REQ`='$add_bal' WHERE ID='$req_id'");
                                if($update2){
                                    $remain_bal = $admin_rc_bal -$req_bal;
                                    $update3 = $con->query("UPDATE `admin` SET `RCBAL`='$remain_bal' WHERE ID='$admin_id'");
                                    if($update3){
                                    echo "<script>alert('Request Accepted');
                                        location.replace('paymentRequest.php')
                                    </script>";
                                    }//update3
                                 }//update2
                            }else{
                                 echo "<script>alert('You Have No Suffeicient Amount');
                                    location.replace('paymentRequest.php')
                                </script>";
                            }
                }
                else if($user == "RETAILER"){
                      // echo $user_id;
                    $query2 = $con->query("SELECT * FROM `retailer` WHERE ID='$user_id'");
                    $user_row = $query2->fetch_assoc();
                    $user_row_id = $user_row['ID'];
                    $user_rc_bal = $user_row['RCBAL'];
                    $add_bal = $user_rc_bal + $req_bal;
                         $admin_id = $_SESSION["status"];
                            $query3 = $con->query("SELECT * FROM `admin` WHERE ID='$admin_id'");
                            $admin_row = $query3->fetch_assoc();
                            $admin_rc_bal = $admin_row['RCBAL'];
                            if($admin_rc_bal > $req_bal){
                                $update2 = $con->query("UPDATE `amount_req` SET `STATUS`='ACCEPTED' , `AFTER_REQ`='$add_bal' WHERE ID='$req_id'");
                                if($update2){
                                    $update = $con->query("UPDATE `retailer` SET `RCBAL`='$add_bal' where ID='$user_id'");
                                    $remain_bal = $admin_rc_bal -$req_bal;
                                    $update3 = $con->query("UPDATE `admin` SET `RCBAL`='$remain_bal' WHERE ID='$admin_id'");
                                    if($update3){
                                    echo "<script>alert('Request Accepted');
                                        location.replace('paymentRequest.php')
                                    </script>";
                                    }//update3
                                 }//update2
                            }else{
                                 echo "<script>alert('You Have No Suffeicient Amount');
                                    location.replace('paymentRequest.php')
                                </script>";
                            }
                }
    }//if status pending
    else if($status == "ACCEPTED"){
        echo "<script>alert('Request Already Accepted');
                    location.replace('paymentRequest.php')
                </script>";
    }
    else if($status == "REJECTED"){
                echo "<script>alert('Request Already Rejected');
                            location.replace('paymentRequest.php')
                        </script>";
    }
}




if(isset($_GET['req_reject'])){
     $req_id = $_GET['id'];
    $query = $con->query("SELECT * FROM `amount_req` WHERE ID='$req_id'");
    $row = $query->fetch_assoc();
    $user = $row['USER'];
    $user_id = $row['USER_ID'];
    $req_bal = $row['AMOUNT'];
    $status = $row['STATUS'];
    if($status == "PENDING"){
        $query = $con->query("UPDATE `amount_req` SET `STATUS`='REJECTED' WHERE ID='$req_id'");
            if($query){
                    echo "<script>alert('Request Rejected');
                        location.replace('paymentRequest.php')
                    </script>";
            }
    }
      else if($status == "ACCEPTED"){
        echo "<script>alert('Request Already Accepted Can Not Be Refused');
                    location.replace('paymentRequest.php')
                </script>";
    }
    else if($status == "REJECTED"){
        echo "<script>alert('Request Already Rejected');
            location.replace('paymentRequest.php')
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment Request</title>

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
                <div class="pcoded-wrapper">
                <!-- Top Header -->
           
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
                                            <h4>Payment Request</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="user-profile.php">Wallet</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="user-profile.php">Payment Request</a>
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
                                                            0
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
                                                            0
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
                                                            0
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <br>

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
                                                            <a class="nav-link" data-toggle="tab"
                                                                href="#api" role="tab">API User</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#binfo"
                                                                role="tab">Distributer</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#contacts"
                                                                role="tab">Retailer</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <!--<li class="nav-item">-->
                                                        <!--    <a class="nav-link" data-toggle="tab" href="#review"-->
                                                        <!--        role="tab">Whitelable</a>-->
                                                        <!--    <div class="slide"></div>-->
                                                        <!--</li>-->
                                                    </ul>
                                                </div>

                                     <br>
                                    <br>
                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="personal" role="tabpanel">

                                                        <div class="row">
                                                           <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">

                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="card-header-text">Master Distributer
                                                                                </h5>
                                                                            </div>
                                                                            <div class="card-block contact-details">
                                                                                <div
                                                                                    class="data_table_main table-responsive dt-responsive">
                                                                                    <table id="simpletable"
                                                                                        class="table  table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>ID</th>
                                                                                                <th>Recharge Request</th>  
                                                                                                <th>Payment Mode</th>  
                                                                                                <th>Amount</th>   
                                                                                                <th>Bank UTR Number</th>   
                                                                                                <th>A/c Number</th>  
                                                                                                <th>User Name</th> 
                                                                                                <th>Screenshot</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php 
                                                                                            $admin_id = $_SESSION["status"];
                                                                                            $query = $con->query("SELECT * FROM `amount_req` WHERE OWNER_ID='$admin_id' and PERSON='ADMIN' and USER='MASTERDISTRIBUTER' and STATUS='PENDING'");
                                                                                            while ($array = $query->fetch_assoc()){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo $array["ID"]; ?></td>
                                                                                                <td><?php echo $array["TYPE"]; ?></td>
                                                                                                <td><?php echo $array["PAYMENT_MODE"]; ?></td>
                                                                                                <td><?php echo $array["AMOUNT"]; ?></td>
                                                                                                <td><?php echo $array["BANK_UTR"]; ?></td>
                                                                                                <td><?php echo $array["BANK_NUM"]; ?></td>
                                                                                                  <?php
                                                                                                $id = $array['USER_ID'];
                                                                                                $user = $con->query("select * from masterdistributer where ID='$id'")->fetch_assoc();
                                                                                                echo "<td>".$user['NAME']." </td>";
                                                                                                echo "<td>".$user['MOBILE']." </td>";
                                                                                                ?>
                                                                                                <td><?php echo $array["SCREENSHOT"]; ?></td>
                                                                                                <td><?php echo $array["STATUS"]; ?></td>
                                                                                                <td class="text-danger">Download</td> 
                                                                                                <?php if($array["STATUS"] == 'PENDING'){  ?>
                                                                                                <td><a href="paymentRequest.php?req_accept&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Accept</a>
                                                                                                <br><br> <a href="paymentRequest.php?req_reject&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Reject</a></td>
                                                                                                <?php } ?>
                                                                                            </tr>
                                                                                          <?php } ?>
                                                                                        </tbody>
                                                                                        <!--<tfoot>-->
                                                                                        <!--    <tr>-->
                                                                                        <!--        <th>Sl No.</th>-->
                                                                                        <!--        <th>Recharge Request</th>  -->
                                                                                        <!--        <th>Payment Mode</th>  -->
                                                                                        <!--        <th>Amount</th>   -->
                                                                                        <!--        <th>Bank UTR Number</th>   -->
                                                                                        <!--        <th>A/c Number</th>   -->
                                                                                        <!--        <th>Mobile No</th>-->
                                                                                        <!--        <th>User Name</th>-->
                                                                                        <!--        <th>Action</th>-->
                                                                                        <!--    </tr>-->
                                                                                        <!--</tfoot>-->
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <!-- Button trigger modal -->
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h3 class="modal-title" id="exampleModalLongTitle">Payment Request</h3>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <div class="md-content">
                                                                                <div>
                                                                                   <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pname"
                                                                                            placeholder="UTR Number" readonly>
                                                                                    </div>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pamount"
                                                                                            placeholder="Amount :" readonly>
                                                                                    </div>
                                                                                    
                                                                                    <div class="input-group">
                                                                                        <h4>Confirm Action :</h4>
                                                                                        <select id="hello-single" class="form-control stock">
                                                                                            <option value="">---- Please Select ----</option>
                                                                                            <option value="married">Accecpt</option>
                                                                                            <option value="unmarried">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                
                                                                                    <div class="text-center">
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Send</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
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


                                                    <div class="tab-pane" id="api" role="tabpanel">

                                                      <div class="row">
                                                           <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">

                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="card-header-text">API USER
                                                                                </h5>
                                                                            </div>
                                                                            <div class="card-block contact-details">
                                                                                <div
                                                                                    class="data_table_main table-responsive dt-responsive">
                                                                                    <table id="simpletable"
                                                                                        class="table  table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Sl No.</th>
                                                                                                <th>Recharge Request</th>  
                                                                                                <th>Payment Mode</th>  
                                                                                                <th>Amount</th>   
                                                                                                <th>Bank UTR Number</th>   
                                                                                                <th>A/c Number</th>  
                                                                                                <th>User Name</th> 
                                                                                                <th>Mobile No</th>
                                                                                                <th>Screenshot</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                             $admin_id = $_SESSION["status"];
                                                                                            $query = $con->query("SELECT * FROM `amount_req` WHERE OWNER_ID='$admin_id' and PERSON='ADMIN' and USER='API_USER'  and STATUS='PENDING'");
                                                                                            while ($array = $query->fetch_assoc()){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo $array["ID"]; ?></td>
                                                                                                <td><?php echo $array["TYPE"]; ?></td>
                                                                                                <td><?php echo $array["PAYMENT_MODE"]; ?></td>
                                                                                                <td><?php echo $array["AMOUNT"]; ?></td>
                                                                                                <td><?php echo $array["BANK_UTR"]; ?></td>
                                                                                                <td><?php echo $array["BANK_NUM"]; ?></td>
                                                                                                  <?php
                                                                                                $id = $array['USER_ID'];
                                                                                                $user = $con->query("select * from Api_users where ID='$id'")->fetch_assoc();
                                                                                                echo "<td>".$user['NAME']." </td>";
                                                                                                echo "<td>".$user['MOBILE']." </td>";
                                                                                                ?>
                                                                                                <td><?php echo $array["SCREENSHOT"]; ?></td>
                                                                                                <td><?php echo $array["STATUS"]; ?></td>
                                                                                                <td class="text-danger">Download</td> 
                                                                                                  <td><a href="paymentRequest.php?req_accept&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Accept</a>
                                                                                                <br><br> <a href="paymentRequest.php?req_reject&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Reject</a></td>                                                                                            </tr>
                                                                                          <?php } ?>
                                                                                        </tbody>
                                                                                        <!--<tfoot>-->
                                                                                        <!--    <tr>-->
                                                                                        <!--        <th>Sl No.</th>-->
                                                                                        <!--        <th>Recharge Request</th>  -->
                                                                                        <!--        <th>Payment Mode</th>  -->
                                                                                        <!--        <th>Amount</th>   -->
                                                                                        <!--        <th>Bank UTR Number</th>   -->
                                                                                        <!--        <th>A/c Number</th>   -->
                                                                                        <!--        <th>Mobile No</th>-->
                                                                                        <!--        <th>User Name</th>-->
                                                                                        <!--        <th>Action</th>-->
                                                                                        <!--    </tr>-->
                                                                                        <!--</tfoot>-->
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <!-- Button trigger modal -->
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h3 class="modal-title" id="exampleModalLongTitle">Payment Request</h3>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <div class="md-content">
                                                                                <div>
                                                                                   <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pname"
                                                                                            placeholder="UTR Number" readonly>
                                                                                    </div>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pamount"
                                                                                            placeholder="Amount :" readonly>
                                                                                    </div>
                                                                                    
                                                                                    <div class="input-group">
                                                                                        <h4>Confirm Action :</h4>
                                                                                        <select id="hello-single" class="form-control stock">
                                                                                            <option value="">---- Please Select ----</option>
                                                                                            <option value="married">Accecpt</option>
                                                                                            <option value="unmarried">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                
                                                                                    <div class="text-center">
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Send</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
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


                                                    <div class="tab-pane" id="binfo" role="tabpanel">

                                                      <div class="row">
                                                           <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">

                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="card-header-text">Distributer
                                                                                </h5>
                                                                            </div>
                                                                            <div class="card-block contact-details">
                                                                                <div
                                                                                    class="data_table_main table-responsive dt-responsive">
                                                                                    <table id="simpletable"
                                                                                        class="table  table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Sl No.</th>
                                                                                                <th>Recharge Request</th>  
                                                                                                <th>Payment Mode</th>  
                                                                                                <th>Amount</th>   
                                                                                                <th>Bank UTR Number</th>   
                                                                                                <th>A/c Number</th>  
                                                                                                <th>User Name</th> 
                                                                                                <th>Mobile No</th>
                                                                                                <th>Screenshot</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                             $admin_id = $_SESSION["status"];
                                                                                            $query = $con->query("SELECT * FROM `amount_req` WHERE OWNER_ID='$admin_id' and PERSON='ADMIN' and USER='DISTRIBUTER'  and STATUS='PENDING'");
                                                                                            while ($array = $query->fetch_assoc()){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo $array["ID"]; ?></td>
                                                                                                <td><?php echo $array["TYPE"]; ?></td>
                                                                                                <td><?php echo $array["PAYMENT_MODE"]; ?></td>
                                                                                                <td><?php echo $array["AMOUNT"]; ?></td>
                                                                                                <td><?php echo $array["BANK_UTR"]; ?></td>
                                                                                                <td><?php echo $array["BANK_NUM"]; ?></td>
                                                                                                  <?php
                                                                                                $id = $array['USER_ID'];
                                                                                                $user = $con->query("select * from distributer where ID='$id'")->fetch_assoc();
                                                                                                echo "<td>".$user['NAME']." </td>";
                                                                                                echo "<td>".$user['MOBILE']." </td>";
                                                                                                ?>
                                                                                                <td><?php echo $array["SCREENSHOT"]; ?></td>
                                                                                                <td><?php echo $array["STATUS"]; ?></td>
                                                                                                <td class="text-danger">Download</td> 
                                                                                                  <td><a href="paymentRequest.php?req_accept&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Accept</a>
                                                                                                <br><br> <a href="paymentRequest.php?req_reject&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Reject</a></td>                                                                                            </tr>
                                                                                          <?php } ?>
                                                                                        </tbody>
                                                                                        <!--<tfoot>-->
                                                                                        <!--    <tr>-->
                                                                                        <!--        <th>Sl No.</th>-->
                                                                                        <!--        <th>Recharge Request</th>  -->
                                                                                        <!--        <th>Payment Mode</th>  -->
                                                                                        <!--        <th>Amount</th>   -->
                                                                                        <!--        <th>Bank UTR Number</th>   -->
                                                                                        <!--        <th>A/c Number</th>   -->
                                                                                        <!--        <th>Mobile No</th>-->
                                                                                        <!--        <th>User Name</th>-->
                                                                                        <!--        <th>Action</th>-->
                                                                                        <!--    </tr>-->
                                                                                        <!--</tfoot>-->
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <!-- Button trigger modal -->
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h3 class="modal-title" id="exampleModalLongTitle">Payment Request</h3>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <div class="md-content">
                                                                                <div>
                                                                                   <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pname"
                                                                                            placeholder="UTR Number" readonly>
                                                                                    </div>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pamount"
                                                                                            placeholder="Amount :" readonly>
                                                                                    </div>
                                                                                    
                                                                                    <div class="input-group">
                                                                                        <h4>Confirm Action :</h4>
                                                                                        <select id="hello-single" class="form-control stock">
                                                                                            <option value="">---- Please Select ----</option>
                                                                                            <option value="married">Accecpt</option>
                                                                                            <option value="unmarried">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                
                                                                                    <div class="text-center">
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Send</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
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


                                                    <div class="tab-pane" id="contacts" role="tabpanel">
                                                        <div class="row">
                                                           <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">

                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="card-header-text">Retailer
                                                                                </h5>
                                                                            </div>
                                                                            <div class="card-block contact-details">
                                                                                <div
                                                                                    class="data_table_main table-responsive dt-responsive">
                                                                                    <table id="simpletable"
                                                                                        class="table  table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Sl No.</th>
                                                                                                <th>Recharge Request</th>  
                                                                                                <th>Payment Mode</th>  
                                                                                                <th>Amount</th>   
                                                                                                <th>Bank UTR Number</th>   
                                                                                                <th>A/c Number</th>  
                                                                                                <th>User Name</th> 
                                                                                                <th>Mobile No</th>
                                                                                                <th>Screenshot</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                          <?php
                                                                                             $admin_id = $_SESSION["status"];
                                                                                            $query = $con->query("SELECT * FROM `amount_req` WHERE OWNER_ID='$admin_id' and PERSON='ADMIN' and USER='RETAILER'  and STATUS='PENDING'");
                                                                                            while ($array = $query->fetch_assoc()){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo $array["ID"]; ?></td>
                                                                                                <td><?php echo $array["TYPE"]; ?></td>
                                                                                                <td><?php echo $array["PAYMENT_MODE"]; ?></td>
                                                                                                <td><?php echo $array["AMOUNT"]; ?></td>
                                                                                                <td><?php echo $array["BANK_UTR"]; ?></td>
                                                                                                <td><?php echo $array["BANK_NUM"]; ?></td>
                                                                                                <?php
                                                                                                $id = $array['USER_ID'];
                                                                                                $user = $con->query("select * from retailer where ID='$id'")->fetch_assoc();
                                                                                                echo "<td>".$user['FNAME']." </td>";
                                                                                                echo "<td>".$user['MOBILE']." </td>";
                                                                                                ?>
                                                                                                <td><?php echo $array["SCREENSHOT"]; ?></td>
                                                                                                <td><?php echo $array["STATUS"]; ?></td>
                                                                                                <td class="text-danger">Download</td> 
                                                                                                  <td><a href="paymentRequest.php?req_accept&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Accept</a>
                                                                                                <br><br> <a href="paymentRequest.php?req_reject&id=<?php echo $array["ID"]; ?>" type="button" class="  btn btn-primary">Reject</a></td>                                                                                            </tr>
                                                                                          <?php } ?>
                                                                                        </tbody>
                                                                                        <!--<tfoot>-->
                                                                                        <!--    <tr>-->
                                                                                        <!--        <th>Sl No.</th>-->
                                                                                        <!--        <th>Recharge Request</th>  -->
                                                                                        <!--        <th>Payment Mode</th>  -->
                                                                                        <!--        <th>Amount</th>   -->
                                                                                        <!--        <th>Bank UTR Number</th>   -->
                                                                                        <!--        <th>A/c Number</th>   -->
                                                                                        <!--        <th>Mobile No</th>-->
                                                                                        <!--        <th>User Name</th>-->
                                                                                        <!--        <th>Action</th>-->
                                                                                        <!--    </tr>-->
                                                                                        <!--</tfoot>-->
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <!-- Button trigger modal -->
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h3 class="modal-title" id="exampleModalLongTitle">Payment Request</h3>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <div class="md-content">
                                                                                <div>
                                                                                   <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pname"
                                                                                            placeholder="UTR Number" readonly>
                                                                                    </div>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pamount"
                                                                                            placeholder="Amount :" readonly>
                                                                                    </div>
                                                                                    
                                                                                    <div class="input-group">
                                                                                        <h4>Confirm Action :</h4>
                                                                                        <select id="hello-single" class="form-control stock">
                                                                                            <option value="">---- Please Select ----</option>
                                                                                            <option value="married">Accecpt</option>
                                                                                            <option value="unmarried">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                
                                                                                    <div class="text-center">
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Send</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
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

                                                    <div class="tab-pane" id="review" role="tabpanel">
                                                        
                                                         <div class="row">
                                                           <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">

                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5 class="card-header-text">Whitelable
                                                                                </h5>
                                                                            </div>
                                                                            <div class="card-block contact-details">
                                                                                <div
                                                                                    class="data_table_main table-responsive dt-responsive">
                                                                                    <table id="simpletable"
                                                                                        class="table  table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Sl No.</th>
                                                                                                <th>Recharge Request</th>  
                                                                                                <th>Payment Mode</th>  
                                                                                                <th>Amount</th>   
                                                                                                <th>Bank UTR Number</th>   
                                                                                                <th>A/c Number</th>  
                                                                                                <th>User Name</th> 
                                                                                                <th>Mobile No</th>
                                                                                                <th>Screenshot</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>DMR</td>
                                                                                                <td>Google Pay</td>
                                                                                                <td>50,000</td>
                                                                                                <td>152035645</td>
                                                                                                <td>15201218119</td>
                                                                                                <td>Sk saif</td>
                                                                                                <td>6289195314</td> 
                                                                                                <td class="text-danger">Download</td> 
                                                                                                <td><button type="button" class="icofont icofont-edit  btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"></button></td>
                                                                                            </tr>
                                                                                          
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                            <tr>
                                                                                                <th>Sl No.</th>
                                                                                                <th>Recharge Request</th>  
                                                                                                <th>Payment Mode</th>  
                                                                                                <th>Amount</th>   
                                                                                                <th>Bank UTR Number</th>   
                                                                                                <th>A/c Number</th>   
                                                                                                <th>Mobile No</th>
                                                                                                <th>User Name</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <!-- Button trigger modal -->
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h3 class="modal-title" id="exampleModalLongTitle">Payment Request</h3>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <div class="md-content">
                                                                                <div>
                                                                                   <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pname"
                                                                                            placeholder="UTR Number" readonly>
                                                                                    </div>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i
                                                                                                class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control pamount"
                                                                                            placeholder="Amount :" readonly>
                                                                                    </div>
                                                                                    
                                                                                    <div class="input-group">
                                                                                        <h4>Confirm Action :</h4>
                                                                                        <select id="hello-single" class="form-control stock">
                                                                                            <option value="">---- Please Select ----</option>
                                                                                            <option value="married">Accecpt</option>
                                                                                            <option value="unmarried">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                
                                                                                    <div class="text-center">
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Send</button>
                                                                                        <button type="button"
                                                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
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