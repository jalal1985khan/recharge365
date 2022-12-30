<?php

session_start();
require("../includes/config.php");
$ms_id = $_SESSION['ms_id'];
$query = $con->query("SELECT * FROM `masterdistributer` WHERE ID='$ms_id'");
$row = $query->fetch_assoc();

?>

<nav class="pcoded-navbar" pcoded-header-position="relative">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40" src="img/<?php echo $row['IMAGE']?>" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span><?php echo $row["NAME"]; ?></span>
                                        <span id="more-details">Master Distributer<i class="ti-angle-down"></i></span>
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
                                <li class="pcoded-hasmenu active pcoded-trigger">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-home"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="active">
                                            <a href="index.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.dash.analytics">Analytics</span>
                                                <span class="pcoded-badge label label-info ">NEW</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <!--<li class="">-->
                                        <!--    <a href="#">-->
                                        <!--        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                        <!--        <span class="pcoded-mtext" data-i18n="nav.dash.default">Regular Tab 1</span>-->
                                        <!--        <span class="pcoded-mcaret"></span>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                        <!--<li class=" ">-->
                                        <!--    <a href="#">-->
                                        <!--        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                        <!--        <span class="pcoded-mtext"-->
                                        <!--            data-i18n="nav.dash.ecommerce">Regular Tab 2</span>-->
                                        <!--        <span class="pcoded-mcaret"></span>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                  
                                    </ul>
                                </li>
                                
                                <!--<ul class="pcoded-item pcoded-left-item">-->
                                <!--    <li class=" ">-->
                                <!--        <a href="recharge.php" data-i18n="nav.sticky-notes.main">-->
                                <!--            <span class="pcoded-micon"><i class="ti-archive"></i></span>-->
                                <!--            <span class="pcoded-mtext">Recharge</span>-->
                                <!--            <span class="pcoded-mcaret"></span>-->
                                <!--        </a>-->
                                <!--    </li>-->
                                <!--</ul>-->
                                <!-- <ul class="pcoded-item pcoded-left-item">-->
                                <!--    <li class=" ">-->
                                <!--        <a href="bills.php" data-i18n="nav.sticky-notes.main">-->
                                <!--            <span class="pcoded-micon"><i class="ti-archive"></i></span>-->
                                <!--            <span class="pcoded-mtext">Pay Bills</span>-->
                                <!--            <span class="pcoded-mcaret"></span>-->
                                <!--        </a>-->
                                <!--    </li>-->
                                <!--</ul>-->
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" data-i18n="nav.navigate.main">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                                        <span class="pcoded-mtext">User Management</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="distributer.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Distributer</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="retailer.php" data-i18n="nav.navigate.navbar-with-elements">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Retailer</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" data-i18n="nav.navigate.main">
                                        <span class="pcoded-micon"><i class="ti-archive"></i></span>
                                        <span class="pcoded-mtext">Wallet</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="requestmoney.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Add Money</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="paymentRequestRecive.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Payment Request Receive</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="fund-add.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Fund Transfer</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                       
                                        <li class=" ">
                                            <a href="DMRfund-add.php"
                                                data-i18n="nav.navigate.navbar-with-elements">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">DMR Fund Transfer</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    
                                    </ul>
                                </li>
                                
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" data-i18n="nav.navigate.main">
                                        <span class="pcoded-micon"><i class="ti-layout-cta-right"></i></span>
                                        <span class="pcoded-mtext">CRM</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="mycommission.php" data-i18n="nav.navigate.navbar">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">My Commission</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="commissionpackage.php" data-i18n="nav.navigate.navbar-inverse">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Commission Package</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <!--<li class=" ">-->
                                        <!--    <a href="loginhistory.php"-->
                                        <!--        data-i18n="nav.navigate.navbar-with-elements">-->
                                        <!--        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                        <!--        <span class="pcoded-mtext">Login History</span>-->
                                        <!--        <span class="pcoded-mcaret"></span>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                        <!--<li class=" ">-->
                                        <!--    <a href="setting.php"-->
                                        <!--        data-i18n="nav.navigate.navbar-with-elements">-->
                                        <!--        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                        <!--        <span class="pcoded-mtext">Login setting</span>-->
                                        <!--        <span class="pcoded-mcaret"></span>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                    </ul>
                                </li>
                                <!--<div class="pcoded-navigatio-lavel" data-i18n="nav.category.support"-->
                                <!--menu-title-theme="theme5">Services</div>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Mobile & DTH</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge Now</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge-report.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge Report</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Power Bill</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="power-bill-pay.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">pay Now</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="power-bill-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Power Bill History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Mypower-bill-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">My Power Bill History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Money Transfer</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge-report.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">DMT</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="money-transfer-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Transfer History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">PostPaid Bill</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="postpaid-quick-pay.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Quick pay</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="postpaid-recharge-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Mypostpaid-bill-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">My Recharge History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Land Line Bill Payment</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="landline-bill-pay.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Pay Now</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="landline-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Payment History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<div class="pcoded-navigatio-lavel" data-i18n="nav.category.support"-->
                                <!--menu-title-theme="theme5">Services</div>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Mobile & DTH</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge Now</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge-report.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge Report</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Power Bill</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="power-bill-pay.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">pay Now</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="power-bill-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Power Bill History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Mypower-bill-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">My Power Bill History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Money Transfer</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Recharge-report.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">DMT</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="money-transfer-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Transfer History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">PostPaid Bill</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="postpaid-quick-pay.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Quick pay</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="postpaid-recharge-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Recharge History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="Mypostpaid-bill-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">My Recharge History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <!--<li class="pcoded-hasmenu">-->
                                <!--    <a href="javascript:void(0)" data-i18n="nav.navigate.main">-->
                                <!--        <span class="pcoded-micon"><i class="ti-receipt"></i></span>-->
                                <!--        <span class="pcoded-mtext">Land Line Bill Payment</span>-->
                                <!--        <span class="pcoded-mcaret"></span>-->
                                <!--    </a>-->
                                <!--    <ul class="pcoded-submenu">-->
                                <!--        <li class=" ">-->
                                <!--            <a href="landline-bill-pay.php" data-i18n="nav.navigate.navbar">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Pay Now</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class=" ">-->
                                <!--            <a href="landline-history.php"-->
                                <!--                data-i18n="nav.navigate.navbar-with-elements">-->
                                <!--                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                <!--                <span class="pcoded-mtext">Payment History</span>-->
                                <!--                <span class="pcoded-mcaret"></span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
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
                                            <a href="transaction-rpt.php"
                                                data-i18n="nav.navigate.navbar-with-elements">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Transaction Report</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="commissionreport.php"
                                                data-i18n="nav.navigate.navbar-with-elements">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Commission Report</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <!--<li class=" ">-->
                                        <!--    <a href="searchbymobile.php"-->
                                        <!--        data-i18n="nav.navigate.navbar-with-elements">-->
                                        <!--        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>-->
                                        <!--        <span class="pcoded-mtext">Search By Mobile</span>-->
                                        <!--        <span class="pcoded-mcaret"></span>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                    </ul>
                                </li>
                             </ul>
                            <!--<div class="pcoded-navigatio-lavel" data-i18n="nav.category.support"-->
                            <!--    menu-title-theme="theme5">Support</div>-->
                            <!--<ul class="pcoded-item pcoded-left-item">-->
                            <!--    <li class="">-->
                            <!--        <a href="ticket.php"-->
                            <!--            data-i18n="nav.submit-issue.main">-->
                            <!--            <span class="pcoded-micon"><i class="ti-layout-list-post"></i></span>-->
                            <!--            <span class="pcoded-mtext">Ticket</span>-->
                            <!--            <span class="pcoded-mcaret"></span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="">-->
                            <!--        <a href="ticket.php"-->
                            <!--            data-i18n="nav.submit-issue.main">-->
                            <!--            <span class="pcoded-micon"><i class="ti-layout-list-post"></i></span>-->
                            <!--            <span class="pcoded-mtext">Ticket Status</span>-->
                            <!--            <span class="pcoded-mcaret"></span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--</ul>-->
                            <!--<div class="pcoded-navigatio-lavel" data-i18n="nav.category.support"-->
                            <!--    menu-title-theme="theme5">Others</div>-->
                            <!--<ul class="pcoded-item pcoded-left-item">-->
                            <!--    <li class=" ">-->
                            <!--        <a href="sticky.php" data-i18n="nav.sticky-notes.main">-->
                            <!--            <span class="pcoded-micon"><i class="ti-layers-alt"></i></span>-->
                            <!--            <span class="pcoded-mtext">Sticky Notes</span>-->
                            <!--            <span class="pcoded-badge label label-danger">HOT</span>-->
                            <!--            <span class="pcoded-mcaret"></span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--</ul>-->
                            
                    </nav>