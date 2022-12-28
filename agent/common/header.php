<?php
session_start();
include("../includes/config.php");
require_once('../includes/global-functions.php');
$date=date("Y-m-d");
if(!isset($_SESSION["status"]) || $_SESSION["status"]=="0"){
header("location:../");
}
if(isset($_GET['logout'])){
    session_destroy();
    header("location:../");
}




if(isset($_GET['rech_delete'])){
    $rows = $con->query("SELECT * FROM `recharge_history` WHERE DATE < DATE_SUB(NOW() , INTERVAL 30 DAY)")->num_rows;
    if($rows != 0){
        $con->query("DELETE FROM `recharge_history` WHERE DATE < DATE_SUB(NOW() , INTERVAL 30 DAY)");
       echo "<script>alert('Recharge History Deleted Enteries ".$rows." ')</script>";
    }else{
        echo "<script>alert('Already Deleted')
		location.replace('../');
		</script>";
    }
}
if(isset($_GET['Api_delete'])){
    $rows = $con->query("SELECT * FROM `ApiHit` WHERE DATE < DATE_SUB(NOW() , INTERVAL 7 DAY)")->num_rows;
    if($rows != 0){
        $con->query("DELETE FROM  `ApiHit` WHERE DATE < DATE_SUB(NOW() , INTERVAL 7 DAY)");
        echo "<script>alert('ApiHIts Deleted Enteries ".$rows." ')</script>";
    }else{
        echo "<script>alert('Already Deleted')
		location.replace('../');
		</script>";
    }
}
if(isset($_GET['comm_delete'])){
    $rows = $con->query("SELECT * FROM `comm_rpt` WHERE DATE < DATE_SUB(NOW() , INTERVAL 30 DAY)")->num_rows;
    if($rows != 0){
        $con->query("DELETE FROM  `comm_rpt` WHERE DATE < DATE_SUB(NOW() , INTERVAL 30 DAY)");
       echo "<script>alert('Comm Deleted Enteries ".$rows." ')</script>";
    }else{
        echo "<script>alert('Already Deleted')
		location.replace('../');
		</script>";
    }
}

$res = "SELECT * FROM `admin`";
$run = mysqli_query($con,$res);
$aquery = mysqli_fetch_array($run);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../styles/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../styles/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../styles/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../styles/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../styles/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../styles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../styles/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../styles/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../styles/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../styles/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


  <style>
.dataTables_filter ,.dataTables_paginate{
    display: flex;
    justify-content: flex-end;

}

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../styles/dist/img/AdminLTELogo.png" alt="Recharge365" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">SMS BAl: <span class="right badge badge-danger"><?php
                                    echo $aquery['SMSBAL'];
                                    ?></span></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">RC BAl: <span class="right badge badge-danger"><?php 
                                    echo $aquery['RCBAL'];
                                    ?></span></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">  DMR BAl: <span class="right badge badge-danger"><?php 
                                    echo $aquery['DMRBAL']; 
                                    ?></span></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item ">
        <a class="nav-link"  href="?logout">
        <i class="fa fa-power-off" aria-hidden="true"></i>
        </a>
        
      </li>
     
     
    </ul>
  </nav>
  <!-- /.navbar -->