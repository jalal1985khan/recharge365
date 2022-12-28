<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <?php
        echo $aquery['NAME'].'(ADMIN)';
        ?>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">




        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="index.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            
                        </p>
                    </a>
                  
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                           API Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="amount-whise-operator.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Amount Wise API</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="recharge-api.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recharge API</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="api-margin-setting.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Margin Settings API</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="recharge-r-offer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recharge Offer API</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="qr-api-gateway.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>QR Gateway API</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="sms-api.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bulk SMS API</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="api-callback-setting.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>CallBack API Setting</p>
                            </a>
                        </li>
                     
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                           CMS Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="services.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="operator-manager.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Operator Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="switch-operator.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Swicth Operator</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="payment-gatway-setting.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Gateway</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="talk-to-chat.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tawk Chat ID</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="sms-api.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bulk SMS API</p>
                            </a>
                        </li>
                     
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                           User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="Resellerwhite.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>White Label</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="masterdistributer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Distributor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="distributer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Distributor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="retailer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Retailer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="usertransfer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Transfer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="alluser.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="api_user.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>API Users</p>
                            </a>
                        </li>

                        
                     
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                           Wallet
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="Fund-Self.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add RC Fund</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Fund-SelfDMR.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add DMR Fund</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Fund-SelfSMS.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add SMS Fund</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin-fund.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>RC Fund Transfer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="paymentRequest.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="DMR-Fund.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DMR Fund Transfer</p>
                            </a>
                        </li>
               
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>