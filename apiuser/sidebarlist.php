<?php

session_start();
require("../includes/config.php");
$ms_id = $_SESSION['ap_id'];
$query = $con->query("SELECT * FROM `Api_users` WHERE ID='$ms_id'");
$row = $query->fetch_assoc();

?>
<style>
/*@media screen and only (max-width:320px) and (max-width:768px){*/
/*    .pcoded-main-container{*/
/*            margin-top: 29px !important;*/
/*    }*/
/*}*/
</style>
<nav class="pcoded-navbar" pcoded-header-position="relative">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40" src="img/<?php echo $row['IMAGE']?>" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span><?php echo $row["NAME"]; ?></span>
                                        <span id="more-details">Api Member<i class="ti-angle-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                           
                                            
                                            <a href="index.php?logout"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"
                                menu-title-theme="theme5">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
                               <ul class="pcoded-item pcoded-left-item">
                                    <li class=" ">
                                        <a href="index.php" data-i18n="nav.sticky-notes.main">
                                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                                            <span class="pcoded-mtext">Dashboard</span>
                                            <span class="pcoded-badge label label-info ">NEW</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class=" ">
                                       
                                            
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                                 <ul class="pcoded-item pcoded-left-item">
                                    <li class=" ">
                                        <a href="bills.php" data-i18n="nav.sticky-notes.main">
                                            <span class="pcoded-micon"><i class="ti-archive"></i></span>
                                            <span class="pcoded-mtext">Pay Bills</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                                 <ul class="pcoded-item pcoded-left-item">
                                    <li class=" ">
                                        <a href="bills.php" data-i18n="nav.sticky-notes.main">
                                            <span class="pcoded-micon"><i class="ti-archive"></i></span>
                                            <span class="pcoded-mtext">KYC For AEPS</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                                 <ul class="pcoded-item pcoded-left-item">
                                    <li class=" ">
                                        <a href="requestmoney.php" data-i18n="nav.sticky-notes.main">
                                            <span class="pcoded-micon"><i class="ti-layout-cta-right"></i></span>
                                            <span class="pcoded-mtext">Add Wallet</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
       
                                
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" data-i18n="nav.navigate.main">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                                        <span class="pcoded-mtext">Api Management</span>
                                        <span class="pcoded-mcaret" id="more-details"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="api_token.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Api Token</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <!--<li class=" ">-->
                                        <!--    <a href="api-setting.php" data-i18n="nav.navigate.navbar">-->
                                        <!--        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                        <!--        <span class="pcoded-mtext">API Setting</span>-->
                                        <!--        <span class="pcoded-mcaret"></span>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                        <li class=" ">
                                            <a href="api-docs.php" data-i18n="nav.navigate.navbar-with-elements">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Api Documents</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="mycommission.php" data-i18n="nav.navigate.navbar-with-elements">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">My Commission</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                   
                                
          
                                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.support"
                                menu-title-theme="theme5">All Reports</div>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" data-i18n="nav.navigate.main">
                                        <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                        <span class="pcoded-mtext">Reports</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                       
                                        <li class=" ">
                                            <a href="Recharge-report.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Recharge Report</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="transaction-rpt.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Money Transfer History</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="Recharge-report.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Search Recharge</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="Recharge-report.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Complaints</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="Recharge-report.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Refunds</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="transaction-rpt.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Transaction Report</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a> 
                                        </li>
                        
                                    </ul>
                                </li>
                                
                             </ul>
                        </nav>