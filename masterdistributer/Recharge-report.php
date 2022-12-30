<?php


session_start();
if(!isset($_SESSION["masterdistributer_status"]) || $_SESSION["masterdistributer_status"]==="0"){
header("location:../../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recharge Report</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords"
        content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">

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
                                            <h4>Recharge Report</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-2.html">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Report</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Recharge Report</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
    
                                        <?php
                                     include("../includes/config.php");
                                     $my_id = $_SESSION['ms_id'];
                                     $date = date("Y-m-d");
                                    $rt_sc = $con->query("SELECT * FROM recharge_history where DATE='$date' and  (STATUS='Success' OR STATUS=' Sucess ') and 
                                    OWNER='MASTERDISTRIBUTER' and OWNER_ID='$my_id'");
                                    $rt_sc_row = $rt_sc->num_rows;
                                    while($row1 = $rt_sc->fetch_assoc()){
                                        $rt_sc_am += $row1['AMOUNT'];
                                    }
                                    
                                    $ds_sc = $con->query("SELECT * FROM recharge_history where DATE='$date' and  (STATUS='Success' OR STATUS=' Sucess ') and 
                                     PERSON='MASTERDISTRIBUTER' and PERSON_ID='$my_id'");
                                    $ds_sc_row = $ds_sc->num_rows;
                                    while($row1 = $ds_sc->fetch_assoc()){
                                        $ds_sc_am += $row1['AMOUNT'];
                                    }
                                    
                                    
                                    $rt_pn = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Pending' OR STATUS='pending') and OWNER='MASTERDISTRIBUTER' and OWNER_ID='$my_id'");
                                    $rt_pn_row = $rt_pn->num_rows;
                                     while($row2 = $rt_pn->fetch_assoc()){
                                        $rt_pn_am += $row2['AMOUNT'];
                                    }
                                     $ds_pn = $con->query("SELECT * FROM recharge_history where DATE='$date' and (STATUS='Pending' OR STATUS='pending') and  PERSON='MASTERDISTRIBUTER' and PERSON_ID='$my_id'");
                                    $ds_pn_row = $ds_pn->num_rows;
                                     while($row2 = $ds_pn->fetch_assoc()){
                                        $ds_pn_am += $row2['AMOUNT'];
                                    }
                                    
                                    
                                    
                                    $rt_fl = $con->query("SELECT * FROM recharge_history where  DATE='$date' and  STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'
                                    and OWNER='MASTERDISTRIBUTER' and OWNER_ID='$my_id'");
                                    $rt_fl_row = $rt_fl->num_rows;
                                     while($row3 = $rt_fl->fetch_assoc()){
                                        $rt_fl_am += $row3['AMOUNT'];
                                    }
                                    $ds_fl = $con->query("SELECT * FROM recharge_history where  DATE='$date' and STATUS<>'Success' and STATUS<>' Sucess ' and STATUS<>'pending' and STATUS<>'Pending'
                                    and PERSON='MASTERDISTRIBUTER' and PERSON_ID='$my_id'");
                                    $ds_fl_row = $ds_fl->num_rows;
                                     while($row3 = $ds_fl->fetch_assoc()){
                                        $ds_fl_am += $row3['AMOUNT'];
                                    }
                                    
                                    
                                    ?>
                                    <div class="page-body">
                                        <div class="row">
                                        <div class="col-md-6 col-xl-4">
                                            <div class="card client-blocks dark-primary-border">
                                                <div class="card-block">
                                                    <h5>Success</h5>
                                                    <ul>
                                                        <!--<li>-->
                                                        <!--    <i class="icofont icofont-document-folder"></i>-->
                                                        <!--</li>-->
                                                        <li class="text-right">
                                                         <p class="text-dark m-0 p-0">Number</p> 
                                                            <?php echo ($rt_sc_row+$ds_sc_row) ?>
                                                        </li>
                                                        <li class="text-right">
                                                         <p class="text-dark m-0 p-0">Amount</p> 
                                                            <?php echo ($rt_sc_am+$ds_sc_am) ?>
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
                                                        <!--<li>-->
                                                        <!--    <i class="icofont icofont-ui-user-group text-warning"></i>-->
                                                        <!--</li>-->
                                                        <li class="text-right text-warning">
                                                             <p class="text-dark m-0 p-0">Number</p> 
                                                            <?php echo ($rt_pn_row+$ds_pn_row) ?>
                                                        </li> 
                                                        <li class="text-right text-warning">
                                                          <p class="text-dark  m-0 p-0">Amount</p> 
                                                          <?php echo ($rt_pn_am+$ds_pn_am) ?>
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
                                                        <!--<li>-->
                                                        <!--    <i class="icofont icofont-files text-danger"></i>-->
                                                        <!--</li>-->
                                                        <li class="text-right text-danger">
                                                         <p class="text-dark m-0 p-0" >Number</p>
                                                            <?php echo ($rt_fl_row+$ds_fl_row) ?>
                                                        </li>
                                                        <li class="text-right text-danger">
                                                         <p class="text-dark m-0 p-0">Amount</p>
                                                            <?php echo ($rt_fl_am+$ds_fl_am) ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Recharge Report</h5>
                                                 
                                                <div class="card-header-right">
                                                    <i class="icofont icofont-rounded-down"></i>
                                                    <i class="icofont icofont-refresh"></i>
                                                    <i class="icofont icofont-close-circled"></i>
                                                </div>
                                                <button type="button"
                                                            class="btn btn-primary mt-5 waves-effect waves-light f-right d-inline-block md-trigger"
                                                            data-modal="modal-13"> <i
                                                                class="icofont icofont-plus m-r-5"></i> Add Filter
                                                </button>
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="custm-tool-ele"
                                                        class="table table-striped table-bordered nowrap">
                                                    
                                                            <thead>
                                                            <tr>
                                                                  <th>S.No</th>
                                                                <th>Name </th>
                                                                <th>Type </th>
                                                                <th>Trans. ID</th>
                                                                <th>Trans. Date</th>
                                                                <th>Mobile</th>
                                                                <th>Status</th>

                                                                <th>Amount</th>
                                                                <th>Operator ID</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                             include "../includes/config.php";
                                                            if(isset($_POST['filter_date'])){
                                                                $date1 = $_POST['date1'];
                                                                $date2 = $_POST['date2'];
                                                         
                                                                $my_id = $_SESSION['ms_id'];
                                                          $q = $con->query("SELECT * FROM recharge_history where  (DATE BETWEEN '$date1' AND '$date2')  and OWNER='MASTERDISTRIBUTER' and OWNER_ID='$my_id'");
                                                                $i =1 ;
                                                                while($row = $q->fetch_assoc()){
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i++ ?></td>
                                                                        <?php
                                                                         $user_id = $row['PERSON_ID'];
                                                                        $user_type = $row['PERSON'];
                                                                       if($user_type == "RETAILER" || $user_type == "retailer"){
                                                                        $person = $con->query("select * from retailer where ID='$user_id'")->fetch_assoc();
                                                                          echo '<td>'.$person['FNAME'].'</td>';
                                                                        }else if($user_type == "DISTRIBUTER" || $user_type == "distributer"){
                                                                        $person = $con->query("select * from distributer where ID='$user_id'")->fetch_assoc();
                                                                          echo '<td>'.$person['NAME'].'</td>';
                                                                        }
                                                                            
                                                                            
                                                                        ?>
                                                                    
                                                                    <td><?php echo $row['PERSON'] ?></td>
                                                                    <td><?php echo $row['TRANS_ID'] ?></td>
                                                                    <td><?php echo $row['DATE'] ?></td>
                                                                    <td><?php echo $row['NUMBER'] ?></td>
                                                                    <td><?php echo $row['STATUS'] ?></td>
                                                                    <td><?php echo $row['AMOUNT'] ?></td>
                                                                    <td><?php echo $row['OPERATOR_ID'] ?></td>
                                                                <td><a href="print_file.php?id=<?php echo $row['ID'] ?>">Print</a></td>
                                                                </tr>
                                                         <?php } 
                                                          $q2 = $con->query("SELECT * FROM recharge_history where  (DATE BETWEEN '$date1' AND '$date2')  and PERSON='MASTERDISTRIBUTER' and PERSON_ID='$my_id'");
                                                            $i =1 ;
                                                            while($row = $q2->fetch_assoc()){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i++ ?></td>
                                                                   <?php
                                                                      $person = $con->query("select * from masterdistributer where ID='$my_id'")->fetch_assoc();
                                                                      echo '<td>'.$person['NAME'].'</td>';
                                                                    ?>
                                                                
                                                                <td><?php echo $row['PERSON'] ?></td>
                                                                <td><?php echo $row['TRANS_ID'] ?></td>
                                                                <td><?php echo $row['DATE'] ?></td>
                                                                <td><?php echo $row['NUMBER'] ?></td>
                                                                <td><?php echo $row['STATUS'] ?></td>
                                                                <td><?php echo $row['AMOUNT'] ?></td>
                                                                <td><?php echo $row['OPERATOR_ID'] ?></td>
                                                                                                                                <td><a href="print_file.php?id=<?php echo $row['ID'] ?>">Print</a></td>

                                                            </tr>
                                                         <?php } }
                                                         // today repport 
                                                         else{
                                                                $my_id = $_SESSION['ms_id'];
                                                                 $date = date("Y-m-d");
                                                                $q = $con->query("SELECT * FROM recharge_history where DATE='$date' and OWNER='MASTERDISTRIBUTER' and OWNER_ID='$my_id'");
                                                                $i =1 ;
                                                                while($row = $q->fetch_assoc()){
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i++ ?></td>
                                                                        <?php
                                                                        $user_id = $row['PERSON_ID'];
                                                                        $user_type = $row['PERSON'];
                                                                       if($user_type == "RETAILER" || $user_type == "retailer"){
                                                                        $person = $con->query("select * from retailer where ID='$user_id'")->fetch_assoc();
                                                                          echo '<td>'.$person['FNAME'].'</td>';
                                                                        }else if($user_type == "DISTRIBUTER" || $user_type == "distributer"){
                                                                        $person = $con->query("select * from distributer where ID='$user_id'")->fetch_assoc();
                                                                          echo '<td>'.$person['NAME'].'</td>';
                                                                        }
                                                                            
                                                                            
                                                                        ?>
                                                                    
                                                                    <td><?php echo $row['PERSON'] ?></td>
                                                                    <td><?php echo $row['TRANS_ID'] ?></td>
                                                                    <td><?php echo $row['DATE'] ?></td>
                                                                    <td><?php echo $row['NUMBER'] ?></td>
                                                                    <td><?php echo $row['STATUS'] ?></td>
                                                                    <td><?php echo $row['AMOUNT'] ?></td>
                                                                    <td><?php echo $row['OPERATOR_ID'] ?></td>
                                                                                                                                    <td><a href="print_file.php?id=<?php echo $row['ID'] ?>">Print</a></td>

                                                                </tr>
                                                         <?php } ?>
                                                         
                                                         <!--//display my record -->
                                                         <?php
                                                          $q2 = $con->query("SELECT * FROM recharge_history where DATE='$date' and PERSON='MASTERDISTRIBUTER' and PERSON_ID='$my_id'");
                                                            $i =1 ;
                                                            while($row = $q2->fetch_assoc()){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i++ ?></td>
                                                                    <?php
                                                                      $person = $con->query("select * from masterdistributer where ID='$my_id'")->fetch_assoc();
                                                                      echo '<td>'.$person['NAME'].'</td>';
                                                                    ?>
                                                                
                                                                <td><?php echo $row['PERSON'] ?></td>
                                                                <td><?php echo $row['TRANS_ID'] ?></td>
                                                                <td><?php echo $row['DATE'] ?></td>
                                                                <td><?php echo $row['NUMBER'] ?></td>
                                                                <td><?php echo $row['STATUS'] ?></td>
                                                                <td><?php echo $row['AMOUNT'] ?></td>
                                                                <td><?php echo $row['OPERATOR_ID'] ?></td>
                                                                                                                                <td><a href="print_file.php?id=<?php echo $row['ID'] ?>">Print</a></td>

                                                            </tr>
                                                         <?php } }?>
                                                        </tbody>
                                                        <tfoot>
                                                            
                                                        </tfoot>
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="md-modal md-effect-13 addcontact" id="modal-13">
                                            <form method="post">
                                            <div class="md-content">
                                                <h3 class="f-26">Filter Date</h3>
                                                <div>
                                                    <h6>From Date</h6>
                                                  
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input name="date1" type="date" class="form-control">
                                                    </div> 
                                                    <h6>To Date</h6>
                                                  
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input name="date2" type="date" class="form-control">
                                                    </div>
                                                    
                                                    
                                                    <div class="text-center">
                                                        <button type="submit" name="filter_date"
                                                            class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Filter</button>
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

                            <div id="styleSelector">
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