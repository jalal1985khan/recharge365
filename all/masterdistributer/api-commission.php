<?php
session_start();
if(!isset($_SESSION['ms_id']) || $_SESSION['ms_id']=="0"){
header("location:../../login.php");
}

include("../includes/config.php");
if(isset($_POST['submit_all'])){
    $id = $_POST['id'];
    $prcnt = $_POST['prcnt'];
    if($con->query("update operator_comm set PERCENTAGE='$prcnt' where PACKAGE_ID='$id'")){
        echo "<script>alert('updated')</script>";
    }
}

if(isset($_POST['submit-op'])){
    $id = $_POST['id'];
    $prcnt = $_POST['prcnt'];
     if($con->query("update operator_comm set PERCENTAGE='$prcnt' where ID='$id'")){
        echo "<script>alert('updated')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>API Commission</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, API-scalable=0, minimal-ui">
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

           <?php
                include "livechat.php";
            ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- sidebarlist -->
                    <?php
                        include "sidebarlist.php"
                    ?>
                    <!-- sidebarlist -->
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>API commission</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!"> CMS Manager</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">API Margin Setting</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">API commission</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="page-body">
                                      
                                        <div class="card">
                                             <div class="card-header">
                                                <h5>Operators Commissions</h5>
                                                 
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                    <i class="icofont icofont-close-circled"></i>
                                                </div>
                                                <button type="button"
                                                            class="btn btn-primary mt-5 waves-effect waves-light f-right d-inline-block md-trigger"
                                                            data-modal="modal-13"> <i
                                                                class="icofont icofont-plus m-r-5"></i> Add Operator
                                                </button>
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="custm-tool-ele"
                                                        class="table table-striped table-bordered nowrap">
                                                    
                                                        <thead>
                                                            <tr>
                                                                <th>S.NO</th>
                                                                <th>Name</th>
                                                                <th>Comm</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th></th>
                                                                <th>Insert Multiple Type Commission</th>
                                                                <th>Commission in %</th>
                                                                  <form method="post">
                                                                    <th><input type="text" name="prcnt" class="comm-input">% 
                                                                    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                                                                    <input type="submit" name="submit_all" class="btn btn-primary btm-sm">
                                                                    </th>
                                                                </form>                                                                 </tr>
                                                            <?php
                                                                  $pak_id = $_GET['id'];
                                                $res = $con->query("SELECT * FROM operator_comm WHERE PACKAGE_ID='$pak_id' order by ID asc");
                                                if($res->num_rows > 0){
                                                   
                                                    while($row = $res->fetch_assoc()){
                                                         ?>
                                                             <tr>
                                                                    <td><?php echo  $row['ID'] ?></td>
                                                                    <td><?php echo $row['OP_NAME'] ?></td>
                                                                    <td><?php echo $row['PERCENTAGE'] ?> %</td>
                                                                     <td>
                                                                       <form method="post">
                                                                           <input type="text" name="prcnt" class="comm-input">%
                                                                             <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                                                                        <button type="submit" name="submit-op" class="m-r-15 btn btn-primary" >Update</button>
                                                                       </form>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                  }
                                                                }
                                                                    
                                                                ?>
                                                            
                                                           </tbody>
                                                        <tfoot>
                                                         <!--<tr>-->
                                                         <!--   <th></th>-->
                                                         <!--   <th></th>-->
                                                         <!--   <th><button type="button" class="btn btn-danger">Reset</Button></th>-->
                                                         <!--   <th><button type="submit" class="btn btn-primary">Update</Button></th>-->
                                                         <!--   </tr>-->
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                        $pack_id = $_GET['id'];
                                        $pack_name = $_GET['name'];
                                        if(isset($_POST['add_operator'])){
                                            // echo "work
                                            $op = $_POST['operator'];
                                            // echo $op;
                                            $prcnt = $_POST['percentage'];
                                            $insert = $con->query("INSERT INTO `operator_comm`(`OP_ID`, `OP_NAME`, `PERCENTAGE`, `PACKAGE_ID`, `PACKAGE_NAME`) VALUES
                                            ('', '$op' , '$prcnt' , '$pack_id' , '$pack_name')");
                                            if($insert){
                                                echo "<script> alert('Operator Added') </script>";
                                            }else{
                                                echo "<script> alert('Operator Not Added') </script>";
                                            }
                                        }
                                        
                                        ?>
                                        <div class="md-modal md-effect-13 addcontact" id="modal-13">
                                            <form action="" method="post">
                                            <div class="md-content">
                                                <h3 class="f-26">Add Operator</h3>
                                                <div>
                                                    <h4>Choose Operator</h4>
                                                      
                                                    <div class="input-group">
                                                        <select name="operator" class="form-control">
                                                             <option selected disabled value="">Choose Operator</option>
                                                              <?php
                                                            $res = $con->query("SELECT * FROM operatorManager WHERE APISERVICENAME='OPERATOR' order by ID asc");
                                                            if($res->num_rows > 0){
        
                                                                while($row = $res->fetch_assoc()){
                                                                 ?>
                                                             <option value="<?php echo $row['PRODUCTNAME'] ?>"><?php echo $row['PRODUCTNAME'] ?></option>
                                                                 <?php } } ?>
                                                        </select>
                                                    </div>
                                                    <h4>Operator Percentage</h4>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control" name="percentage" placeholder="">
                                                    </div>
                                                   <div class="text-center">
                                                        <button type="submit" name="add_operator" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Add Operator</button>
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
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

    <style>
        .comm-input{
            width:50px;
        }
    </style>   

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